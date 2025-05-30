<?php

namespace App\Http\Controllers;

use App\Models\kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraan = kendaraan::all();
        return view('kendaraan.index')->with('kendaraan', $kendaraan);
    }

    public function create()
    {
        $kendaraan = kendaraan::all();
        return view('kendaraan.create')->with('kendaraan', $kendaraan);
    }

    public function store(Request $request)
    {
        if ($request->user()->cannot('create', kendaraan::class)){
            abort(403);
        }
        $val = $request->validate([
            'noplat'        => 'required|string|max:45',
            'merk_mobil'    => 'required|string|max:20',
            'warna'         => 'required|string|max:20',
            'kapasitas'     => 'required|string|max:45',
            'status'        => 'required|in:Ready,Perbaikan'
        ]);

        kendaraan::create($val);
        return redirect()->route('kendaraan.index')->with('success', 'Data Kendaraan berhasil di Tambahkan');
    }

    public function show(kendaraan $kendaraan)
    {
        //
    }

    public function edit(kendaraan $kendaraan,$id)
    {
        $kendaraan = kendaraan::findOrFail($id);
        return view('kendaraan.edit')->with('kendaraan', $kendaraan);
    }

    public function update(Request $request, kendaraan $kendaraan,$id)
    {
        $this->authorize('update', $kendaraan);
        $kendaraan = kendaraan::findOrFail($id);
        
        $val = $request->validate([
            'noplat'        => 'required|string|max:45',
            'merk_mobil'    => 'required|string|max:20',
            'warna'         => 'required|string|max:20',
            'kapasitas'     => 'required|string|max:45',
            'status'        => 'required|in:Ready,Perbaikan'
        ]);

        $kendaraan->update($val);
        return redirect()->route('kendaraan.index')->with('success', 'Data Kendaraan berhasil di Perbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function destroy(kendaraan $kendaraan)
    {
        //
    }
}
