@extends('layout.main')

@section('title','Pemesanan')

@section('content')
<br>
<div class="card p-2">
    <div class="card-header mb-3 d-flex justify-content-between align-items-center flex-wrap">
        <h5 class="card-title mb-0">Pemesanan Tiket</h5>
        <div class="mt-2 position-relative" style="width: 230px;">
            <input type="text" id="searchInput" class="form-control ps-4" placeholder="Pencarian...">
            <i class="fas fa-search position-absolute" style="left: 7px; top: 50%; transform: translateY(-50%); color: #aaa;"></i>
        </div>
    </div>

    {{-- DESKTOP TABLE --}}
    <div class="card-body table-responsive d-none d-md-block">
        <table class="table table-bordered table-hover align-middle text-center" id="ruteTable">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>No Kursi</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                    <th>Info</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesan as $index => $item)
                <tr class="searchable-row">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['nama_pemesan'] }}</td>
                    <td>{{ $item['nohp'] }}</td>
                    <td>{{ $item['daftar_kursi'] ?? $item['seet'] }}</td>
                    <td>{{ $item['jumlah_orang'] ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($item['tanggal_pesan'] ?? $item['jadwal']['tanggal'])->format('d-m-Y') }}</td>
                    <td>{{ $item['jadwal']['jam'] ?? '-' }}</td>
                    <td>
                        <span class="badge
                            {{ $item['status'] === 'Pending' ? 'bg-warning text-dark' :
                               ($item['status'] === 'Dikonfirmasi' ? 'bg-success' : 'bg-secondary') }}">
                            {{ $item['status'] }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('pesan.show', ['pesan' => $item['id']]) }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                    <td class="text-center" style="position: relative">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-transparant" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                <li>
                                    <a href="{{ route('pesan.edit', ['pesan' => $item['id']]) }}" class="dropdown-item">
                                        <i class="fas fa-pen me-2 text-info"></i> Edit
                                    </a>
                                </li>
                                @if(auth()->user()->role == 'A')
                                    <li>
                                        <a href="{{ route('pesan.cetak', ['id' => $item['id']]) }}" target="_blank" class="dropdown-item">
                                            <i class="fas fa-print me-2 text-dark"></i> Cetak
                                        </a>
                                    </li>
                                @endif
                                @if(auth()->user()->role == 'A')
                                    @if($item['status'] !== 'Dikonfirmasi')
                                        <li>
                                            <form action="{{ route('pesan.konfirmasi', ['id' => $item['id']]) }}" method="POST" onsubmit="return confirm('Konfirmasi pemesanan ini?')">
                                                @csrf
                                                @method('PATCH')
                                                <button class="dropdown-item" type="submit">
                                                    <i class="fas fa-check-circle me-2 text-success"></i> Dikonfirmasi
                                                </button>
                                            </form>
                                        </li>
                                    @endif
                                @endif
                                @if($item['status'] !== 'Batal')
                                <li>
                                    <form action="{{ route('pesan.batal', ['id' => $item['id']]) }}" method="POST" onsubmit="return confirm('Batalkan pemesanan ini?')">
                                        @csrf
                                        @method('PATCH')
                                        <button class="dropdown-item" type="submit">
                                            <i class="fas fa-times-circle me-2 text-danger"></i> Batal
                                        </button>
                                    </form>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- MOBILE CARD --}}
    <div class="card-body d-block d-md-none" id="mobileCards">
        @foreach ($pesan as $item)
            <div class="card mb-3 shadow-sm border border-light searchable-card">
                <div class="card-body">
                    <h5 class="card-title mb-2 d-flex justify-content-between">
                        <span class="text-black fw-bold">{{ $item['nama_pemesan'] }}</span>
                        <span class="badge
                            {{ $item['status'] === 'Pending' ? 'bg-warning text-dark' :
                            ($item['status'] === 'Dikonfirmasi' ? 'bg-success' : 'bg-secondary') }}">
                            {{ $item['status'] }}
                        </span>
                    </h5>
                    <p class="mb-1"><strong>No HP:</strong> {{ $item['nohp'] }}</p>
                    <p class="mb-1"><strong>Kursi:</strong> {{ $item['daftar_kursi'] ?? $item['seet'] }}</p>
                    <p class="mb-1"><strong>Jumlah:</strong> {{ $item['jumlah_orang'] ?? '-' }}</p>
                    <p class="mb-1"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($item['tanggal_pesan'] ?? $item['jadwal']['tanggal'])->format('d-m-Y') }}</p>
                    <p class="mb-1"><strong>Jam:</strong> {{ $item['jadwal']['jam'] ?? '-' }}</p>

                    <div class="d-flex justify-content-start flex-wrap gap-2 mt-3">
                        {{-- Info --}}
                        <a href="{{ route('pesan.show', ['pesan' => $item['id']]) }}" class="btn btn-sm btn-secondary" title="Lihat">
                            <i class="fas fa-eye"></i>
                        </a>

                        {{-- Edit --}}
                        <a href="{{ route('pesan.edit', ['pesan' => $item['id']]) }}" class="btn btn-sm btn-info" title="Edit">
                            <i class="fas fa-pen"></i>
                        </a>

                        {{-- Cetak --}}
                        @if (auth()->user()->role == 'A')
                            <a href="{{ route('pesan.cetak', ['id' => $item['id']]) }}" target="_blank" class="btn btn-sm btn-dark" title="Cetak">
                                <i class="fas fa-print"></i>
                            </a>
                        @endif

                        {{-- Dikonfirmasi --}}
                        @if (auth()->user()->role == 'A' && $item['status'] !== 'Dikonfirmasi')
                            <form action="{{ route('pesan.konfirmasi', $item['id']) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-gray">
                                    <i class="fas fa-check-circle text-success"></i>
                                </button>
                            </form>
                        @endif

                        {{-- Batal --}}
                        @if (in_array(auth()->user()->role, ['A','U']) && $item['status'] !== 'Batal')
                            <form action="{{ route('pesan.batal', ['id' => $item['id']]) }}" method="POST" onsubmit="return confirm('Batalkan pemesanan ini?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-danger" title="Batal">
                                    <i class="fas fa-times-circle"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- JS --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Realtime search filtering
    $('#searchInput').on('keyup', function () {
        let keyword = $(this).val().toLowerCase();

        $('.searchable-row').each(function () {
            let text = $(this).text().toLowerCase();
            $(this).toggle(text.includes(keyword));
        });

        $('.searchable-card').each(function () {
            let text = $(this).text().toLowerCase();
            $(this).toggle(text.includes(keyword));
        });
    });
