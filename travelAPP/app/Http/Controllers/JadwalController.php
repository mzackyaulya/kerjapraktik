<?php

namespace App\Http\Controllers;

use App\Models\jadwal;
use App\Models\kendaraan;
use App\Models\rute;
use App\Models\sopir;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = jadwal::all();
        return view('jadwal.index')->with('jadwal',$jadwal);
    }

    public function create()
    {
        $rute = rute::all();
        $sopir = sopir::all();
        $kendaraan = kendaraan::all();

        return view('jadwal.create')->with('rute', $rute)->with('sopir', $sopir)->with('kendaraan', $kendaraan);
    }

    public function store(Request $request)
    {
        $val = $request-> validate([
            'gambar' => 'required|url',
            'rute_id' => 'required|exists:rutes,id',
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'sopir_id' => 'required|exists:sopirs,id',
            'tanggal' => 'required|date',
            'jam' => 'required|date_format:H:i'
        ]);

        jadwal::create($val);
        return redirect()->route('jadwal.index')->with('success', 'Data Jadwal berhasil di Tambahkan');
    }

    public function show(jadwal $jadwal)
    {
        //
    }

    public function edit(jadwal $jadwal)
    {
        $rute = rute::all();
        $sopir = sopir::all();
        $kendaraan = kendaraan::all();

        return view('jadwal.edit')->with('rute', $rute)->with('sopir', $sopir)->with('kendaraan', $kendaraan)->with('jadwal', $jadwal);
    }

    public function update(Request $request, jadwal $jadwal)
    {
        $val = $request-> validate([
            'gambar' => 'required|url',
            'rute_id' => 'required|exists:rutes,id',
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'sopir_id' => 'required|exists:sopirs,id',
            'tanggal' => 'required|date',
            'jam' => 'nullable'
        ]);

        jadwal::where('id', $jadwal['id'])->update($val);
        return redirect()->route('jadwal.index')->with('success', 'Data Jadwal berhasil di Perbarui');
    }

    public function destroy(jadwal $jadwal)
    {
        //
    }
}
