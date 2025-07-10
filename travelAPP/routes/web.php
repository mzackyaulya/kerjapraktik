<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuteController;
use App\Http\Controllers\SopirController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//Route Pelanggan
Route::middleware(['auth', 'role:A'])->group(function () {
    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/pelanggan/{id}/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');
    Route::put('/pelanggan/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
});

//Route Rute
Route::middleware(['auth', 'role:A,U'])->group(function () {
    Route::get('/rute', [RuteController::class, 'index'])->name('rute.index');
});
Route::middleware(['auth', 'role:A'])->group(function () {
    Route::get('/rute/create', [RuteController::class, 'create'])->name('rute.create');
    Route::post('/rute', [RuteController::class, 'store'])->name('rute.store');

    Route::get('/rute/{id}/edit', [RuteController::class, 'edit'])->name('rute.edit');
    Route::put('/rute/{id}', [RuteController::class, 'update'])->name('rute.update');
});


//Route sopir
Route::middleware(['auth', 'role:A'])->group(function () {
    Route::get('/sopir', [SopirController::class, 'index'])->name('sopir.index');

    Route::get('/sopir/create', [SopirController::class, 'create'])->name('sopir.create');
    Route::post('/sopir', [SopirController::class, 'store'])->name('sopir.store');

    Route::get('/sopir/{id}/edit', [SopirController::class, 'edit'])->name('sopir.edit');
    Route::put('/sopir/{id}', [SopirController::class, 'update'])->name('sopir.update');
});

//Route kendaraan
Route::middleware(['auth', 'role:A,U'])->group(function () {
    Route::get('/kendaraan', [KendaraanController::class, 'index'])->name('kendaraan.index');
});
Route::middleware(['auth', 'role:A'])->group(function () {
    Route::get('/kendaraan/create', [KendaraanController::class, 'create'])->name('kendaraan.create');
    Route::post('/kendaraan', [KendaraanController::class, 'store'])->name('kendaraan.store');

    Route::get('/kendaraan/{id}/edit', [KendaraanController::class, 'edit'])->name('kendaraan.edit');
    Route::put('/kendaraan/{id}', [KendaraanController::class, 'update'])->name('kendaraan.update');
});

//Route Jadwal
Route::middleware(['auth', 'role:A'])->group(function () {
    Route::get('/jadwal/{id}/cetak', [JadwalController::class, 'cetak'])->name('jadwal.cetak');
});
Route::middleware(['auth'])->group(function () {
    Route::resource('jadwal', JadwalController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('pesan', PesanController::class);
    Route::get('/pesan/create/{jadwal_id?}', [PesanController::class, 'create'])->name('pesan.create');
    Route::get('/pesan/cetak/{id}', [PesanController::class, 'cetak'])->name('pesan.cetak');
    Route::patch('/pesan/{id}/konfirmasi', [PesanController::class, 'konfirmasi'])->name('pesan.konfirmasi');
    Route::patch('/pesan/{id}/batal', [PesanController::class, 'batal'])->name('pesan.batal');
});



require __DIR__.'/auth.php';
