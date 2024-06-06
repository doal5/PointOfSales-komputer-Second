<?php

use App\Http\Controllers\analisisController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\laporanController;
use App\Http\Controllers\produkController;
use App\Http\Controllers\supplierController;
use App\Http\Controllers\transaksiController;
use App\Http\Controllers\transaksiDetailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//!=============================== Route Dashboard =======================================
Route::get('/', [dashboardController::class, 'index'])->name('dashboard');


//!=============================== Route Produk ==========================================
Route::get('produk', [produkController::class, 'index'])->name('produk.index');
//!Menampilkan data produk dari database
Route::get('read', [produkController::class, 'read'])->name('produk.read');
Route::get('produkcreate', [produkController::class, 'create'])->name('produk.create');
Route::post('produkstore', [produkController::class, 'store'])->name('produk.store');
Route::get('produkshow/{id}', [produkController::class, 'show'])->name('produk.show');
Route::get('produkdetail/{id}', [produkController::class, 'detail']);
Route::put('produkupdate/{id}', [produkController::class, 'update']);
Route::get('produkhapus/{id}', [produkController::class, 'destroy']);
Route::delete('produkhapusmultiple/{id}', [produkController::class, 'destroyMultiple']);


//!=============================== Route Kategori ==========================================
Route::get('kategori', [kategoriController::class, 'index'])->name('kategori.index');
Route::get('kategoriread', [kategoriController::class, 'read'])->name('kategori.read');
Route::get('create', [kategoriController::class, 'create'])->name('kategori.create');
Route::get('tambah', [kategoriController::class, 'store'])->name('kategori.store');
Route::get('kategorihapus/{id}', [kategoriController::class, 'destroy']);
Route::delete('kategorihapusmultiple/{id}', [kategoriController::class, 'destroyMultiple']);


//! =============================== Route Supplier ==========================================
Route::get('supplier', [supplierController::class, 'index'])->name('supplier.index');
Route::get('supplierread', [supplierController::class, 'read'])->name('supplier.read');
Route::get('suppliercreate', [supplierController::class, 'create'])->name('supplier.create');
Route::get('supplierstore', [supplierController::class, 'store'])->name('supplier.store');
Route::get('suppliershow/{id}', [supplierController::class, 'show']);
Route::get('supplierupdate/{id}', [supplierController::class, 'update']);
Route::get('supplierhapus/{id}', [supplierController::class, 'destroy']);
Route::delete('supplierhapusmultiple/{id}', [supplierController::class, 'destroymultiple']);


//! =============================== Route Transaksi ==========================================
Route::get('transaksi', [transaksiController::class, 'index'])->name('transaksi.index');
Route::get('transaksi/tambah', [transaksiController::class, 'create'])->name('transaksi.create');
Route::get('transaksi/{id}/edit', [transaksiController::class, 'edit'])->name('transaksi.edit');
Route::delete('transaksihapusmultiple/{id}', [transaksiController::class, 'hapusmultiple']);



//! =============================== Route Transaksi Detail ==========================================
Route::post('transaksiDetail/store', [transaksiDetailController::class, 'store'])->name('transaksidetail.store');
Route::get('transaksiDetail/delete', [transaksiDetailController::class, 'delete'])->name('transaksidetail.delete');
Route::get('transaksiDetail/selesai/{id}', [transaksiDetailController::class, 'selesai']);
Route::get('transaksishow/{id}', [transaksiController::class, 'show'])->name('transaksi.show');
Route::get('detail-transaksi/{id}', [transaksiController::class, 'detail']);

//! =============================== Route Laporan ==========================================
Route::get('laporan', [laporanController::class, 'index'])->name('laporan.index');

//! =============================== Route analisis ==========================================
Route::get('analisis', [analisisController::class, 'index'])->name('analisis.index');
