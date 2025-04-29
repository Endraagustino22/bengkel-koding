<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;

// authentication routes
Route::get('/', [AuthController::class, 'form']);
Route::get('/login', [AuthController::class, 'form'])->name('login');
Route::get('/register', [AuthController::class, 'formRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// dokter and obat routes
Route::middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
    Route::get('/dokter/periksa', [DokterController::class, 'periksa'])->name('dokter.periksa');
    Route::get('/dokter/edit-periksa/{id}', [DokterController::class, 'editPeriksa'])->name('dokter.edit-periksa');
    Route::put('/dokter/update-periksa/{id}', [DokterController::class, 'updatePeriksa'])->name('dokter.update-periksa');
    Route::get('/dokter/form-periksa/{id}', [DokterController::class, 'formPeriksa'])->name('dokter.form-periksa');
    Route::post('/dokter/periksa-store/{id}', [DokterController::class, 'periksaStore'])->name('dokter.periksa-store');
    Route::get('/obat', [ObatController::class, 'index'])->name('obat.index');
    Route::get('/obat/{id}/edit', [ObatController::class, 'edit'])->name('obat.edit');
    Route::put('/obat/{id}', [ObatController::class, 'update'])->name('obat.update');
    Route::post('/obat', [ObatController::class, 'store'])->name('obat.store');
    Route::get('/obat/create', [ObatController::class, 'create'])->name('obat.create');
    Route::delete('/obat/{id}', [ObatController::class, 'destroy'])->name('obat.destroy');
});

Route::middleware(['auth', 'role:pasien'])->group(function () {
    // routes for pasien
    Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index');
    Route::get('/pasien/create', [PasienController::class, 'create'])->name('pasien.create');
    Route::post('/pasien', [PasienController::class, 'store'])->name('pasien.store');
});
    