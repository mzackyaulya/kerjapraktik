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
                @foreach ($pesan as $index => $item)
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
                        <td class="text-center">{{ $item['status'] }}</td>
                        @if (auth()->user()->role == 'A')
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-print"></i>
                                </a>
                                <a href="{{ route('pesan.edit', $item->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </td>
                        @endif
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
<!-- confirm dialog -->
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
        let form =  $(this).closest("form");
        let name = $(this).data("name");
        event.preventDefault();
        Swal.fire({
            title: "Apakah Ingin Hapus? ",
            text: "data yang dihapus tidak bisa kembali!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "iya"
        })
        .then((willDelete) => {
            if (willDelete.isConfirmed) {
            form.submit();
            }
        });
    });
</script>
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
