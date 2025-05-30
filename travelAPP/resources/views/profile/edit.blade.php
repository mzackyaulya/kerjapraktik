@extends('layout.main')

@section('title', 'Profil')

@section('content')
<div class="container py-5 d-flex justify-content-center">
    <div style="width: 450px; max-width: 90vw;">
        <h2 class="mb-4 text-center text-primary fw-bold">Pengaturan Profil</h2>

        <!-- Update Profile Information -->
        <div class="card shadow-sm rounded mb-4">
            <div class="card-header bg-primary text-white fw-semibold">
                Update Informasi Profil
            </div>
            <div class="card-body">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Update Password -->
        <div class="card shadow-sm rounded mb-4">
            <div class="card-header bg-primary text-white fw-semibold">
                Update Kata Sandi
            </div>
            <div class="card-body">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Delete User -->
        <div class="card shadow-sm rounded border-danger">
            <div class="card-header bg-danger text-white fw-semibold">
                Hapus Akun
            </div>
            <div class="card-body">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>

<style>
    /* Spasi antar elemen form */
    .card-body form > * {
        margin-bottom: 1rem;
    }
    /* Tombol hapus akun full lebar */
    .card.border-danger .btn-danger {
        width: 100%;
    }
</style>
@endsection
