<?php

namespace App\Http\Controllers;

use App\Models\rute;
use Illuminate\Http\Request;

class RuteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rute = rute::all();
        return view('rute.index')
            ->with('rute',$rute );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rute = rute::all();
        return view('rute.create')
            ->with('rute',$rute );
    }

    public function store(Request $request)
    {
        $val = $request->validate([
            'asal'          => 'required|max:45',
            'tujuan'        => 'required|max:45',
            'metode'        => 'required|max:45',
            'harga'         => 'required|max:45',
            'estimasi_waktu'=> 'required|max:45'
        ]);

        Rute::create($val);
        return redirect()->route('rute.index')->with('success', $val['tujuan']. ' berhasil di Simpan');
    }

    public function show(rute $rute)
    {
        //
    }

    public function edit(rute $rute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rute $rute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function destroy(rute $rute)
    {
        //
    }
}
