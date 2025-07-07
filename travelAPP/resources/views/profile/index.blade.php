@extends('layout.main')

@section('title', 'Profil')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-secondary text-white d-flex align-items-center">
                    <i class="bx bx-user-circle fs-3 me-2"></i>
                    <h5 class="mb-0 text-white">Profil Pengguna</h5>
                </div>

                <div class="card-body">
                    <div class="text-center mt-3 mb-4">
                        @if($user->foto)
                            <img
                                src="{{ $user->foto ? asset('foto/pelanggan/' . $user->foto) : url('assets/img/avatars/1.png') }}"
                                alt="Foto Profil"
                                style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%;" />
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D8ABC&color=fff&size=120" class="rounded-circle shadow" alt="Default Avatar">
                        @endif
                    </div>

                    <h1 class="text-center">{{ $user->name }}</h1>

                    <table class="table table-borderless">
                        <tr>
                            <th>Email</th>
                            <td>: {{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>: {{ $user->alamat ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>No. HP</th>
                            <td>: {{ $user->nohp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Terdaftar Sejak</th>
                            <td>: {{ $user->created_at->format('d M Y') }}</td>
                        </tr>
                    </table>

                    <div class="mt-4 d-flex justify-content-end">
                        <a href="{{ route('pelanggan.edit', Auth::user()->id) }}" class="btn btn-outline-primary">
                            <i class="bx bx-edit-alt me-1"></i> Edit Profil
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
