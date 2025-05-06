@extends('layout.main')

@section('title','Tambah Kendaraan')

@section('content')
<br>
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card p-4 shadow" style="max-width: 600px; width: 100%;">
        <div class="card-header mb-3">
            <h5 class="card-title mb-0">Form Tambah Kendaraan</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('kendaraan.store') }}" class="forms-sample" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="noplat">No Plat</label>
                    <input type="text" class="form-control" id="noplat" name="noplat" value="{{ old('noplat')}}" placeholder="Masukan No Plat Kendaraan">
                    @error('noplat')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="merk_mobil">Merk Kendaraan</label>
                    <input type="text" class="form-control" id="merk_mobil" name="merk_mobil" value="{{ old('merk_mobil')}}" placeholder="Masukan Merk Kendaraan">
                    @error('merk_mobil')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="warna">Warna</label>
                    <input type="text" class="form-control" id="warna" name="warna" value="{{ old('warna')}}" placeholder="Masukan Warna Kendaraan">
                    @error('warna')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kapasitas">Kapasitas</label>
                    <input type="number" class="form-control" id="kapasitas" name="kapasitas" value="{{ old('kapasitas')}}" placeholder="Masukan Kapasitas Kendaraan">
                    @error('kapasitas')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="Ready" {{ old('status') == 'Ready' ? 'selected' : '' }}>Ready</option>
                        <option value="Perbaikan" {{ old('status') == 'Perbaikan' ? 'selected' : '' }}>Perbaikan</option>
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
