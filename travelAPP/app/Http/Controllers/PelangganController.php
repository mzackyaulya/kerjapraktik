<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Kalau admin, tampilkan semua user dengan role 'U'
        if ($user->role === 'A') {
            $pelanggan = User::where('role', 'U')->get();
        } else {
            // Kalau pelanggan, tampilkan datanya sendiri
            $pelanggan = User::where('id', $user->id)->get();
        }

        return view('pelanggan.index')->with('pelanggan', $pelanggan);
    }

    public function edit($id)
    {
        $pelanggan = User::findOrFail($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'nohp' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pelanggan = User::findOrFail($id);
        $pelanggan->update($request->only('name', 'email', 'alamat', 'nohp'));

        if ($request->hasFile('foto')) {
            $fotoName = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('foto/pelanggan'), $fotoName);
            $pelanggan->update(['foto' => $fotoName]);
        }

        return redirect()->route('profile.index')->with('success', 'Data User berhasil diperbarui.');
    }
}
