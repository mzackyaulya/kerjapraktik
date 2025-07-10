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
        <div class="d-none d-md-block">
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

        <div class="d-block d-md-none">
            @forelse($kendaraan as $item)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item['merk_mobil'] }} ({{ $item['noplat'] }})</h5>
                        <p class="card-text mb-1"><strong>Warna:</strong> {{ $item['warna'] }}</p>
                        <p class="card-text mb-1"><strong>Kapasitas:</strong> {{ $item['kapasitas'] }}</p>
                        <p class="card-text mb-1"><strong>Status:</strong>
                            <span class="badge {{ $item['status'] == 'Ready' ? 'bg-success' : 'bg-danger' }}">
                                {{ $item['status'] }}
                            </span>
                        </p>
                        @if (auth()->user()->role == 'A')
                            <div class="mt-3 text-center">
                                <a href="{{ route('kendaraan.edit', $item['id']) }}" class="btn btn-sm btn-transparant">
                                    <i class="fas fa-pen me-2 text-gray"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="alert alert-info text-center" role="alert">
                    Belum ada Kendaraan.
                </div>
            @endforelse
            <div id="emptyRowMobile" class="alert alert-warning text-center" style="display: none;" role="alert">
                Data Kendaraan tidak ditemukan.
            </div>
        </div>
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
        let desktopRows = document.querySelectorAll('#kendaraanTable tbody tr');
        let foundDesktop = 0;

        // Filter for desktop table
        desktopRows.forEach(row => {
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
                foundDesktop++;
            } else {
                row.style.display = "none";
            }
        });

        document.getElementById('emptyRow').style.display = (foundDesktop === 0) ? "" : "none";

        // Filter for mobile cards
        let mobileCards = document.querySelectorAll('.d-block.d-md-none .card');
        let foundMobile = 0;
        mobileCards.forEach(card => {
            let noplat = card.querySelector('.card-title').textContent.toUpperCase(); // Assuming noplat is in card-title
            let merk = card.querySelector('.card-title').textContent.toUpperCase(); // Assuming merk is in card-title
            let warna = card.querySelector('p:nth-child(2)').textContent.toUpperCase();
            let kapasitas = card.querySelector('p:nth-child(3)').textContent.toUpperCase();
            let status = card.querySelector('p:nth-child(4)').textContent.toUpperCase();

            if (
                noplat.includes(filter) ||
                merk.includes(filter) ||
                warna.includes(filter) ||
                kapasitas.includes(filter) ||
                status.includes(filter)
            ) {
                card.style.display = "";
                foundMobile++;
            } else {
                card.style.display = "none";
            }
        });

        document.getElementById('emptyRowMobile').style.display = (foundMobile === 0) ? "" : "none";
        // Hide the "Belum ada Kendaraan." message if search results are found
        if (foundMobile > 0) {
            document.querySelector('.d-block.d-md-none .alert-info').style.display = "none";
        } else {
            // Only show "Belum ada Kendaraan." if there were no initial items AND no search results
            if ({{ count($kendaraan) }} === 0) {
                document.querySelector('.d-block.d-md-none .alert-info').style.display = "";
            } else {
                document.querySelector('.d-block.d-md-none .alert-info').style.display = "none";
            }
        }
    });
</script>
@endsection
