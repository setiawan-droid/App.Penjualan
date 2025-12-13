<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes Aplikasi Kasir
|--------------------------------------------------------------------------
| Semua halaman aplikasi hanya dapat diakses setelah login.
| Breeze akan mengarahkan user ke halaman login jika belum login.
*/

// Arahkan halaman utama ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard default Breeze → arahkan ke Home aplikasi kamu
Route::get('/dashboard', function () {
    return redirect()->route('home');
})->name('dashboard');

// Routes bawaan Breeze (login, register, logout)
require __DIR__.'/auth.php';

// Semua route aplikasi hanya bisa diakses setelah login
Route::middleware(['auth'])->group(function () {

    // HOME
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // BARANG
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/barang/tambah', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang/tambah', [BarangController::class, 'store'])->name('barang.store');
    
    Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

    // KASIR
    Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');
    Route::post('/kasir/add', [KasirController::class, 'add'])->name('kasir.add');
    Route::post('/kasir/checkout', [KasirController::class, 'checkout'])->name('kasir.checkout');
    Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');
    Route::post('/kasir/add', [KasirController::class, 'add'])->name('kasir.add');
    Route::post('/kasir/submit', [KasirController::class, 'submit'])->name('kasir.submit');
    Route::post('/kasir/plus/{id}', [KasirController::class, 'plus'])->name('kasir.plus');
    Route::post('/kasir/minus/{id}', [KasirController::class, 'minus'])->name('kasir.minus');
    Route::post('/kasir/delete/{id}', [KasirController::class, 'delete'])->name('kasir.delete');

    // TRANSAKSI
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::resource('transaksi', TransaksiController::class)->middleware('auth');
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/tambah', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi/tambah', [TransaksiController::class, 'store'])->name('transaksi.store');


    // LAPORAN
    Route::middleware(['auth'])->group(function () {
    Route::get('/laporan', [\App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/pdf', [\App\Http\Controllers\LaporanController::class, 'exportPdf'])
    ->name('laporan.pdf')
    ->middleware('auth');

});

});
