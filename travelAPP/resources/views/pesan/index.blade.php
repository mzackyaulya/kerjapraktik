@extends('layout.main')

@section('title','Pemesanan')

@section('content')
<br>
<div class="card m-4 p-3">
    <div class="card-header mb-3 d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Pemesanan Tiket</h5>
        <div style="position: relative; width: 230px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Pencarian" style="height: 40px; padding-left: 35px;">
            <i class="fas fa-search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #aaa;"></i>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-bordered" id="ruteTable">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">No Hp</th>
                    <th class="text-center">No Kursi</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Jam</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Info Lengkap</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesan as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ $item['nama_pemesan'] }}</td>
                        <td class="text-center">{{ $item['nohp'] }}</td>
                        <td class="text-center">{{ $item['seet'] }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($item['jadwal']['tanggal'])->format('d-m-Y') }}</td>
                        <td class="text-center">{{ $item['jadwal']['jam'] }}</td>
                        <td class="text-center">
                            @if($item['status'] === 'Pending')
                            <span class="badge bg-warning text-dark"><i class="fas fa-hourglass-half me-1"></i>Pending</span>
                        @elseif($item['status'] === 'Dikonfirmasi')
                            <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Dikonfirmasi</span>
                        @else
                            <span class="badge bg-secondary">{{ $item['status'] }}</span>
                        @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('pesan.show', $item['id']) }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            @if (auth()->user()->role == 'A')
                                <a href="{{ route('pesan.cetak', $item['id']) }}" target="_blank" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-print"></i>
                                </a>
                            @endif
                            <a href="{{ route('pesan.edit', $item['id']) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-pen"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
  <script>
    Swal.fire({
    title: "BERHASIL!",
    text: '{{ session('success')}}',
    icon: "success"
    });
  </script>
@endif
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toUpperCase();
        let rows = document.querySelectorAll('#ruteTable tbody tr');
        rows.forEach(row => {
            let nama = row.cells[0].textContent.toUpperCase();
            let nohp = row.cells[1].textContent.toUpperCase();
            let alamat = row.cells[2].textContent.toUpperCase();
            let seet = row.cells[2].textContent.toUpperCase();
            let jumlah_orang = row.cells[3].textContent.toUpperCase();
            let harga = row.cells[4].textContent.toUpperCase();
            let status = row.cells[5].textContent.toUpperCase();

            if (
                nama.includes(filter) ||
                nohp.includes(filter) ||
                alamat.includes(filter) ||
                jumlah.includes(filter) ||
                harga.includes(filter) ||
                status.includes(filter)
            ) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
</script>
@endsection
