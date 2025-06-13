@extends('layout.main')

@section('title','Kendaraan')

@section('content')
<br>
<div class="card m-4 p-3">
    <div class="card-header mb-3 d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Kendaraan</h5>
        <div style="position: relative; width: 230px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Pencarian" style="height: 40px; padding-left: 35px;">
            <i class="bi bi-search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #aaa;"></i>
        </div>
    </div>

    <div class="card-body">
        @if(auth()->user()->role == 'A')
            <a href="{{ route('kendaraan.create') }}" class="btn btn-primary col-lg-12 mb-3">Tambah Kendaraan</a>
        @endif
        <table class="table table-bordered" id="kendaraanTable">
            <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">No Plat</th>
                <th class="text-center">Merk Mobil</th>
                <th class="text-center">Warna</th>
                <th class="text-center">Kapasitas</th>
                <th class="text-center">Status</th>
                @if(auth()->user()->role == 'A')
                    <th class="text-center">Aksi</th>
                @endif
            </tr>
            </thead>
            <tbody>
                @forelse ($kendaraan as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ $item['noplat'] }}</td>
                        <td class="text-center">{{ $item['merk_mobil'] }}</td>
                        <td class="text-center">{{ $item['warna'] }}</td>
                        <td class="text-center">{{ $item['kapasitas'] }}</td>
                        <td class="text-center">
                            <span class="badge {{ $item['status'] == 'Ready' ? 'bg-success' : 'bg-danger' }}">
                                {{ $item['status'] }}
                            </span>
                        </td>
                        @if(auth()->user()->role == 'A')
                            <td class="text-center">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item text-center" href="{{ route('kendaraan.edit', $item['id']) }}">
                                            <i class="bi bi-pen me-2"></i>Edit
                                        </a>
                                    </div>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada Kendaraan.</td>
                    </tr>
                @endforelse
                <tr id="emptyRow" style="display: none;">
                    <td colspan="7" class="text-center">Data Kendaraan tidak ditemukan.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toUpperCase();
        let rows = document.querySelectorAll('#kendaraanTable tbody tr');
        let found = 0;

        rows.forEach(row => {
            if (row.id === 'emptyRow') return;

            let noplat = row.cells[1].textContent.toUpperCase();
            let merk = row.cells[2].textContent.toUpperCase();
            let warna = row.cells[3].textContent.toUpperCase();
            let kapasitas = row.cells[4].textContent.toUpperCase();
            let status = row.cells[5].textContent.toUpperCase();

            if (
                noplat.includes(filter) ||
                merk.includes(filter) ||
                warna.includes(filter) ||
                kapasitas.includes(filter) ||
                status.includes(filter)
            ) {
                row.style.display = "";
                found++;
            } else {
                row.style.display = "none";
            }
        });

        document.getElementById('emptyRow').style.display = (found === 0) ? "" : "none";
    });
</script>
@endsection
