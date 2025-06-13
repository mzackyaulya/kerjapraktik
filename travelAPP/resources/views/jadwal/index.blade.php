@extends('layout.main')

@section('title','Pemesanan')

@section('content')
<br>
<div class="card m-4 p-3">
    <div class="card-header mb-3 d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Pemesanan Tiket</h5>
        <div style="position: relative; width: 230px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Pencarian" style="height: 40px; padding-left: 35px;">
            <i class="bi bi-search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #aaa;"></i>
        </div>
    </div>

    <div class="card-body">
        @if(auth()->user()->role == 'A')
            <a href="{{ route('pesan.create') }}" class="btn btn-primary col-lg-12 mb-3">Tambah Pemesanan</a>
        @endif

        <table class="table table-bordered" id="ruteTable">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">No Hp</th>
                    <th class="text-center">Alamat</th>
                    <th class="text-center">Metode</th>
                    <th class="text-center">Seet</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Jumlah Orang</th>
                    <th class="text-center">Total Harga</th>
                    <th class="text-center">Status</th>
                    @if (auth()->user()->role == 'A')
                        <th class="text-center">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($pesan as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ $item['nama_pemesan'] }}</td>
                        <td class="text-center">{{ $item['nohp'] }}</td>
                        <td class="text-center">{{ $item['alamat'] }}</td>
                        <td class="text-center">{{ $item['jadwal']['rute']['metode'] }}</td>
                        <td class="text-center">{{ $item['seet'] }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($item['jadwal']['tanggal'])->format('d-m-Y') }}</td>
                        <td class="text-center">{{ $item['jumlah_orang'] }}</td>
                        <td class="text-center">Rp. {{ number_format($item['harga_total'], 0, ',', '.') }}</td>
                        <td class="text-center">
                            <span class="badge {{ $item['status'] == 'Lunas' ? 'bg-success' : 'bg-warning' }}">
                                {{ $item['status'] }}
                            </span>
                        </td>
                        @if (auth()->user()->role == 'A')
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-secondary" title="Print">
                                    <i class="fas fa-print"></i>
                                </a>
                                <a href="{{ route('pesan.edit', $item->id) }}" class="btn btn-sm btn-info" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->role == 'A' ? 11 : 10 }}" class="text-center">Belum ada Pemesanan.</td>
                    </tr>
                @endforelse
                <tr id="emptyRow" style="display: none;">
                    <td colspan="{{ auth()->user()->role == 'A' ? 11 : 10 }}" class="text-center">Data Pemesanan tidak ditemukan.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
  <script>
    Swal.fire({
      title: "BERHASIL!",
      text: '{{ session('success') }}',
      icon: "success"
    });
  </script>
@endif


{{-- Search realtime --}}
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toUpperCase();
        let rows = document.querySelectorAll('#ruteTable tbody tr');
        let found = 0;

        rows.forEach(row => {
            if (row.id === 'emptyRow') return;

            let no = row.cells[0].textContent.toUpperCase();
            let nama = row.cells[1].textContent.toUpperCase();
            let nohp = row.cells[2].textContent.toUpperCase();
            let alamat = row.cells[3].textContent.toUpperCase();
            let metode = row.cells[4].textContent.toUpperCase();
            let seet = row.cells[5].textContent.toUpperCase();
            let tanggal = row.cells[6].textContent.toUpperCase();
            let jumlah_orang = row.cells[7].textContent.toUpperCase();
            let harga = row.cells[8].textContent.toUpperCase();
            let status = row.cells[9].textContent.toUpperCase();

            if (
                no.includes(filter) ||
                nama.includes(filter) ||
                nohp.includes(filter) ||
                alamat.includes(filter) ||
                metode.includes(filter) ||
                seet.includes(filter) ||
                tanggal.includes(filter) ||
                jumlah_orang.includes(filter) ||
                harga.includes(filter) ||
                status.includes(filter)
            ) {
                row.style.display = "";
                found++;
            } else {
                row.style.display = "none";
            }
        });

        // Tampilkan pesan data tidak ditemukan jika pencarian kosong
        document.getElementById('emptyRow').style.display = (found === 0) ? "" : "none";
    });
</script>
@endsection
