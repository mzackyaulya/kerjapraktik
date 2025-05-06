<?php

use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\RuteController;
use App\Http\Controllers\SopirController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.main');
});

Route::resource('rute', RuteController::class);
Route::resource('sopir', SopirController::class);
Route::resource('kendaraan', KendaraanController::class);
