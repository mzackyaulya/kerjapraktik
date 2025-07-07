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
        $kursiTersedia = [];

        if ($jadwal_id) {
            $selectedJadwal = Jadwal::with('kendaraan')->find($jadwal_id);

            if (!$selectedJadwal) {
                return redirect()->back()->with('error', 'Jadwal tidak ditemukan.');
            }

            // Ambil kapasitas kendaraan
            $kapasitas = $selectedJadwal->kendaraan->kapasitas ?? 0;

            // Buat array semua nomor kursi dari 1 sampai kapasitas
            $semuaKursi = range(1, $kapasitas);

            // Ambil semua kursi yang sedang dipakai (kecuali Batal)
            $kursiTerisi = Pesan::where('jadwal_id', $selectedJadwal->id)
                ->whereNotIn('status', ['Batal']) // ⬅️ Abaikan semua yang statusnya Batal
                ->pluck('seet')
                ->flatMap(function ($item) {
                    return array_map('trim', explode(',', $item));
                })
                ->filter()
                ->unique()
                ->toArray();

            // Kursi yang masih tersedia
            $kursiTersedia = array_diff($semuaKursi, $kursiTerisi);
        }

        return view('pesan.create', compact('jadwal', 'selectedJadwal', 'kursiTersedia'));
    }

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

        if (count($request->seet) != $request->jumlah_orang) {
            return back()->withErrors(['seet' => 'Jumlah kursi yang dipilih harus sesuai dengan jumlah orang.']);
        }

        // Cek duplikasi kursi
        foreach ($request->seet as $kursi) {
            $sudahTerisi = Pesan::where('jadwal_id', $request->jadwal_id)
                ->where('status', '!=', 'Batal')
                ->whereRaw("FIND_IN_SET(?, seet)", [$kursi])
                ->exists();

            if ($sudahTerisi) {
                return back()->withErrors(['seet' => "Kursi nomor $kursi sudah dipesan."]);
            }
        }

        // Hitung total harga berdasarkan harga per orang
        $hargaSatuan = $jadwal->rute->harga;
        $totalHarga = $hargaSatuan * $request->jumlah_orang;

        // Simpan dalam satu baris saja
        Pesan::create([
            'user_id' => auth()->id(),
            'jadwal_id' => $request->jadwal_id,
            'nama_pemesan' => $request->nama_pemesan,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'seet' => implode(',', $request->seet),
            'jumlah_orang' => $request->jumlah_orang,
            'harga_total' => $totalHarga,
            'status' => 'Pending',
        ]);

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
    public function edit($id)
    {
        $pesan = Pesan::findOrFail($id);
        $jadwal = Jadwal::with('kendaraan')->get();

        $selectedJadwal = Jadwal::with('kendaraan')->find($pesan->jadwal_id);
        if (!$selectedJadwal || !$selectedJadwal->kendaraan) {
            return redirect()->back()->with('error', 'Jadwal atau kendaraan tidak ditemukan.');
        }

        $kapasitas = $selectedJadwal->kendaraan->kapasitas ?? 0;
        $semuaKursi = range(1, $kapasitas);

        // Ambil kursi yang sudah dipesan ORANG LAIN (status != Batal)
        $kursiTerisi = Pesan::where('jadwal_id', $pesan->jadwal_id)
            ->where('status', '!=', 'Batal')
            ->where(function ($query) use ($pesan) {
                $query->where('user_id', '!=', $pesan->user_id)
                    ->orWhere('nama_pemesan', '!=', $pesan->nama_pemesan)
                    ->orWhere('nohp', '!=', $pesan->nohp)
                    ->orWhere('alamat', '!=', $pesan->alamat);
            })
            ->pluck('seet')
            ->flatMap(function ($s) {
                $hasil = [];
                // Tangani jika disimpan sebagai JSON string
                $decoded = json_decode($s, true);
                if (is_array($decoded)) {
                    $hasil = $decoded;
                } else {
                    $hasil = explode(',', $s);
                }
                return collect($hasil)->map(fn($v) => (int) filter_var($v, FILTER_SANITIZE_NUMBER_INT))->filter();
            })
            ->unique()
            ->values()
            ->toArray();

        // Ambil semua kursi milik USER INI (berdasarkan data identik)
        $pesananUserIni = Pesan::where('jadwal_id', $pesan->jadwal_id)
            ->where('status', '!=', 'Batal')
            ->where('user_id', $pesan->user_id)
            ->where('nama_pemesan', $pesan->nama_pemesan)
            ->where('nohp', $pesan->nohp)
            ->where('alamat', $pesan->alamat)
            ->pluck('seet');

        $kursiUserIni = $pesananUserIni
            ->flatMap(function ($s) {
                $hasil = [];
                $decoded = json_decode($s, true);
                if (is_array($decoded)) {
                    $hasil = $decoded;
                } else {
                    $hasil = explode(',', $s);
                }
                return collect($hasil)->map(fn($v) => (int) filter_var($v, FILTER_SANITIZE_NUMBER_INT))->filter();
            })
            ->unique()
            ->sort()
            ->values()
            ->toArray();

        $jumlah_orang = count($kursiUserIni);

        // Hitung kursi tersedia (semua - kursiTerisi + kursi milik user ini)
        $kursiTersedia = array_unique(array_merge(array_diff($semuaKursi, $kursiTerisi), $kursiUserIni));
        sort($kursiTersedia);

        return view('pesan.edit', compact(
            'pesan',
            'jadwal',
            'kursiTersedia',
            'jumlah_orang',
            'kursiUserIni'
        ));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwals,id',
            'nama_pemesan' => 'required|max:45',
            'nohp' => 'required|max:45',
            'alamat' => 'required|max:45',
            'seet' => 'required|array|min:1',
            'seet.*' => 'numeric',
            'jumlah_orang' => 'required|integer|min:1',
        ]);

        $pesanLama = Pesan::findOrFail($id);
        $jadwal = Jadwal::with('rute')->findOrFail($request->jadwal_id);
        $hargaSatuan = $jadwal->rute->harga;

        // Ambil semua pemesanan identik user ini
        $pesananUser = Pesan::where('user_id', $pesanLama->user_id)
            ->where('jadwal_id', $pesanLama->jadwal_id)
            ->where('nama_pemesan', $pesanLama->nama_pemesan)
            ->where('nohp', $pesanLama->nohp)
            ->where('alamat', $pesanLama->alamat)
            ->get();

        // Simpan status-status lama
        $statusLama = $pesananUser->pluck('status')->toArray();

        // Hapus pemesanan lama
        foreach ($pesananUser as $p) {
            $p->delete();
        }

        // Simpan kursi baru sesuai jumlah dan isi status lama (jika cukup)
        foreach ($request->seet as $index => $kursi) {
            Pesan::create([
                'user_id' => auth()->id(),
                'jadwal_id' => $request->jadwal_id,
                'nama_pemesan' => $request->nama_pemesan,
                'nohp' => $request->nohp,
                'alamat' => $request->alamat,
                'seet' => $kursi,
                'jumlah_orang' => $request->jumlah_orang,
                'harga_total' => $hargaSatuan,
                'status' => $statusLama[$index] ?? 'Pending',
            ]);
        }

        return redirect()->route('pesan.index')->with('success', 'Pemesanan berhasil diperbarui.');
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
