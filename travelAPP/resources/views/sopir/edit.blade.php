@extends('layout.main')

@section('title','Edit Sopir')

@section('content')
<br>
<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Form Edit Sopir</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('sopir.update', $sopir['id']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="nama">Nama Sopir</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-user"></i></span>
                            <input type="text" name="nama" id="nama" value="{{ $sopir['nama'] }}" class="form-control" placeholder="Masukan Nama Sopir" required>
                        </div>
                        @error('nama')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="nohp">No HP Sopir</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-phone"></i></span>
                            <input type="number" name="nohp" id="nohp" value="{{ $sopir['nohp'] }}" class="form-control" placeholder="Masukan No HP Sopir" required>
                        </div>
                        @error('nohp')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="status">Status Sopir</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-list-check"></i></span>
                            <select name="status" id="status" class="form-control" required>
                                <option value="" disabled {{ $sopir['status'] == '' ? 'selected' : '' }}>Pilih Status Sopir</option>
                                <option value="Aktif" {{ $sopir['status'] == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Nonaktif" {{ $sopir['status'] == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group text-right mt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ url('sopir') }}" class="btn btn-transparant">Batal</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
