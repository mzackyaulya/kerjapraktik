@extends('layout.main')

@section('title','Tambah Jadwal')

@section('content')
<br>
<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Form Tambah Jadwal</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('jadwal.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="rute_id">Rute</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-map"></i></span>
                            <select class="form-control" name="rute_id" id="rute_id">
                                <option value="">Pilih Rute</option>
                                @foreach ($rute as $items)
                                    <option value="{{$items['id']}}" {{ old('rute_id') == $items['id'] ? 'selected' : '' }}>
                                        {{ $items['asal'] }} - {{ $items['tujuan'] }} - {{ $items['metode'] }} - {{ $items['harga'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('rute_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="kendaraan_id">Kendaraan</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-car"></i></span>
                            <select class="form-control" name="kendaraan_id" id="kendaraan_id">
                                <option value="">Pilih Kendaraan</option>
                                @foreach ($kendaraan as $items)
                                    <option value="{{$items['id']}}" {{ old('kendaraan_id') == $items['id'] ? 'selected' : '' }}>
                                        {{ $items['merk_mobil'] }} - {{ $items['warna'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('kendaraan_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="sopir_id">Sopir</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-user-pin"></i></span>
                            <select class="form-control" name="sopir_id" id="sopir_id">
                                <option value="">Pilih Sopir</option>
                                @foreach ($sopir as $items)
                                    <option value="{{$items['id']}}" {{ old('sopir_id') == $items['id'] ? 'selected' : '' }}>
                                        {{ $items['nama'] }} - {{ $items['alamat'] }} - {{ $items['status'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('sopir_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="tanggal">Tanggal Jadwal</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}" class="form-control" required>
                        </div>
                        @error('tanggal')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="jam">Jam Jadwal</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-time"></i></span>
                            <input type="time" name="jam" id="jam" value="{{ old('jam') }}" class="form-control" required>
                        </div>
                        @error('jam')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group text-right mt-3">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ url('jadwal') }}" class="btn btn-transparant">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
