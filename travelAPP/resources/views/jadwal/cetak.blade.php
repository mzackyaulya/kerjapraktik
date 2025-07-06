<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <title>Surat Jalan - RAMA TRANZ</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; margin: 20px; }
        .header { text-align: center; }
        .header img { width: 100px; }
        .judul { font-size: 44px; font-weight: bold; color: #7a3ff6; }
        .subjudul { font-size: 14px; font-weight: bold; margin-top: -10px; }
        .info-box { border: 2px solid #7a3ff6; padding: 5px; display: inline-block; width: 45%; margin: 5px; }
        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: center; }
        .total { margin-top: 10px; }
        .signature { display: flex; justify-content: space-between; margin-top: 40px; }
        .signature div { width: 40%; text-align: center; }
        .line { border-top: 2px solid #7a3ff6; margin-top: 30px; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>

<div class="no-print">
    <button onclick="window.print()">Cetak Surat</button>
</div>

<div class="header d-flex align-items-center justify-content-center mb-3">
    <div class="me-3">
        <img src="{{ url('foto/icon.png') }}" alt="Logo" style="width: 90px;">
    </div>
    <div class="text-center">
        <div class="judul">RAMA TRANZ</div>
        <div class="subjudul mt-2">PT. RASYA MANDIRI TRANZ</div>
        <div class="subjudul mt-2">BANDAR LAMPUNG - JAKARTA - PALEMBANG PP</div>
    </div>
</div>

<div class="line"></div>

<h3>SURAT JALAN</h3>
<p><strong>PLAT:</strong> {{ $jadwal->kendaraan->noplat ?? '-' }}</p>

<div style="display: flex; justify-content: space-between;">
    <div class="info-box">
        <p>Asal: {{ $jadwal->rute->asal }}</p>
        <p>Tanggal: {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d-m-Y') }}</p>
    </div>
    <div class="info-box">
        <p>Tujuan: {{ $jadwal->rute->tujuan }}</p>
        <p>Jam: {{ $jadwal->jam }}</p>
    </div>
</div>

<table>
    <thead style="background-color: #7ac0f3;">
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>No Telepon</th>
            <th>Alamat</th>
            <th>Tujuan</th>
            <th>Ongkos</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($pesanan as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nama_pemesan }}</td>
                <td>{{ $item->nohp }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->jadwal->rute->tujuan }}</td>
                <td>Rp. {{ number_format($item->jadwal->rute->harga, 0, ',', '.') }}</td>
            </tr>
        @empty
            @php $index = 0; @endphp
        @endforelse

        @for ($i = ($index ?? count($pesanan)); $i < 9; $i++)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>&nbsp;</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endfor
    </tbody>
</table>

<div class="total">
    <p>Penumpang {{ count($pesanan) }} x Rp. {{ number_format($jadwal->rute->harga ?? 0, 0, ',', '.') }} = Rp. {{ number_format(($pesanan->sum('harga_total') ?? 0), 0, ',', '.') }}</p>
    <p>Snack {{ count($pesanan) }} Rp. {{ number_format(count($pesanan) * 10000, 0, ',', '.') }}</p>
</div>

<div class="line"></div>

<div class="signature">
    <div>
        <strong>Pengemudi</strong><br><br><br><br>
        ({{ $jadwal->sopir->nama }})
    </div>
    <div>
        <strong>Kantor</strong><br><br><br><br>
        (.................................)
    </div>
</div>

</body>
</html>
