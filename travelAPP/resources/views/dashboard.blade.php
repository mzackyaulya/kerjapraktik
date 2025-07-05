@extends('layout.main')

@section('title','Beranda')

@section('content')
<div class="py-8">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <h1 class="text-4xl font-bold text-gray-800 mb-3 mt-4 fas fa-home">Beranda</h1>
        <!-- Statistik Ringkas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded shadow text-center">
                <h3 class="text-xl font-semibold mb-2">Total Sopir</h3>
                <p class="text-3xl text-blue-600">2</p>
            </div>
            <div class="bg-white p-6 rounded shadow text-center">
                <h3 class="text-xl font-semibold mb-2">Jadwal Aktif Hari Ini</h3>
                <p class="text-3xl text-blue-600">5</p>
            </div>
            <div class="bg-white p-6 rounded shadow text-center">
                <h3 class="text-xl font-semibold mb-2">Pendapatan Bulan Ini</h3>
                <p class="text-3xl text-blue-600">Rp 8.500.000</p>
            </div>
        </div>
    </div>
    <div class="mb-8 text-center mb-4 mt-4">
            <img src="{{ asset('foto/BackgroundDesktop.png') }}" alt="Banner Travel" class="w-full rounded shadow-md" / width="900px">
        </div>
</div>
@endsection
