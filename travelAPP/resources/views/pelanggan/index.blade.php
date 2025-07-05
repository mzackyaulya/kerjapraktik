@extends('layout.main')

@section('title','Pelanggan')

@section('content')
<br>
<div class="card m-4 p-3">
    <div class="card-header mb-3 d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Data Pelanggan</h5>
        <div style="position: relative; width: 230px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Pencarian" style="height: 40px; padding-left: 35px;">
            <i class="bi bi-search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #aaa;"></i>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-bordered" id="pelangganTable">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Foto</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Alamat</th>
                    <th class="text-center">No Telepon</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pelanggan as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">
                            <img
                                src="{{ $item['foto'] ? asset('foto/pelanggan/' . $item['foto']) : url('assets/img/avatars/1.png') }}"
                                alt="Foto Pelanggan"
                                style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;" />
                        </td>
                        <td class="text-center">{{ $item['name'] }}</td>
                        <td class="text-center">{{ $item['alamat'] }}</td>
                        <td class="text-center">{{ $item['nohp'] }}</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item text-center" href="{{ route('pelanggan.edit', $item['id']) }}"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data pelanggan.</td>
                    </tr>
                @endforelse
                <tr id="emptyRow" style="display: none;">
                    <td colspan="6" class="text-center">Data pelanggan tidak ditemukan.</td>
                </tr>
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
{{-- Search --}}
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toUpperCase();
        let rows = document.querySelectorAll('#pelangganTable tbody tr');
        let found = 0;

        rows.forEach(row => {
            // Kalau ini baris pesan kosong, skip dulu
            if (row.id === 'emptyRow') return;

            // Ambil isi sel nama, alamat, nohp
            let nama = row.cells[2].textContent.toUpperCase();
            let alamat = row.cells[3].textContent.toUpperCase();
            let nohp = row.cells[4].textContent.toUpperCase();

            // Cek cocok nggaknya
            if (
                nama.includes(filter) ||
                alamat.includes(filter) ||
                nohp.includes(filter)
            ) {
                row.style.display = ""; // tampilkan kalau cocok
                found++;
            } else {
                row.style.display = "none"; // sembunyikan kalau nggak cocok
            }
        });

        // Tampilkan pesan kosong kalau tidak ada yang cocok
        document.getElementById('emptyRow').style.display = (found === 0) ? "" : "none";
    });
</script>
@endsection
