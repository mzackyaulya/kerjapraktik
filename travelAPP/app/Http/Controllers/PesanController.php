<?php

namespace App\Http\Controllers;

use App\Models\jadwal;
use App\Models\pesan;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function index()
    {
        // Ambil user yang sedang login
        $user = auth()->user();

        // Cek apakah dia admin
        if ($user->role === 'A') {
            // Admin melihat semua pesanan
            $pesan = Pesan::all();
        } else {
            // User biasa hanya melihat pesanannya sendiri
            $pesan = Pesan::where('user_id', $user->id)->get();
        }

        return view('pesan.index', compact('pesan'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($jadwal_id = null)
    {
        $jadwal = Jadwal::all();
        $selectedJadwal = null;

        if ($jadwal_id) {
            $selectedJadwal = Jadwal::find($jadwal_id);
            if (!$selectedJadwal) {
                return redirect()->back()->with('error', 'Jadwal tidak ditemukan.');
            }
        }

        return view('pesan.create', compact('jadwal', 'selectedJadwal'));
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

        $request -> validate([
            'jadwal_id' => 'required|exists:jadwals,id',
            'nama_pemesan' => 'required|max:45',
            'nohp' => 'required|max:45',
            'alamat' => 'required|max:45',
            'seet' => 'required|min:1|max:9',
            'jumlah_orang' => 'required|integer|min:1',
        ]);
        $hargaTotal = $jadwal->rute->harga * $request->jumlah_orang;

        pesan::create([
            'user_id' => auth()->id(),
            'jadwal_id' => $request->jadwal_id,
            'nama_pemesan' => $request->nama_pemesan,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'seet' => $request->seet,
            'jumlah_orang' => $request->jumlah_orang,
            'harga_total' => $hargaTotal,
            'status' => 'Pending',
        ]);

        return redirect()->route('pesan.index')->with('success', 'Data Pemesanan telah dibuat');
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
}
