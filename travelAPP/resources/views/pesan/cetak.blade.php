<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Cetak Tiket</title>
  <style>
    @page {
      size: 20cm 6cm;
      margin: 0;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      font-size: 12px;
    }

    .ticket {
      width: 20cm;
      height: 6cm;
      display: flex;
      border: 1px solid #000;
      box-sizing: border-box;
    }

    .left {
      width: 68%;
      border-right: 1px solid #000;
      padding: 6px 15px;
      box-sizing: border-box;
      position: relative;
    }

    .right {
      width: 32%;
      padding: 6px 10px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      box-sizing: border-box;
    }

    .header {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-bottom: 5px;
    }

    .header-left img {
        width: 55px;
    }

    .header-center {
        text-align: center;
    }

    .header h1 {
        margin: 0;
        color: #0033cc;
        font-size: 20px;
    }

    .header h2 {
        margin: 0;
        color: red;
        font-size: 14px;
    }

    .header-divider {
      border: none;
      border-top: 1.5px solid #000;
      margin: 6px -15px 10px -15px; /* agar mentok kiri dan kanan */
      width: calc(100% + 30px);
    }
    .header-divider-kanan {
        border: none;
        border-top: 1.5px solid #000;
        margin: 10px 0 10px 0; /* NORMAL margin */
        width: 100%;          /* Tidak perlu pakai calc */
    }


    .field-table {
      width: 100%;
      border-collapse: collapse;
    }

    .field-table td {
      padding: 2px 4px;
      vertical-align: top;
    }

    .label {
      width: 85px;
      font-weight: bold;
    }

    .box-input-long {
      border: 1px solid #000;
      width: 100%;
      height: 20px;
      padding: 1px 3px;
      box-sizing: border-box;
    }

    .box-input-half {
      border: 1px solid #000;
      width: 130px;
      height: 20px;
      padding: 1px 3px;
      box-sizing: border-box;
    }

    .box-small {
      border: 1px solid #000;
      width: 60px;
      height: 20px;
      padding: 1px 3px;
      box-sizing: border-box;
    }

    .box-total {
      border: 1px solid #000;
      width: 130px;
      height: 20px;
      padding: 1px 3px;
      box-sizing: border-box;
    }

    .alamat-cabang {
      font-size: 7px;
      line-height: 1.4;
    }

    .tanggal-waktu td {
      padding: 2px 4px;
      vertical-align: top;
    }

    .footer-right {
      text-align: right;
      font-size: 11px;
    }

    .footer-right img {
      width: 60px;
      margin-top: 2px;
    }
  </style>
</head>
<body onload="window.print()">
  <div class="ticket">
    <!-- Bagian Kiri -->
    <div class="left">
      <!-- HEADER -->
        <div class="header">
            <div class="header-left">
                <img src="{{ asset('foto/icon.png') }}" alt="Logo">
            </div>
            <div class="header-center">
                <h1>RAMA TRANZ</h1>
                <h2>PT. Rasya Mandiri Tranz</h2>
            </div>
        </div>
        <hr class="header-divider">


      <table class="field-table">
        <tr>
          <td class="label">NAMA</td>
          <td colspan="3"><div class="box-input-long">{{ $pesan->nama_pemesan }}</div></td>
        </tr>
        <tr>
          <td class="label">ALAMAT</td>
          <td colspan="3"><div class="box-input-long">{{ $pesan->alamat ?? '-' }}</div></td>
        </tr>
        <tr>
          <td class="label">METODE</td>
          <td colspan="3"><div class="box-input-long">{{ $pesan->jadwal->rute->metode ?? '-' }}</div></td>
        </tr>
        <tr>
          <td class="label">No. Telepon</td>
          <td><div class="box-input-half">{{ $pesan->nohp ?? '-' }}</div></td>
          <td class="label">JUMLAH</td>
          <td><div class="box-small">{{ $pesan->jumlah_penumpang ?? '1' }}</div></td>
        </tr>
        <tr>
          <td class="label">TUJUAN</td>
          <td><div class="box-input-half">{{ $pesan->jadwal->rute->tujuan }}</div></td>
        </tr>
        <tr>
          <td class="label">TARIF</td>
          <td><div class="box-input-half">Rp {{ number_format($pesan->harga_total / ($pesan->jumlah_penumpang ?? 1), 0, ',', '.') }}</div></td>
          <td class="label">TOTAL</td>
          <td><div class="box-total">Rp {{ number_format($pesan->harga_total, 0, ',', '.') }}</div></td>
        </tr>
      </table>
    </div>

    <!-- Bagian Kanan -->
    <div class="right">
      <div>
        <div class="alamat-cabang">
          <strong>PALEMBANG</strong><br>
          Jl. Mayor Santoso No.3112, 2 Ilir RT 11, Ilir Timur II,<br>
          Kota Palembang, Sumatera Selatan 30131<br><br>
          <strong>LAMPUNG</strong><br>
          Jl. Sutami Bandarbaru No.186, Rajabasa, Kota Bandar<br>
          Lampung, 35152
        </div>
        <hr class="header-divider-kanan">
        <table class="tanggal-waktu">
          <tr>
            <td><strong>TANGGAL</strong></td>
            <td>: {{ \Carbon\Carbon::parse($pesan->jadwal->tanggal)->format('d-m-Y') }}</td>
          </tr>
          <tr>
            <td><strong>WAKTU</strong></td>
            <td>: {{ $pesan->jadwal->jam }}</td>
          </tr>
        </table>
      </div>
      <div class="footer-right">
        Hormat Kami,<br>
        <img src="{{ asset('foto/icon.png') }}" alt="TTD">
      </div>
    </div>
  </div>
</body>
</html>
