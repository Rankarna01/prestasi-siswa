<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\TahunAjaranController;
use App\Http\Controllers\Admin\KelasController;

// Halaman Pengunjung (Akan dikerjakan belakangan)
Route::get('/', function () {
    // return view('pengunjung.home.index'); // Atau langsung ke route login untuk sementara
});

// Autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Area Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('siswa', SiswaController::class);
    Route::post('tahun-ajaran/{id}/set-aktif', [TahunAjaranController::class, 'setAktif'])->name('tahun-ajaran.set-aktif');
    Route::resource('tahun-ajaran', TahunAjaranController::class);
    Route::resource('kelas', KelasController::class)->except(['create', 'edit', 'show']);
});

// Area Kepala Sekolah
Route::middleware(['auth', 'role:kepala_sekolah'])->prefix('kepsek')->name('kepsek.')->group(function () {
    Route::get('/dashboard', function () {
        return view('kepsek.dashboard.index'); // Pastikan file ini dibuat nanti
    })->name('dashboard');
});