<?php

namespace App\Http\Controllers;

use App\Models\sopir;
use Illuminate\Http\Request;

class SopirController extends Controller
{

    public function index()
    {
        $sopir = sopir::all();
        return view('sopir.index')->with('sopir', $sopir);
    }

    public function create()
    {
        $sopir = sopir::all();
        return view('sopir.create')->with('sopir', $sopir);
    }

    public function store(Request $request)
    {
        $val = $request -> validate([
            'nama'   => 'required|string|max:45',
            'nohp'  => 'required|string|max:20',
            'alamat' => 'required',
            'nosim' => 'nullable|string|max:45',
            'status' => 'required|in:Aktif,Nonaktif'
        ]);

        sopir::create($val);
        return redirect()->route('sopir.index')->with('success', 'Data sopir berhasil di Tambahkan');
    }

    public function show(sopir $sopir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sopir  $sopir
     * @return \Illuminate\Http\Response
     */
    public function edit(sopir $sopir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sopir  $sopir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sopir $sopir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sopir  $sopir
     * @return \Illuminate\Http\Response
     */
    public function destroy(sopir $sopir)
    {
        //
    }
}
