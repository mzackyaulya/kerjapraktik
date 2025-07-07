<?php

namespace App\Http\Controllers;

use App\Models\jadwal;
use App\Models\pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PesanController extends Controller
{
    public function index(Request $request)
    {

        $user = auth()->user();

        $query = Pesan::select(
            \DB::raw('MIN(id) as id'),
            'user_id',
            'nama_pemesan',
            'nohp',
            'alamat',
            'jadwal_id',
            \DB::raw("GROUP_CONCAT(seet ORDER BY seet ASC SEPARATOR ', ') as daftar_kursi"),
            \DB::raw("MIN(created_at) as tanggal_pesan"),
            \DB::raw("MIN(status) as status"),
            \DB::raw("COUNT(*) as jumlah_orang")
        )
        ->groupBy('user_id', 'nama_pemesan', 'nohp', 'alamat', 'jadwal_id');

        // Jika bukan admin, filter berdasarkan user login
        if ($user->role !== 'A') {
            $query->where('user_id', $user->id);
        }

        $pesan = $query->get();

        return view('pesan.index', compact('pesan'));
    }

    public function create($jadwal_id = null)
    {
        $jadwal = Jadwal::with('kendaraan')->get();
        $selectedJadwal = null;
        $kursiTersedia = []; // Ganti nama agar cocok dengan yang di view

        if ($jadwal_id) {
            $selectedJadwal = Jadwal::with('kendaraan')->find($jadwal_id);

            if (!$selectedJadwal) {
                return redirect()->back()->with('error', 'Jadwal tidak ditemukan.');
            }

            // Ambil kapasitas kendaraan
            $kapasitas = $selectedJadwal->kendaraan->kapasitas ?? 0;

            // Buat array nomor kursi dari 1 sampai kapasitas
            $semuaKursi = range(1, $kapasitas);

            // Ambil kursi yang sudah dibooking
            $kursiTerisi = Pesan::where('jadwal_id', $selectedJadwal->id)->pluck('seet')->toArray();

            // Filter kursi yang masih tersedia
            $kursiTersedia = array_diff($semuaKursi, $kursiTerisi);
        }

        return view('pesan.create', compact('jadwal', 'selectedJadwal', 'kursiTersedia'));
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jadwal = Jadwal::find($request->jadwal_id);

        if (!$jadwal) {
            return redirect()->back()->with('error', 'Jadwal tidak ditemukan.');
        }

        $request->validate([
            'jadwal_id' => 'required|exists:jadwals,id',
            'nama_pemesan' => 'required|max:45',
            'nohp' => 'required|max:45',
            'alamat' => 'required|max:45',
            'seet' => 'required|array|min:1',
            'seet.*' => 'numeric',
            'jumlah_orang' => 'required|integer|min:1',
        ]);

        $jadwal = Jadwal::findOrFail($request->jadwal_id);
        $hargaSatuan = $jadwal->rute->harga;

        if (count($request->seet) != $request->jumlah_orang) {
            return back()->withErrors(['seet' => 'Jumlah kursi yang dipilih harus sesuai dengan jumlah orang.']);
        }

        // Loop simpan data
        foreach ($request->seet as $kursi) {
            // Cek apakah kursi sudah diambil
            $sudahTerisi = Pesan::where('jadwal_id', $request->jadwal_id)
                                ->where('seet', $kursi)
                                ->exists();

            if ($sudahTerisi) {
                return back()->withErrors(['seet' => "Kursi nomor $kursi sudah dipesan."]);
            }

            Pesan::create([
                'user_id' => auth()->id(),
                'jadwal_id' => $request->jadwal_id,
                'nama_pemesan' => $request->nama_pemesan,
                'nohp' => $request->nohp,
                'alamat' => $request->alamat,
                'seet' => $kursi,
                'jumlah_orang' => 1,
                'harga_total' => $hargaSatuan,
                'status' => 'Pending',
            ]);
        }

        return redirect()->route('pesan.index')->with('success', 'Pemesanan berhasil.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pesan = Pesan::with('jadwal.rute')->findOrFail($id); // ambil data dengan relasi jadwal dan rute
        return view('pesan.show')->with('pesan',$pesan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function edit(pesan $pesan)
    {
        $jadwal = jadwal::all();
        return view('pesan.edit')->with('jadwal',$jadwal)->with('pesan',$pesan);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jadwal_id' => 'required',
            'nama_pemesan' => 'required',
            'nohp' => 'required',
            'alamat' => 'required',
            'seet' => 'required',
            'jumlah_orang' => 'required|integer|min:1',
        ]);

        $pesan = pesan::findOrFail($id);
        $pesan->update($request->all());

        return redirect()->route('pesan.index')->with('success', 'Data berhasil diperbarui.');

    }

    public function destroy(pesan $pesan)
    {
        //
    }
    public function cetak($id)
    {
        $pesan = pesan::with('jadwal.rute')->findOrFail($id);
        return view('pesan.cetak')->with('pesan',$pesan);
    }
    public function konfirmasi($id)
    {
        $pesan = Pesan::findOrFail($id);
        $pesan->status = 'Dikonfirmasi';
        $pesan->save();

        return redirect()->back()->with('success', 'Status berhasil dikonfirmasi.');
    }

    public function batal($id)
    {
        $pesan = Pesan::findOrFail($id);
        $pesan->status = 'Batal';
        $pesan->save();

        return redirect()->back()->with('success', 'Status berhasil dibatalkan.');
    }
}
