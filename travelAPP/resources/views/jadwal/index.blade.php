@extends('layout.main')

@section('title','Jadwal')

@section('content')
<br>
<div class="card m-4 p-3">
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
        <div style="position: relative; width: 230px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Pencarian" style="height: 40px; padding-left: 35px;">
            <i class="fas fa-search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #aaa;"></i>
        </div>
    </div>

    <body>
        <div class="container">
            <a href="{{ route('jadwal.create') }}" class="btn btn-primary col-lg-12 mb-3">Tambah Jadwal</a>
            <hr>
            <div class="row" id="ruteTable">
                @foreach ($jadwal as $item)
                    <div class="col-md-4 mb-4">
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

                                <div class="d-flex justify-content-between">
                                    @if(auth()->user()->role == 'A')
                                        <a href="{{ route('jadwal.edit', $item['id']) }}" class="fas fa-pen btn btn-info"> Edit</a>
                                    @endif
                                    <a href="{{ route('pesan.create', $item['id']) }}" class="btn btn-success fas fa-file-text"> Pesan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <script src="{{ url('js/app.js') }}"></script>
    </body>
</div>
<script src="{{ url('js/app.js') }}"></script>
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
        let cards = document.querySelectorAll('#ruteTable .card');

        cards.forEach(card => {
            let textContent = card.textContent.toUpperCase();

            if (textContent.includes(filter)) {
                card.parentElement.style.display = "";  // parentElement = col-md-4
            } else {
                card.parentElement.style.display = "none";
            }
        });
    });
</script>
@endsection