</script>

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
    const inputJumlahOrang = document.querySelector('#jumlah_orang');
    const checkboxKursi = document.querySelectorAll('.kotak-kursi');
    const infoKursi = document.getElementById('info-kursi-terpilih');

    function perbaruiKursi() {
        const jumlahMaks = parseInt(inputJumlahOrang.value) || 0;
        const kursiDipilih = [...checkboxKursi].filter(cb => cb.checked);

        // Reset semua checkbox jika jumlah kosong atau 0
        if (!jumlahMaks || jumlahMaks <= 0) {
            checkboxKursi.forEach(cb => {
                cb.checked = false;
                cb.disabled = true;
            });
            infoKursi.textContent = 'Masukkan jumlah orang untuk mengaktifkan pilihan kursi.';
            infoKursi.className = 'text-muted mt-1 d-block';
            return;
        }

        // Aktifkan semua kursi, lalu batasi sesuai jumlah orang
        checkboxKursi.forEach(cb => {
            cb.disabled = kursiDipilih.length >= jumlahMaks && !cb.checked;
        });

        infoKursi.textContent = `Kursi dipilih: ${kursiDipilih.length} dari ${jumlahMaks}`;
        infoKursi.className = kursiDipilih.length > jumlahMaks ? 'text-danger mt-1 d-block' : 'text-primary mt-1 d-block';
    }

    inputJumlahOrang.addEventListener('input', () => {
        checkboxKursi.forEach(cb => {
            cb.checked = false;
        cb.disabled = false;
        });
        perbaruiKursi();
    });

    checkboxKursi.forEach(cb => cb.addEventListener('change', perbaruiKursi));
    perbaruiKursi();
</script>

@endsection
