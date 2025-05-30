@extends('layout.main')

@section('title','Rute')

@section('content')
<br>
<div class="card m-4 p-3">
    <div class="card-header mb-3 d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Rute Perjalanan</h5>
        <div style="position: relative; width: 230px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Pencarian" style="height: 40px; padding-left: 35px;">
            <i class="fas fa-search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #aaa;"></i>
        </div>
    </div>

    <div class="card-body">
        @if(auth()->user()->role == 'A')
            <a href="{{ route('rute.create') }}" class="btn btn-primary col-lg-12 mb-3">Tambah Rute</a>
        @endif

        <table class="table table-bordered" id="ruteTable">
            <thead>
                <tr>
                    <th class="text-center">Asal</th>
                    <th class="text-center">Tujuan</th>
                    <th class="text-center">Metode</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Estimasi</th>
                    @if (auth()->user()->role == 'A')
                        <th class="text-center">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($rute as $item)
                    <tr>
                        <td class="text-center">{{ $item['asal'] }}</td>
                        <td class="text-center">{{ $item['tujuan'] }}</td>
                        <td class="text-center">{{ $item['metode'] }}</td>
                        <td class="text-center">Rp. {{ $item['harga'] }}</td>
                        <td class="text-center">{{ $item['estimasi_waktu'] }}</td>
                        @if (auth()->user()->role == 'A')
                            <td class="text-center">
                                <a href="{{ route('rute.edit', $item['id']) }}" class="fas fa-pen"></a>
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
            let asal = row.cells[0].textContent.toUpperCase();
            let tujuan = row.cells[1].textContent.toUpperCase();
            let metode = row.cells[2].textContent.toUpperCase();
            let harga = row.cells[3].textContent.toUpperCase();
            let estimasi_waktu = row.cells[4].textContent.toUpperCase();

            if (
            asal.includes(filter) ||
            tujuan.includes(filter) ||
            metode.includes(filter) ||
            harga.includes(filter) ||
            estimasi_waktu.includes(filter)
            ) {
            row.style.display = "";
            } else {
            row.style.display = "none";
            }
        });
    });
</script>
@endsection
