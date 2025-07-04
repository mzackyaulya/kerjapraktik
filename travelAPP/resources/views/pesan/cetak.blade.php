<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tiket Travel</title>
    <style>
        @page {
            size: 20cm 6cm;
            margin: 0;
        }

        html, body {
            margin: 0;
            padding: 0;
            background: #fff;
            font-family: Arial, sans-serif;
        }

        .ticket-box {
            width: 20cm;
            height: 6cm;
            padding: 10px 20px;
            border: 1px solid #007bff;
            box-sizing: border-box;
            display: flex;
            justify-content: space-between;
            position: relative;
        }

        .left-info {
            width: 65%;
            font-size: 12px;
        }

        .left-info h2 {
            color: #007bff;
            margin: 0;
            font-size: 16px;
        }

        .left-info p {
            margin: 2px 0;
        }

        .detail-table td {
            padding: 2px 4px;
        }

        .detail-table td:first-child {
            font-weight: bold;
            width: 90px;
        }

        .right-info {
            width: 30%;
            text-align: center;
        }

        .right-info img {
            width: 60px;
        }

        .rute {
            font-size: 10px;
            margin-top: 5px;
            color: #007bff;
        }

        .signature {
            font-size: 11px;
            text-align: right;
            margin-top: 5px;
            position: absolute;
            bottom: 10px;
            right: 30px;
        }


        .signature-line {
            width: 120px;
            margin-left: auto;
            margin-top: 50px;
            border-top: 1px solid #000;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="ticket-box">
        <div class="left-info">
            <h2>RAMA TRANZ</h2>
            <p>Jl. Mayor Santoso No.3112, Palembang</p>
            <p>0812 1545 6258</p>

            <table class="detail-table">
                <tr><td>Nama</td><td>: {{ $pesan->nama_pemesan }}</td></tr>
                <tr><td>Tujuan</td><td>: {{ $pesan->jadwal->rute->tujuan }}</td></tr>
                <tr><td>Dari</td><td>: {{ $pesan->jadwal->rute->asal }}</td></tr>
                <tr><td>Berangkat</td><td>: {{ \Carbon\Carbon::parse($pesan->jadwal->tanggal)->format('d-m-Y') }} {{ $pesan->jadwal->jam }}</td></tr>
                <tr><td>Kursi</td><td>: {{ $pesan->seet }}</td></tr>
                <tr><td>Polisi</td><td>: {{ $pesan->jadwal->kendaraan->plat_nomor ?? '-' }}</td></tr>
                <tr><td>Tarif</td><td>: Rp {{ number_format($pesan->harga_total, 0, ',', '.') }}</td></tr>
                <tr>
                    <td>Posisi</td>
                    <td>
                        <label><input type="checkbox" {{ str_contains(strtolower($pesan->seet), 'depan') ? 'checked' : '' }}> Depan</label>
                        <label><input type="checkbox" {{ str_contains(strtolower($pesan->seet), 'tengah') ? 'checked' : '' }}> Tengah</label>
                        <label><input type="checkbox" {{ str_contains(strtolower($pesan->seet), 'belakang') ? 'checked' : '' }}> Belakang</label>
                    </td>
                </tr>
            </table>

            <div class="signature"><br><br><br>
                Hormat Kami,
                <div class="signature-line"></div>
            </div>
        </div>

        <div class="right-info">
            <img src="{{ asset('foto/icon.png') }}" alt="Logo">
            <div class="rute">
                Melayani Rute<br>
                {{ strtoupper($pesan->jadwal->rute->asal) }} - {{ strtoupper($pesan->jadwal->rute->tujuan) }}
            </div>
        </div>
    </div>
</body>
</html>
