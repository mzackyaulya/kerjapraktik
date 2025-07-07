@extends('layout.main')

@section('title', 'Tambah Pemesanan')

@section('content')
<br>
<div class="card m-4 p-3">
    <div class="card-header mb-3">
        <h5 class="card-title mb-0">Form Tambah Pemesanan Tiket</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('pesan.store', $selectedJadwal ? $selectedJadwal->id : '') }}" method="POST">
            @csrf

            <!-- Pilih Jadwal -->
            <div class="mb-3">
                <label for="jadwal_id" class="form-label">Pilih Jadwal</label>
                <select name="jadwal_id" id="jadwal_id" class="form-control" required>
                    <option value="">-- Pilih Jadwal --</option>
                    @foreach($jadwal as $dataJadwal)
                        <option value="{{ $dataJadwal->id }}"
                            {{ isset($selectedJadwal) && $selectedJadwal->id == $dataJadwal->id ? 'selected' : '' }}>
                            {{ $dataJadwal->rute['asal'] }} ke {{ $dataJadwal->rute['tujuan'] }} | {{ $dataJadwal->tanggal }} {{ $dataJadwal->jam }} | Metode: {{ $dataJadwal->rute['metode'] }} | Harga: Rp. {{ number_format($dataJadwal->rute['harga'], 0, ',', '.') }}
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
                <input type="text" name="nama_pemesan" class="form-control" value="{{ old('nama_pemesan') }}" required>
                @error('nama_pemesan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Nomor HP -->
            <div class="mb-3">
                <label for="nohp" class="form-label">Nomor HP</label>
                <input type="text" name="nohp" class="form-control" value="{{ old('nohp') }}" required>
                @error('nohp')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Alamat -->
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ old('alamat') }}" required>
                @error('alamat')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Jumlah Orang -->
            <div class="mb-3">
                <label for="jumlah_orang" class="form-label">Jumlah Orang</label>
                <input type="number" name="jumlah_orang" id="jumlah_orang" class="form-control" value="{{ old('jumlah_orang') }}" min="1" required>
                @error('jumlah_orang')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Pilih Kursi -->
            <div class="mb-3">
                <label class="form-label">Pilih Kursi (Sesuai Jumlah Orang)</label>
                <div class="row row-cols-4 g-2">
                    @foreach($kursiTersedia as $kursi)
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input kotak-kursi" type="checkbox" name="seet[]" value="{{ $kursi }}" id="kursi{{ $kursi }}" disabled>
                                <label class="form-check-label" for="kursi{{ $kursi }}">
                                    {{ $kursi }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <small id="info-kursi-terpilih" class="text-muted mt-2 d-block">Masukkan jumlah orang untuk mengaktifkan pilihan kursi.</small>
                @error('seet')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Tombol -->
            <button type="submit" class="btn btn-primary col-12">Pesan</button>
            <a href="{{ route('pesan.index') }}" class="btn btn-secondary col-12 mt-2">Kembali</a>
        </form>
    </div>
</div>

<!-- Script Validasi Kursi -->
<script>
    const inputJumlahOrang = document.querySelector('#jumlah_orang');
    const checkboxKursi = document.querySelectorAll('.kotak-kursi');
    const infoKursi = document.getElementById('info-kursi-terpilih');

    function perbaruiKursi() {
        const jumlahMaks = parseInt(inputJumlahOrang.value) || 0;
        const kursiDipilih = [...checkboxKursi].filter(cb => cb.checked);

        if (!jumlahMaks || jumlahMaks <= 0) {
            checkboxKursi.forEach(cb => {
                cb.checked = false;
                cb.disabled = true;
            });
            infoKursi.textContent = 'Masukkan jumlah orang untuk mengaktifkan pilihan kursi.';
            infoKursi.className = 'text-muted mt-1 d-block';
            return;
        }

        // Aktifkan semua checkbox
        checkboxKursi.forEach(cb => cb.disabled = false);

        // Batasi jika sudah maksimal
        if (kursiDipilih.length >= jumlahMaks) {
            checkboxKursi.forEach(cb => {
                if (!cb.checked) cb.disabled = true;
            });
        } else {
            checkboxKursi.forEach(cb => cb.disabled = false);
        }

        infoKursi.textContent = `Kursi dipilih: ${kursiDipilih.length} dari ${jumlahMaks}`;
        infoKursi.className = kursiDipilih.length > jumlahMaks ? 'text-danger mt-1 d-block' : 'text-primary mt-1 d-block';
    }

    inputJumlahOrang.addEventListener('input', perbaruiKursi);
    checkboxKursi.forEach(cb => cb.addEventListener('change', perbaruiKursi));
    perbaruiKursi(); // panggil saat awal
</script>
@endsection
