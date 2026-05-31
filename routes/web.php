<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// -------------------------------------------------------
//  HALAMAN PUBLIK
// -------------------------------------------------------
Route::get('/', fn() => view('welcome'));

// -------------------------------------------------------
//  AUTH (login, register, dll — dibuat oleh Breeze)
// -------------------------------------------------------
require __DIR__.'/auth.php';

// -------------------------------------------------------
//  ROUTES YANG BUTUH LOGIN (semua role)
// -------------------------------------------------------
Route::middleware(['auth', 'verified'])->group(function () {

    // Redirect dashboard ke halaman sesuai role
    Route::get('/dashboard', function () {
        return match(auth()->user()->role) {
            'admin'     => redirect()->route('admin.dashboard'),
            'dosen'     => redirect()->route('dosen.bimbingan'),
            'mahasiswa' => redirect()->route('mahasiswa.dashboard'),
            default     => redirect('/'),
        };
    })->name('dashboard');

    // Profile (semua role bisa)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // -------------------------------------------------------
    //  MAHASISWA
    // -------------------------------------------------------
    Route::middleware('role:mahasiswa')
        ->prefix('mahasiswa')
        ->name('mahasiswa.')
        ->group(function () {
            Route::get('/dashboard',    [MahasiswaController::class, 'dashboard'])->name('dashboard');
            Route::get('/daftar',       [MahasiswaController::class, 'formPengajuan'])->name('daftar');
            Route::post('/daftar',      [MahasiswaController::class, 'simpanPengajuan'])->name('daftar.simpan');
            Route::get('/status',       [MahasiswaController::class, 'status'])->name('status');
            Route::get('/skor',         [MahasiswaController::class, 'skorSaya'])->name('skor');
        });

    // -------------------------------------------------------
    //  DOSEN
    // -------------------------------------------------------
    Route::middleware('role:dosen')
        ->prefix('dosen')
        ->name('dosen.')
        ->group(function () {
            Route::get('/bimbingan',                [DosenController::class, 'bimbingan'])->name('bimbingan');
            Route::get('/verifikasi/{id}',          [DosenController::class, 'formVerifikasi'])->name('verifikasi');
            Route::post('/verifikasi/{id}',         [DosenController::class, 'prosesVerifikasi'])->name('verifikasi.proses');
            Route::get('/laporan',                  [DosenController::class, 'laporan'])->name('laporan');
        });

    // -------------------------------------------------------
    //  ADMIN JURUSAN
    // -------------------------------------------------------
    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('/dashboard',            [AdminController::class, 'dashboard'])->name('dashboard');
            
            // Kelola Beasiswa & Pengguna (Tambahan berdasarkan ERD)
            Route::resource('beasiswa', \App\Http\Controllers\BeasiswaController::class);
            Route::resource('pengguna', \App\Http\Controllers\PenggunaController::class);

            Route::get('/ranking',              [AdminController::class, 'ranking'])->name('ranking');
            Route::post('/ranking/hitung',      [AdminController::class, 'hitungSAW'])->name('ranking.hitung');
            Route::post('/ranking/tetapkan',    [AdminController::class, 'tetapkanHasil'])->name('ranking.tetapkan');
            Route::get('/bobot',                [AdminController::class, 'bobot'])->name('bobot');
            Route::post('/bobot',               [AdminController::class, 'simpanBobot'])->name('bobot.simpan');
            Route::post('/bobot/tambah',        [AdminController::class, 'tambahKriteria'])->name('bobot.tambah');
            Route::delete('/bobot/{id}',        [AdminController::class, 'hapusKriteria'])->name('bobot.hapus');
            Route::get('/data',                 [AdminController::class, 'data'])->name('data');
            Route::get('/laporan',              [AdminController::class, 'laporan'])->name('laporan');
        });
});