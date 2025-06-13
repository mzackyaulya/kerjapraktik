@extends('layout.main')

@section('title','Rute')

@section('content')
<br>
<div class="card m-4 p-3">
    <div class="card-header mb-3 d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Rute Perjalanan</h5>
        <div style="position: relative; width: 230px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Cari rute..." style="height: 40px; padding-left: 35px;">
            <i class="bi bi-search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #aaa;"></i>
        </div>
    </div>

    <div class="card-body">
        @if(auth()->user()->role == 'A')
            <a href="{{ route('rute.create') }}" class="btn btn-primary col-lg-12 mb-3">Tambah Rute</a>
        @endif

        <table class="table table-bordered" id="ruteTable">
            <thead>
                <tr>
                    <th class="text-center">No</th>
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
                @forelse ($rute as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ $item['asal'] }}</td>
                        <td class="text-center">{{ $item['tujuan'] }}</td>
                        <td class="text-center">{{ $item['metode'] }}</td>
                        <td class="text-center">Rp. {{ number_format($item['harga'],0,',','.') }}</td>
                        <td class="text-center">{{ $item['estimasi_waktu'] }}</td>
                        @if (auth()->user()->role == 'A')
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item text-center" href="{{ route('rute.edit', $item['id']) }}"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                </div>
                            </div>
                        </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada rute.</td>
                    </tr>
                @endforelse
                <tr id="emptyRow" style="display: none;">
                    <td colspan="7" class="text-center">Data rute tidak ditemukan.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

{{-- jQuery & SweetAlert --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- SweetAlert sukses --}}
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

        rows.forEach(row => {
            if (row.id === 'emptyRow') return;

            let asal = row.cells[1].textContent.toUpperCase();
            let tujuan = row.cells[2].textContent.toUpperCase();
            let metode = row.cells[3].textContent.toUpperCase();
            let harga = row.cells[4].textContent.toUpperCase();
            let estimasi = row.cells[5].textContent.toUpperCase();

            if (
                asal.includes(filter) ||
                tujuan.includes(filter) ||
                metode.includes(filter) ||
                harga.includes(filter) ||
                estimasi.includes(filter)
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
