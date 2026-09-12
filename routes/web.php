<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Guest Routes (Tamu)
|--------------------------------------------------------------------------
*/
Route::get('/', [GuestController::class, 'beranda'])->name('guest.beranda');
Route::get('/beranda', [GuestController::class, 'beranda'])->name('guest.beranda');
Route::post('/beranda/upload', [GuestController::class, 'storeUpload'])->name('guest.store');
Route::get('/hasil-analisis', [GuestController::class, 'hasilAnalisis'])->name('guest.hasil');
Route::post('/hasil-analisis/verifikasi', [GuestController::class, 'verifikasiUlang'])->name('guest.verifikasi');
Route::get('/hasil-analisis/download', [GuestController::class, 'downloadLaporan'])->name('guest.download.laporan');

/*
|--------------------------------------------------------------------------
| Authentication Routes (Login & Register)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

/*
|--------------------------------------------------------------------------
| User Panel Routes
|--------------------------------------------------------------------------
*/
Route::prefix('user')->group(function () {
    Route::get('/riwayat', [UserController::class, 'riwayat'])->name('user.riwayat');
    Route::get('/beranda', [UserController::class, 'beranda'])->name('user.beranda');
    Route::post('/beranda', [UserController::class, 'storeUpload'])->name('user.store');
    Route::get('/hasil/{id?}', [UserController::class, 'hasil'])->name('user.hasil');
    Route::post('/hasil/{id}/verifikasi', [UserController::class, 'verifikasi'])->name('user.verifikasi');
    Route::get('/abaikan', [UserController::class, 'abaikan'])->name('user.abaikan');

    // Fitur Tambahan Panel User
    Route::get('/search', [UserController::class, 'search'])->name('user.search');
    Route::get('/video-tersimpan', [UserController::class, 'videoTersimpan'])->name('user.video.tersimpan');
    Route::get('/analisis-selesai', [UserController::class, 'analisisSelesai'])->name('user.analisis.selesai');
    Route::get('/penyimpanan', [UserController::class, 'penyimpanan'])->name('user.penyimpanan');
    Route::delete('/penyimpanan/{id}', [UserController::class, 'hapusVideo'])->name('user.penyimpanan.hapus');

    Route::get('/notifikasi', [UserController::class, 'notifikasi'])->name('user.notifikasi');
    Route::get('/setelan', [UserController::class, 'setelan'])->name('user.setelan');
    Route::post('/setelan', [UserController::class, 'updateSetelan'])->name('user.setelan.update');
    Route::get('/profil', [UserController::class, 'profil'])->name('user.profil');

    Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
});
