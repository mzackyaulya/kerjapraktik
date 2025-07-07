@extends('layout.main')

@section('title','Jadwal')

@section('content')
<br>
<div class="card p-2">
    <head>
        <link href="{{ url('css/app.css') }}" rel="stylesheet">
        <style>
            .card-img-top {
                width: 100%;
                height: 300px;
                object-fit: cover;
            }
        </style>
    </head>

    <div class="card-header mb-3 d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Jadwal</h5>
        <div class="d-flex gap-2" style="flex-wrap: wrap;">
            <div style="position: relative; width: 230px;">
                <input type="text" id="searchInput" class="form-control" placeholder="Pencarian" style="height: 40px; padding-left: 35px;">
                <i class="fas fa-search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #aaa;"></i>
            </div>
            <div style="width: 200px;">
                <input type="date" id="dateFilter" class="form-control" style="height: 40px;">
            </div>
        </div>
    </div>

    <div class="container">
        @if (auth()->user()->role == 'A')
            <a href="{{ route('jadwal.create') }}" class="btn btn-primary col-lg-12 mb-3">Tambah Jadwal</a>
        @endif
        <hr>
        <div class="row" id="ruteTable">
            @foreach ($jadwal as $item)
                <div class="col-md-4 mb-4" data-tanggal="{{ \Carbon\Carbon::parse($item['tanggal'])->format('Y-m-d') }}">
                    <div class="card shadow-sm">
                        <img src="{{ $item['gambar'] }}" class="card-img-top rounded" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $item['rute']['asal'] }} ke {{ $item['rute']['tujuan'] }} ({{ $item['rute']['metode'] }})</h5>
                            <div class="mb-2 d-flex">
                                <strong class="w-50">Kendaraan</strong>
                                <span>: {{ $item['kendaraan']['merk_mobil'] }}</span>
                            </div>
                            <div class="mb-2 d-flex">
                                <strong class="w-50">Sopir</strong>
                                <span>: {{ $item['sopir']['nama'] }}</span>
                            </div>
                            <div class="mb-2 d-flex">
                                <strong class="w-50">Harga</strong>
                                <span>: Rp {{ number_format($item['rute']['harga'],0,',','.') }}</span>
                            </div>
                            <div class="mb-2 d-flex">
                                <strong class="w-50">Tanggal</strong>
                                <span>: {{ \Carbon\Carbon::parse($item['tanggal'])->format('d-m-Y') }}</span>
                            </div>
                            <div class="mb-2 d-flex">
                                <strong class="w-50">Jam</strong>
                                <span>: {{ $item['jam'] }}</span>
                            </div>
                            <div class="d-flex justify-content-center gap-2 flex-wrap mt-3">
                                @if(auth()->user()->role == 'A')
                                    <a href="{{ route('jadwal.edit', $item['id']) }}" class="btn btn-info">
                                        <i class="fas fa-pen"></i> Edit
                                    </a>
                                @endif
                                @if(auth()->user()->role == 'A')
                                    <a href="{{ route('jadwal.cetak', $item['id']) }}" target="_blank" class="btn btn-warning">
                                        <i class="fas fa-print"></i> Cetak
                                    </a>
                                @endif
                                <a href="{{ route('pesan.create', $item['id']) }}" class="btn btn-success">
                                    <i class="fas fa-file-text"></i> Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script src="{{ url('js/app.js') }}"></script>
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

<!-- confirm dialog -->
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
        let form =  $(this).closest("form");
        event.preventDefault();
        Swal.fire({
            title: "Apakah Ingin Hapus?",
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Iya"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>

<!-- Filter tanggal & pencarian -->
<script>
    function filterCards() {
        let searchFilter = document.getElementById('searchInput').value.toUpperCase();
        let selectedDate = document.getElementById('dateFilter').value;
        let cards = document.querySelectorAll('#ruteTable .col-md-4');

        cards.forEach(card => {
            let cardDate = card.getAttribute('data-tanggal');
            let cardText = card.textContent.toUpperCase();

            let cocokTanggal = selectedDate === "" || cardDate === selectedDate;
            let cocokSearch = searchFilter === "" || cardText.includes(searchFilter);

            card.style.display = (cocokTanggal && cocokSearch) ? "" : "none";
        });
    }

    document.getElementById('searchInput').addEventListener('keyup', filterCards);
    document.getElementById('dateFilter').addEventListener('change', filterCards);
</script>
@endsection
