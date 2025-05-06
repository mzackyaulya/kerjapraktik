@extends('layout.main')

@section('title','Sopir')

@section('content')
<br>
<div class="card m-4 p-3">
    <div class="card-header mb-3 d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Sopir</h5>
        <div style="position: relative; width: 230px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Pencarian" style="height: 40px; padding-left: 35px;">
            <i class="fas fa-search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #aaa;"></i>
        </div>
    </div>

    <div class="card-body">
      <a href="{{ route('sopir.create') }}" class="btn btn-primary col-lg-12 mb-3">Tambah Sopir</a>

      <table class="table table-bordered" id="ruteTable">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th class="text-center">Nama</th>
            <th class="text-center">No HP</th>
            <th class="text-center">Alamat</th>
            <th class="text-center">No Sim</th>
            <th class="text-center">Status</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($sopir as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">{{ $item['nama'] }}</td>
                <td class="text-center">{{ $item['nohp'] }}</td>
                <td class="text-center">{{ $item['alamat'] }}</td>
                <td class="text-center">{{ $item['nosim'] }}</td>
                <td class="text-center">
                    <span class="badge {{ $item['status'] == 'Aktif' ? 'bg-success' : 'bg-danger' }}">
                        {{ $item['status'] }}
                    </span>
                </td>
                <td class="text-center">
                    <a href="{{ route('sopir.edit', $item['id']) }}" class="fas fa-pen"></a>
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
            let alamat = row.cells[1].textContent.toUpperCase();
            let nohp = row.cells[2].textContent.toUpperCase();
            let nosim = row.cells[3].textContent.toUpperCase();
            let status = row.cells[4].textContent.toUpperCase();

            if (
            nama.includes(filter) ||
            status.includes(filter) ||
            alamat.includes(filter) ||
            nohp.includes(filter) ||
            nosim.includes(filter)
            ) {
            row.style.display = "";
            } else {
            row.style.display = "none";
            }
        });
    });
</script>
@endsection
