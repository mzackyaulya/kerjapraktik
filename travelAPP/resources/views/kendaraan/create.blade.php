@extends('layout.main')

@section('title','Tambah Kendaraan')

@section('content')
<br>
<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Form Tambah Kendaraan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('kendaraan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="noplat">No Plat</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-car"></i></span>
                            <input type="text" name="noplat" id="noplat" value="{{ old('noplat') }}" class="form-control" placeholder="Masukan No Plat Kendaraan" required>
                        </div>
                        @error('noplat')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="merk_mobil">Merk Kendaraan</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-car"></i></span>
                            <input type="text" name="merk_mobil" id="merk_mobil" value="{{ old('merk_mobil') }}" class="form-control" placeholder="Masukan Merk Kendaraan" required>
                        </div>
                        @error('merk_mobil')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="warna">Warna</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-palette"></i></span>
                            <input type="text" name="warna" id="warna" value="{{ old('warna') }}" class="form-control" placeholder="Masukan Warna Kendaraan" required>
                        </div>
                        @error('warna')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="kapasitas">Kapasitas</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-group"></i></span>
                            <input type="number" name="kapasitas" id="kapasitas" value="{{ old('kapasitas') }}" class="form-control" placeholder="Masukan Kapasitas Kendaraan" required>
                        </div>
                        @error('kapasitas')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="status">Status Kendaraan</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-list-check"></i></span>
                            <select name="status" id="status" class="form-control" required>
                                <option value="" disabled {{ old('status') == '' ? 'selected' : '' }}>Pilih Status</option>
                                <option value="Ready" {{ old('status') == 'Ready' ? 'selected' : '' }}>Ready</option>
                                <option value="Perbaikan" {{ old('status') == 'Perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                            </select>
                        </div>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group text-right mt-3">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ url('kendaraan') }}" class="btn btn-transparant">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
