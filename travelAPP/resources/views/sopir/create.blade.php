@extends('layout.main')

@section('title','Tambah Sopir')

@section('content')
<br>
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card p-4 shadow" style="max-width: 600px; width: 100%;">
        <div class="card-header mb-3">
            <h5 class="card-title mb-0">Form Tambah Sopir</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('sopir.store') }}" class="forms-sample" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Sopir">
                    @error('nama')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat Sopir">
                    @error('alamat')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nohp">No HP</label>
                    <input type="number" class="form-control" id="nohp" name="nohp" placeholder="Masukan No HP Sopir">
                    @error('nohp')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nosim">No Sim</label>
                    <input type="text" class="form-control" id="nosim" name="nosim" placeholder="Masukan No Sim Sopir">
                    @error('nosim')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Nonaktif" {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group text-right mt-3">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ url('sopir') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
