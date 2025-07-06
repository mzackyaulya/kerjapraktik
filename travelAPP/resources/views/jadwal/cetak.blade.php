<!DOCTYPE html>
<html>
<head>
    <title>Cetak Data Pemesanan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        h2, h4 { margin: 0; padding: 0; }
        .info { margin-top: 10px; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="no-print">
        <button onclick="window.print()">🖨️ Cetak Sekarang</button>
    </div>

    <h2>Data Pemesanan</h2>
    <h4>Rute: {{ $jadwal->rute->asal }} ke {{ $jadwal->rute->tujuan }} ({{ $jadwal->rute->metode }})</h4>
    <div class="info">
        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d-m-Y') }}</p>
        <p><strong>Jam:</strong> {{ $jadwal->jam }}</p>
        <p><strong>Kendaraan:</strong> {{ $jadwal->kendaraan->merk_mobil }}</p>
        <p><strong>Sopir:</strong> {{ $jadwal->sopir->nama }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pemesan</th>
                <th>No HP</th>
                <th>No Kursi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pesanan as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_pemesan }}</td>
                    <td>{{ $item->nohp }}</td>
                    <td>{{ $item->seet }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada data pemesanan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
