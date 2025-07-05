@extends('layout.main')

@section('title', 'Edit Pemesanan')

@section('content')
<br>
<div class="card m-4 p-3">
    <div class="card-header mb-3">
        <h5 class="card-title mb-0">Form Edit Pemesanan Tiket</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('pesan.update', $pesan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Pilih Jadwal -->
            <div class="mb-3">
                <label for="jadwal_id" class="form-label">Pilih Jadwal</label>
                <select name="jadwal_id" id="jadwal_id" class="form-control" required>
                    <option value="">-- Pilih Jadwal --</option>
                    @foreach($jadwal as $item)
                        <option value="{{ $item->id }}"
                            {{ $pesan->jadwal_id == $item->id ? 'selected' : '' }}>
                            {{ $item->rute['asal'] }} ke {{ $item->rute['tujuan'] }} | {{ $item->tanggal }} {{ $item->jam }} | Metode: {{ $item->rute['metode'] }} | Harga: Rp. {{ number_format($item->rute['harga'], 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                @error('jadwal_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Nama Pemesan -->
            <div class="mb-3">
                <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
                <input type="text" name="nama_pemesan" class="form-control" value="{{ old('nama_pemesan', $pesan->nama_pemesan) }}" required>
                @error('nama_pemesan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- No HP -->
            <div class="mb-3">
                <label for="nohp" class="form-label">Nomor HP</label>
                <input type="text" name="nohp" class="form-control" value="{{ old('nohp', $pesan->nohp) }}" required>
                @error('nohp')
                    <small class="text-danger">{{ $message }}</small>

                    @enderror
            </div>

            <!-- Alamat -->
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $pesan->alamat) }}" required>
                @error('alamat')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Nomor Kursi (Seet) -->
            <div class="mb-3">
                <label for="seet" class="form-label">Nomor Kursi</label>
                <input type="text" name="seet" class="form-control" value="{{ old('seet', $pesan->seet) }}" required>
                @error('seet')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Jumlah Orang -->
            <div class="mb-3">
                <label for="jumlah_orang" class="form-label">Jumlah Orang</label>
                <input type="number" name="jumlah_orang" class="form-control" value="{{ old('jumlah_orang', $pesan->jumlah_orang) }}" min="1" required>
                @error('jumlah_orang')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Pending" {{ old('status', $pesan->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Dikonfirmasi" {{ old('status', $pesan->status) == 'Dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                    <option value="Batal" {{ old('status', $pesan->status) == 'Batal' ? 'selected' : '' }}>Batal</option>
                </select>
                @error('status')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Tombol -->
            <button type="submit" class="btn btn-success col-12">Update Pemesanan</button>
            <a href="{{ route('pesan.index') }}" class="btn btn-secondary col-12 mt-2">Kembali</a>
        </form>
    </div>
</div>
@endsection
