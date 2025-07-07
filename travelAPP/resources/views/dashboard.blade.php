@extends('layout.main')

@section('title', 'Beranda')

@section('content')
<div class="py-4 space-y-4">
    <div class="flex justify-center">
        <div class="bg-white border border-gray-200 shadow-md rounded-lg px-6 py-4 w-full max-w-sm text-center">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Jadwal Aktif Hari Ini</h2>
            <p class="text-3xl font-bold text-blue-600">{{ $jadwalHariIni }}</p>
        </div>
    </div>
    <div class="text-center mt-3">
        <img src="{{ asset('foto/jadwal.jpg') }}" alt="Banner Jadwal"
             class="rounded shadow-md w-full max-w-md mx-auto" width="430px">
        <img src="{{ asset('foto/seet.jpg') }}" alt="Banner Seat"
             class="rounded shadow-md w-full max-w-md mx-auto" width="430px">
    </div>
</div>
@endsection
