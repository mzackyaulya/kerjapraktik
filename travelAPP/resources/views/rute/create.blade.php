@extends('layout.main')

@section('title','Tambah Rute')

@section('content')
<br>
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card p-4 shadow" style="max-width: 600px; width: 100%;">
        <div class="card-header mb-3">
            <h5 class="card-title mb-0">Form Tambah Rute</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('rute.store') }}" class="forms-sample" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="asal">Asal Perjalanan</label>
                <input type="text" class="form-control" id="asal" name="asal" value="{{ old('asal')}}" placeholder="Masukan Asal Perjalanan">
                @error('asal')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="tujuan">Tujuan Perjalanan</label>
                <input type="text" class="form-control" id="tujuan" name="tujuan" value="{{ old('tujuan')}}" placeholder="Masukan Tujuan Perjalanan">
                @error('tujuan')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="metode">Metode Perjalanan</label>
                <select name="metode" id="metode" class="form-control">
                <option value="Pilih Metode Perjalanan" readonly>Pilih Metode Perjalanan</option>
                <option value="SHUTTLE">SHUTTLE</option>
                <option value="REGULAR">REGULAR</option>
                <option value="SEMI-SHUTTLE">SEMI-SHUTTLE</option>
                </select>
                @error('metode')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="harga">Harga Perjalanan</label>
                <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga')}}" placeholder="Masukan Harga Perjalanan">
                @error('harga')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="estimasi_waktu">Estimasi Perjalanan</label>
                <input type="text" class="form-control" id="estimasi_waktu" value="{{ old('estimasi_waktu')}}" name="estimasi_waktu" placeholder="Masukan estimasi Perjalanan">
                @error('estimasi_waktu')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group text-right mt-3">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ url('rute') }}" class="btn btn-secondary">Batal</a>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
