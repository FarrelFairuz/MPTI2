<?php

/*
|--------------------------------------------------------------------------
| Rute Web - Gurau Tenda Palembang
|--------------------------------------------------------------------------
| File ini mendefinisikan semua rute (URL) yang bisa diakses pengunjung.
| Rute dihubungkan ke Controller yang akan memproses logika aplikasi.
|--------------------------------------------------------------------------
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controller\BerandaController;
use App\Http\Controller\AdminController;
use App\Http\Controller\PemesananController;

// ─── HALAMAN UTAMA ─────────────────────────────────────────────
// Menampilkan halaman beranda lengkap dengan semua section
Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/sewa-tenda', [BerandaController::class, 'sewaTenda'])->name('sewa-tenda');
Route::get('/kost-putri', [BerandaController::class, 'kostPutri'])->name('kost-putri');
Route::get('/testimoni', [BerandaController::class, 'testimoni'])->name('testimoni');

// ─── API CEK KETERSEDIAAN KAMAR KOST ───────────────────────────
// Dipanggil via JavaScript (fetch/AJAX) ketika pengunjung klik tombol "Cek"
Route::get('/cek-kamar', [BerandaController::class, 'cekKetersediaan'])->name('kamar.cek');

// ─── RUTE ADMIN ────────────────────────────────────────────────
// Login admin (POST = proses form login)
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');

// Simpan status ketersediaan kamar (hanya bisa diakses admin yang sudah login)
Route::post('/admin/simpan-status', [AdminController::class, 'simpanStatus'])
    ->name('admin.simpanStatus')
    ->middleware('auth.admin'); // Middleware cek sesi admin

// Logout admin
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Menyimpan pemesanan baru dari kalkulator (dipanggil saat klik WhatsApp)
Route::post('/pemesanan/simpan', [PemesananController::class, 'simpan'])
    ->name('pemesanan.simpan');
 
// Mengambil daftar history pemesanan (hanya admin)
Route::get('/admin/pemesanan', [PemesananController::class, 'daftarPemesanan'])
    ->name('admin.pemesanan')
    ->middleware('auth.admin');