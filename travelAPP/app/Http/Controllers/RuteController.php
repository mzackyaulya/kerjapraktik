<?php

namespace App\Http\Controllers;

use App\Models\rute;
use Illuminate\Http\Request;

class RuteController extends Controller
{
    public function index()
    {
        $rute = rute::all();
        return view('rute.index')->with('rute',$rute );
    }

    public function create()
    {
        $rute = rute::all();
        return view('rute.create')->with('rute',$rute );
    }

    public function store(Request $request)
    {
        if ($request->user()->cannot('create', rute::class)){
            abort(403);
        }
        $val = $request->validate([
            'asal'          => 'required|max:45',
            'tujuan'        => 'required|max:45',
            'metode'        => 'required|max:45',
            'harga'         => 'required|max:45',
            'estimasi_waktu'=> 'required|max:45'
        ]);

        Rute::create($val);
        return redirect()->route('rute.index')->with('success','Data Rute berhasil di Tambahkan');
    }

    public function show(rute $rute)
    {
        //
    }

    public function edit(rute $rute, $id)
    {
        $rute = Rute::findOrFail($id);
        return view('rute.edit')->with('rute', $rute);
    }

    public function update(Request $request, rute $rute,$id)
    {
        $this->authorize('update', $rute);
        $rute = rute::findOrFail($id);

        $val = $request->validate([
            'asal'          => 'required|max:45',
            'tujuan'        => 'required|max:45',
            'metode'        => 'required|max:45',
            'harga'         => 'required|max:45',
            'estimasi_waktu'=> 'required|max:45'
        ]);

        $rute->update($val);
        return redirect()->route('rute.index')->with('success','Data Rute berhasil di Perbarui');
    }

    public function destroy(rute $rute)
    {
        //
    }
}
