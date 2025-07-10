@extends('layout.main')

@section('title', 'Sopir')

@section('content')
    <br>
    <div class="card m-4 p-3">
        <div class="card-header mb-3 d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Daftar Sopir</h5>
            <div style="position: relative; width: 230px;">
                <input type="text" id="searchInput" class="form-control" placeholder="Pencarian"
                    style="height: 40px; padding-left: 35px;">
                <i class="bi bi-search"
                    style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #aaa;"></i>
            </div>
        </div>

        <div class="card-body">
            @if (auth()->user()->role == 'A')
                <a href="{{ route('sopir.create') }}" class="btn btn-primary col-lg-12 mb-3">Tambah Sopir</a>
            @endif
            <div class="d-none d-md-block">
                <table class="table table-bordered" id="ruteTable">
                    <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">No HP</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">No Sim</th>
                        <th class="text-center">Status</th>
                        @if(auth()->user()->role == 'A')
                            <th class="text-center">Aksi</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($sopir as $index => $item)
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
                                @if (auth()->user()->role == 'A')
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow " data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item text-center" href="{{ route('sopir.edit', $item['id']) }}"><i class="bi bi-pen me-2"></i>Edit</a>
                                            </div>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada Sopir.</td>
                            </tr>
                        @endforelse
                        <tr id="emptyRow" style="display: none;">
                            <td colspan="7" class="text-center">Data Sopir tidak ditemukan.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="d-block d-md-none">
                @forelse($sopir as $item)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item['nama'] }}</h5>
                            <p class="card-text mb-1"><strong>No HP:</strong> {{ $item['nohp'] }}</p>
                            <p class="card-text mb-1"><strong>Alamat:</strong> {{ $item['alamat'] }}</p>
                            <p class="card-text mb-1"><strong>No SIM:</strong> {{ $item['nosim'] }}</p>
                            <p class="card-text mb-1"><strong>Status:</strong>
                                <span class="badge {{ $item['status'] == 'Aktif' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $item['status'] }}
                                </span>
                            </p>
                            @if (auth()->user()->role == 'A')
                                <div class="mt-3 text-center">
                                    <a href="{{ route('sopir.edit', $item['id']) }}" class="btn btn-sm btn-transparant">
                                        <i class="fas fa-pen me-2 text-gray"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info text-center" role="alert">
                        Belum ada Sopir.
                    </div>
                @endforelse
                <div id="emptyRowMobile" class="alert alert-warning text-center" style="display: none;" role="alert">
                    Data Sopir tidak ditemukan.
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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

            // For desktop table
            rows.forEach(row => {
                if (row.id === 'emptyRow') return;

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
                    found++;
                } else {
                    row.style.display = "none";
                }
            });
            document.getElementById('emptyRow').style.display = (found === 0) ? "" : "none";

            // For mobile cards
            let mobileCards = document.querySelectorAll('.d-block.d-md-none .card');
            let foundMobile = 0;
            mobileCards.forEach(card => {
                let nama = card.querySelector('.card-title').textContent.toUpperCase();
                let nohp = card.querySelector('p:nth-child(2)').textContent.toUpperCase();
                let alamat = card.querySelector('p:nth-child(3)').textContent.toUpperCase();
                let nosim = card.querySelector('p:nth-child(4)').textContent.toUpperCase();
                let status = card.querySelector('p:nth-child(5)').textContent.toUpperCase();

                if (
                    nama.includes(filter) ||
                    status.includes(filter) ||
                    alamat.includes(filter) ||
                    nohp.includes(filter) ||
                    nosim.includes(filter)
                ) {
                    card.style.display = "";
                    foundMobile++;
                } else {
                    card.style.display = "none";
                }
            });

            document.getElementById('emptyRowMobile').style.display = (foundMobile === 0) ? "" : "none";
            // Hide the "Belum ada Sopir." message if search results are found
            if (foundMobile > 0) {
                document.querySelector('.d-block.d-md-none .alert-info').style.display = "none";
            } else {
                // Only show "Belum ada Sopir." if there were no initial items AND no search results
                if ({{ count($sopir) }} === 0) {
                    document.querySelector('.d-block.d-md-none .alert-info').style.display = "";
                } else {
                    document.querySelector('.d-block.d-md-none .alert-info').style.display = "none";
                }
            }
        });
    </script>
@endsection
