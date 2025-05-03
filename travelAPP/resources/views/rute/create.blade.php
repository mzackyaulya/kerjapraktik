@extends('layout.main')

@section('title','Tambah Rute')

@section('content')
<br>
<div class="card">
    <div class="card-header">
      <div class="card-title">Form Tambah Rute</div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-4 col-lg-4">
            <form method="POST" action="{{ route('rute.store') }}" class="forms-sample" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="asal">Asal Perjalanan</label>
                    <input type="text" class="form-control" id="asal" name="asal" placeholder="Masukan Asal Perjalanan">
                    @error('asal')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tujuan">Tujuan Perjalanan</label>
                    <input type="text" class="form-control" id="tujuan" name="tujuan" placeholder="Masukan Tujuan Perjalanan">
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
                    <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukan Harga Perjalanan">
                    @error('harga')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="estimasi_waktu">Estimasi Perjalanan</label>
                    <input type="text" class="form-control" id="estimasi_waktu" name="estimasi_waktu" placeholder="Masukan estimasi Perjalanan">
                    @error('estimasi_waktu')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ url('rute') }}" class="btn btn-light">Batal</a>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection
