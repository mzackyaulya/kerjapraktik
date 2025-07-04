@extends('layout.main')

@section('title', 'Detail Pemesanan')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-white">
                <i class="fas fa-ticket-alt me-2"></i> Detail Pemesanan Tiket
            </h4>
            <a href="{{ route('pesan.index') }}" class="btn btn-light btn-sm">
                Kembali
            </a>
        </div>

        <div class="card-body mt-3">
            <!-- Informasi Jadwal -->
            <h6 class="text-uppercase text-muted mb-3">Informasi Jadwal</h6>
            <table class="table table-borderless mb-4">
                <tr>
                    <td style="width: 200px;"><strong>Rute</strong></td>
                    <td>: {{ $pesan['jadwal']['rute']['asal'] }} - {{ $pesan['jadwal']['rute']['tujuan'] }}</td>
                </tr>
                <tr>
                    <td><strong>Tanggal</strong></td>
                    <td>: {{ \Carbon\Carbon::parse($pesan['jadwal']['tanggal'])->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td><strong>Jam</strong></td>
                    <td>: {{ $pesan['jadwal']['jam'] }}</td>
                </tr>
                <tr>
                    <td><strong>Metode</strong></td>
                    <td>: {{ $pesan['jadwal']['rute']['metode'] }}</td>
                </tr>
                <tr>
                    <td><strong>Harga per Orang</strong></td>
                    <td>: Rp {{ number_format($pesan['jadwal']['rute']['harga'], 0, ',', '.') }}</td>
                </tr>
            </table>

            <!-- Informasi Pemesan -->
            <h6 class="text-uppercase text-muted mb-3">Informasi Pemesan</h6>
            <table class="table table-borderless">
                <tr>
                    <td style="width: 200px;"><strong>Nama Pemesan</strong></td>
                    <td>: {{ $pesan['nama_pemesan'] }}</td>
                </tr>
                <tr>
                    <td><strong>Nomor HP</strong></td>
                    <td>: {{ $pesan['nohp'] }}</td>
                </tr>
                <tr>
                    <td><strong>Alamat</strong></td>
                    <td>: {{ $pesan['alamat'] }}</td>
                </tr>
                <tr>
                    <td><strong>Nomor Kursi</strong></td>
                    <td>: {{ $pesan['seet'] }}</td>
                </tr>
                <tr>
                    <td><strong>Jumlah Orang</strong></td>
                    <td>: {{ $pesan['jumlah_orang'] }}</td>
                </tr>
                <tr>
                    <td><strong>Harga Total</strong></td>
                    <td>: <span class="text-success fw-bold">Rp {{ number_format($pesan['harga_total'], 0, ',', '.') }}</span></td>
                </tr>
                <tr>
                    <td><strong>Status</strong></td>
                    <td>:
                        @if($pesan['status'] === 'Pending')
                            <span class="badge bg-warning text-dark"><i class="fas fa-hourglass-half me-1"></i>Pending</span>
                        @elseif($pesan['status'] === 'Dikonfirmasi')
                            <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Dikonfirmasi</span>
                        @else
                            <span class="badge bg-secondary">{{ $pesan['status'] }}</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
