@extends('layout.main')

@section('title','Edit Rute')

@section('content')
<br>
<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Form Edit Rute</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('rute.update', $rute['id']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="asal">Asal Perjalanan</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-map"></i></span>
                            <input type="text" name="asal" id="asal" value="{{ $rute['asal'] }}" class="form-control" placeholder="Masukan Asal Perjalanan" required>
                        </div>
                        @error('asal')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="tujuan">Tujuan Perjalanan</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-map-pin"></i></span>
                            <input type="text" name="tujuan" id="tujuan" value="{{ $rute['tujuan'] }}" class="form-control" placeholder="Masukan Tujuan Perjalanan" required>
                        </div>
                        @error('tujuan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="metode">Metode Perjalanan</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-transfer"></i></span>
                            <select name="metode" id="metode" class="form-control" required>
                                <option value="" disabled>Pilih Metode Perjalanan</option>
                                <option value="SHUTTLE" {{ $rute['metode'] == 'SHUTTLE' ? 'selected' : '' }}>SHUTTLE</option>
                                <option value="REGULAR" {{ $rute['metode'] == 'REGULAR' ? 'selected' : '' }}>REGULAR</option>
                                <option value="SEMI-SHUTTLE" {{ $rute['metode'] == 'SEMI-SHUTTLE' ? 'selected' : '' }}>SEMI-SHUTTLE</option>
                            </select>
                        </div>
                        @error('metode')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                <div class="mb-3">
                    <label class="form-label" for="harga">Harga Perjalanan</label>
                    <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-money"></i></span>
                    <input type="number" name="harga" id="harga" value="{{ $rute['harga'] }}" class="form-control" placeholder="Masukan Harga" required>
                    </div>
                    @error('harga')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="estimasi_waktu">Estimasi Perjalanan</label>
                    <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-time-five"></i></span>
                    <input type="text" name="estimasi_waktu" id="estimasi_waktu" value="{{ $rute['estimasi_waktu'] }}" class="form-control" placeholder="Masukan Estimasi Waktu" required>
                    </div>
                    @error('estimasi_waktu')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group text-right mt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ url('rute') }}" class="btn btn-transparant">Batal</a>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
