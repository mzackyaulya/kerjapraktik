@extends('layout.main')

@section('title','Tambah Sopir')

@section('content')
<br>
<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Form Tambah Sopir</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('sopir.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="nama">Nama Sopir</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-user"></i></span>
                            <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="form-control" placeholder="Masukan Nama Sopir" required>
                        </div>
                        @error('nama')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="alamat">Alamat Sopir</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-home"></i></span>
                            <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}" class="form-control" placeholder="Masukan Alamat Sopir" required>
                        </div>
                        @error('alamat')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="nohp">No HP Sopir</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-phone"></i></span>
                            <input type="number" name="nohp" id="nohp" value="{{ old('nohp') }}" class="form-control" placeholder="Masukan No HP Sopir" required>
                        </div>
                        @error('nohp')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="nosim">No SIM Sopir</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                            <input type="text" name="nosim" id="nosim" value="{{ old('nosim') }}" class="form-control" placeholder="Masukan No SIM Sopir" required>
                        </div>
                        @error('nosim')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="status">Status Sopir</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-list-check"></i></span>
                            <select name="status" id="status" class="form-control" required>
                                <option value="" disabled {{ old('status') == '' ? 'selected' : '' }}>Pilih Status Sopir</option>
                                <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Nonaktif" {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group text-right mt-3">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ url('sopir') }}" class="btn btn-transparant">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
