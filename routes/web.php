<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JadwalPeriksaController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterProfileController;
use App\Http\Controllers\PasienProfileController;

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
    Route::get('/form-periksa/{id}', [DokterController::class, 'formPeriksa'])->name('dokter.form-periksa');
    Route::post('/periksa-store/{id}', [DokterController::class, 'periksaStore'])->name('dokter.periksa-store');
    Route::get('/riwayat-pasien', [DokterController::class, 'riwayatPasien'])->name('dokter.riwayat-pasien');
    Route::get('/jadwal-periksa', [JadwalPeriksaController::class, 'index'])->name('dokter.jadwal-periksa');
    Route::get('/dokter/edit-profile', [DokterController::class, 'editProfile'])->name('dokter.edit-profile');
    Route::put('/dokter/update-profile', [DokterController::class, 'updateProfile'])->name('dokter.update-profile');
    Route::resource('jadwal', JadwalPeriksaController::class)->middleware(['auth', 'role:dokter']);
});

Route::middleware(['auth', 'role:pasien'])->group(function () {
    // routes for pasien
    Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index');
    Route::get('/pasien/daftar-poli', [PasienController::class, 'showDaftarPoliForm'])->name('pasien.daftar_poli.form');
    Route::post('/pasien/daftar-poli', [PasienController::class, 'storeDaftarPoli'])->name('pasien.daftar_poli.store');
});

// jadwal periksa routes

// admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('dokter-profiles', DokterProfileController::class);
    Route::resource('pasien-profiles', PasienProfileController::class);
    Route::resource('poli', \App\Http\Controllers\PoliController::class);
    Route::resource('obat', ObatController::class);
});
