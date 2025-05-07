@extends('layout.main')

@section('title','Edit Kendaraan')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card p-4 shadow" style="max-width: 600px; width: 100%;">
        <div class="card-header mb-3">
            <h5 class="card-title mb-0">Form Edit Kendaraan</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('kendaraan.update', $kendaraan['id']) }}" class="forms-sample" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="noplat">No Plat</label>
                <input type="text" class="form-control" id="noplat" name="noplat" value="{{old('noplat') ? old('noplat'): $kendaraan['noplat'] }}">
                @error('noplat')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="merk_mobil">Merk Kendaraan</label>
                <input type="text" class="form-control" id="merk_mobil" name="merk_mobil" value="{{old('merk_mobil') ? old('merk_mobil'): $kendaraan['merk_mobil'] }}">
                @error('merk_mobil')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="warna">Warna</label>
                <input type="text" class="form-control" id="warna" name="warna" value="{{old('warna') ? old('warna'): $kendaraan['warna'] }}">
                @error('warna')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="kapasitas">Kapasitas</label>
                <input type="text" class="form-control" id="kapasitas" name="kapasitas" value="{{old('kapasitas') ? old('kapasitas'): $kendaraan['kapasitas'] }}">
                @error('kapasitas')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="Ready" {{ old('status', $kendaraan['status']) == 'Ready' ? 'selected' : '' }}>Ready</option>
                    <option value="Perbaikan" {{ old('status', $kendaraan['status']) == 'Perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                </select>
                @error('status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group text-right mt-3">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ url('kendaraan') }}" class="btn btn-secondary">Batal</a>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
