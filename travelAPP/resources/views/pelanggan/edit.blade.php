@extends('layout.main')

@section('title','Edit Data User')

@section('content')
<br>
<div class="row">
  <div class="col-xl">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Form Edit Data User</h5>
      </div>
      <div class="card-body">
        <form action="{{ route('pelanggan.update', $pelanggan['id']) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Nama Lengkap</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-user"></i></span>
              <input type="text" name="name" id="name" value="{{ $pelanggan['name'] }}" class="form-control" placeholder="Masukan Nama Lengkap" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label" for="basic-default-email">Email</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-envelope"></i></span>
              <input type="email" name="email" value="{{ $pelanggan['email'] }}" class="form-control" placeholder="Email" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label" for="basic-default-alamat">Alamat</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-home"></i></span>
              <input type="text" name="alamat" value="{{ $pelanggan->alamat }}" class="form-control" placeholder="Alamat" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label" for="basic-default-phone">No HP</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-phone"></i></span>
              <input type="text" name="nohp" value="{{ $pelanggan->nohp }}" class="form-control phone-mask" placeholder="08xxxxxxxxxx" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label" for="basic-default-foto">Foto</label>
            <input type="file" name="foto" class="form-control">
            @if($pelanggan->foto)
              <small class="text-muted">Foto sekarang:</small><br>
              <img src="{{ asset('foto/pelanggan/' . $pelanggan->foto) }}" alt="Foto" width="100" class="mt-2">
            @endif
          </div>

          <button type="submit" class="btn btn-primary">Update</button>
          <a href="{{ url('pelanggan') }}" class="btn btn-transparant">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
