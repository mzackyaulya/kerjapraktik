<?php

namespace App\Http\Controllers;

use App\Models\jadwal;
use App\Models\kendaraan;
use App\Models\pesan;
use App\Models\rute;
use App\Models\sopir;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = jadwal::with(['rute', 'kendaraan', 'sopir'])->get();

        foreach ($jadwal as $j) {
            $kapasitas = $j->kendaraan->kapasitas ?? 0;

            $kursiTerisi = Pesan::where('jadwal_id', $j->id)
                ->where('status', '!=', 'Batal')
                ->pluck('seet')
                ->flatMap(function ($item) {
                    return array_map('trim', explode(',', $item));
                })
                ->filter()
                ->unique()
                ->count();

            $j->sisa_kursi = max(0, $kapasitas - $kursiTerisi); // biar tidak minus
        }

        return view('jadwal.index')->with('jadwal', $jadwal);
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
            'rute_id' => 'required|exists:rutes,id',
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'sopir_id' => 'required|exists:sopirs,id',
            'tanggal' => 'required|date',
            'jam' => 'required|date_format:H:i'
        ]);

        $val['gambar'] = 'https://upload.wikimedia.org/wikipedia/commons/9/9e/Tugu_Siger.jpg';

        jadwal::create($val);
        return redirect()->route('jadwal.index')->with('success', 'Data Jadwal berhasil di Tambahkan');
    }

    public function cetak($id)
    {
        $jadwal = Jadwal::with(['rute', 'kendaraan', 'sopir'])->findOrFail($id);
        $pesanan = pesan::where('jadwal_id', $id)->with('jadwal')->get();

        return view('jadwal.cetak', compact('jadwal', 'pesanan'));
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
            'rute_id' => 'required|exists:rutes,id',
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'sopir_id' => 'required|exists:sopirs,id',
            'tanggal' => 'required|date',
            'jam' => 'nullable'
        ]);

        $val['gambar'] = 'https://upload.wikimedia.org/wikipedia/commons/9/9e/Tugu_Siger.jpg';

        jadwal::where('id', $jadwal['id'])->update($val);
        return redirect()->route('jadwal.index')->with('success', 'Data Jadwal berhasil di Perbarui');
    }

    public function destroy(jadwal $jadwal)
    {
        //
    }
}
