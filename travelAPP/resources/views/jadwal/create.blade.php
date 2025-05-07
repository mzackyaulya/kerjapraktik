@extends('layout.main')

@section('title','Tambah Jadwal')

@section('content')
<br>
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card p-4 shadow" style="max-width: 600px; width: 100%;">
        <div class="card-header mb-3">
            <h5 class="card-title mb-0">Form Tambah Jadwal</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('jadwal.store') }}" class="forms-sample" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="rute_id">Rute</label>
                    <select class="form-control" name="rute_id" id="rute_id">
                        <option value="">Pilih Rute</option>
                        @foreach ($rute as $items)
                            <option value="{{$items['id']}}" {{ old('rute_id') == $items['id'] ? 'selected' : '' }}>
                                {{$items['asal']}} - {{ $items['tujuan'] }} - {{ $items['metode'] }} - {{ $items['harga'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('rute_id')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kendaraan_id">Kendaraan</label>
                    <select class="form-control" name="kendaraan_id" id="kendaraan_id">
                        <option value="">Pilih Kendaraan</option>
                        @foreach ($kendaraan as $items)
                            <option value="{{$items['id']}}" {{ old('kendaraan_id') == $items['id'] ? 'selected' : '' }}>
                                {{$items['merk_mobil']}} - {{$items['warna']}}
                            </option>
                        @endforeach
                    </select>
                    @error('kendaraan_id')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sopir_id">Sopir</label>
                    <select class="form-control" name="sopir_id" id="sopir_id">
                        <option value="">Pilih Sopir</option>
                        @foreach ($sopir as $items)
                            <option value="{{$items['id']}}" {{ old('sopir_id') == $items['id'] ? 'selected' : '' }}>
                                {{$items['nama']}} - {{$items['alamat']}} - {{$items['status']}}
                            </option>
                        @endforeach
                    </select>
                    @error('sopir_id')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal Jadwal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal')}}" placeholder="Masukan tanggal Jadwal">
                    @error('tanggal')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jam">Jam Jadwal</label>
                    <input type="time" class="form-control" id="jam" name="jam" value="{{ old('jam')}}" placeholder="Masukan jam Jadwal">
                    @error('jam')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="gambar">URL Gambar</label>
                    <input type="text" class="form-control" id="gambar" name="gambar" value="{{ old('gambar')}}" placeholder="Masukan Url gambar Jadwal">
                    @error('gambar')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group text-right mt-3">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ url('jadwal') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
