<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\jadwal;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah jadwal aktif berdasarkan tanggal hari ini
        $jadwalHariIni = jadwal::whereDate('tanggal', Carbon::today())->count();

        // Kirim ke view dashboard.blade.php
        return view('dashboard', compact('jadwalHariIni'));
    }
}
