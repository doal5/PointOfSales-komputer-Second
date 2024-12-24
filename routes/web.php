<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\produkController;
use App\Http\Controllers\laporanController;
use App\Http\Controllers\analisisController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\supplierController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\pengeluaranController;
use App\Http\Controllers\pengeluarandetailController;
use App\Http\Controllers\pengeluaranTokoController;
use App\Http\Controllers\transaksiController;
use App\Http\Controllers\transaksiDetailController;
use App\Models\pengeluaran_detail;
use App\Models\transaksiDetail;

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

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [loginController::class, 'index'])->name('login');
    Route::post('login-proses', [loginController::class, 'login_proses'])->name('login-proses');
});

Route::get('logout', [loginController::class, 'logout'])->name('logout');


Route::group(['middleware' => 'auth'], function () {
    // mengirim parameter level
    Route::group(['middleware' => 'level:1'], function () {
        //!=============================== Route Dashboard =======================================
        Route::get('dashboard', [dashboardController::class, 'index'])->name('dashboard');
        //!=============================== Route Produk ==========================================
        Route::get('produk', [produkController::class, 'index'])->name('produk.index');
        //!Menampilkan data produk dari database
        Route::get('read', [produkController::class, 'read'])->name('produk.read');
        Route::get('produkcreate', [produkController::class, 'create'])->name('produk.create');
        Route::post('produkstore', [produkController::class, 'store'])->name('produk.store');
        Route::get('produkshow/{id}', [produkController::class, 'show'])->name('produk.show');
        Route::get('produkdetail/{id}', [produkController::class, 'detail']);
        Route::post('produkupdate/{id}', [produkController::class, 'update']);
        Route::get('produkhapus/{id}', [produkController::class, 'destroy']);
        Route::delete('produkhapusmultiple/{id}', [produkController::class, 'destroyMultiple']);

        //!=============================== Route registrasi ==========================================
        Route::get('registrasi', [loginController::class, 'registrasi'])->name('registrasi');
        Route::post('insertregistrasi', [loginController::class, 'insertRegistrasi'])->name('registrasi-insert');

        //!=============================== Route Kategori ==========================================
        Route::get('kategori', [kategoriController::class, 'index'])->name('kategori.index');
        Route::get('kategoriread', [kategoriController::class, 'read'])->name('kategori.read');
        Route::get('create', [kategoriController::class, 'create'])->name('kategori.create');
        Route::get('tambah', [kategoriController::class, 'store'])->name('kategori.store');
        Route::get('kategorishow/{id}', [kategoriController::class, 'show']);
        Route::get('kategoriupdate/{id}', [kategoriController::class, 'update']);
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


        //! =============================== Route Laporan ==========================================
        Route::get('laporan', [laporanController::class, 'index'])->name('laporan.index');
        Route::get('laporan/{tglawal}/{tglakhir}/{total}/{totalPengeluaran}', [laporanController::class, 'cetak']);

        //! =============================== Route analisis ==========================================
        Route::get('analisis', [analisisController::class, 'index'])->name('analisis.index');
        Route::get('analisisread', [analisisController::class, 'read'])->name('analisis.read');
        Route::get('analisiscetak/{kategori}', [analisisController::class, 'cetak'])->name('analisis.cetak');

        //!=============================== Route user ==========================================
        Route::get('user', [userController::class, 'index'])->name('user.index');
        //!Menampilkan data user dari database
        Route::get('userread', [userController::class, 'read'])->name('user.read');
        Route::get('usercreate', [userController::class, 'create'])->name('user.create');
        Route::post('userstore', [userController::class, 'store'])->name('user.store');
        Route::get('userShow/{id}', [userController::class, 'show'])->name('user.show');
        Route::get('userdetail/{id}', [userController::class, 'detail']);
        Route::post('userUpdate/{id}', [userController::class, 'update']);
        Route::get('userHapus/{id}', [userController::class, 'destroy']);
        Route::delete('userhapusmultiple/{id}', [userController::class, 'destroyMultiple']);

        //!=============================== Route pengeluaran ==========================================
        Route::get('pengeluaran', [pengeluaranController::class, 'index'])->name('pengeluaran.index');
        //!Menampilkan data pengeluaran dari database
        Route::get('pengeluaranread', [pengeluaranController::class, 'read'])->name('pengeluaran.read');
        Route::get('pengeluarancreate', [pengeluaranController::class, 'create'])->name('pengeluaran.create');
        Route::get('pengeluaran/{id}/edit', [pengeluaranController::class, 'edit'])->name('pengeluaran.edit');
        Route::post('pengeluaranstore', [pengeluaranController::class, 'store'])->name('pengeluaran.store');
        Route::get('pengeluaranShow/{id}', [pengeluaranController::class, 'show'])->name('pengeluaran.show');
        Route::get('pengeluaranbatal/{id}', [pengeluaranController::class, 'batal']);
        Route::get('pengeluarandetail/{id}', [pengeluaranController::class, 'detail']);
        Route::post('pengeluaranUpdate/{id}', [pengeluaranController::class, 'update']);
        Route::get('pengeluaranHapus/{id}', [pengeluaranController::class, 'destroy']);
        Route::delete('pengeluaranhapusmultiple/{id}', [pengeluaranController::class, 'destroyMultiple']);
        Route::post('pengeluaranUpd', [pengeluaranController::class, 'updPengeluaran'])->name('pengeluaranUpd');

        // route pengeluaran detail
        Route::post('pengeluarandetailstore', [pengeluarandetailController::class, 'store'])->name('pengeluarandetail.store');
        Route::get('pengeluaranDetail/delete', [pengeluarandetailController::class, 'delete'])->name('pengeluaran_detail.delete');


        //!=============================== Route pengeluaran ==========================================
        Route::get('pengeluaranToko', [pengeluaranTokoController::class, 'index'])->name('pengeluaranToko.index');
        //!Menampilkan data pengeluaran dari database
        Route::get('pengeluaranTokocreate', [pengeluaranTokoController::class, 'create'])->name('pengeluaranToko.create');
        Route::get('pengeluaranToko/{id}/edit', [pengeluaranTokoController::class, 'edit'])->name('pengeluaranToko.edit');
        Route::post('pengeluaranTokostore', [pengeluaranTokoController::class, 'store'])->name('pengeluaranToko.store');
        Route::get('pengeluaranTokoShow/{id}', [pengeluaranTokoController::class, 'show'])->name('pengeluaranToko.show');
        Route::get('pengeluaranTokobatal/{id}', [pengeluaranTokoController::class, 'batal']);
        Route::get('pengeluaranTokodetail/{id}', [pengeluaranTokoController::class, 'detail']);
        Route::post('pengeluaranTokoUpdate/{id}', [pengeluaranTokoController::class, 'update']);
        Route::get('pengeluaranTokoHapus/{id}', [pengeluaranTokoController::class, 'destroy']);
        Route::delete('pengeluaranTokohapusmultiple/{id}', [pengeluaranTokoController::class, 'destroyMultiple']);
        Route::post('pengeluaranTokoUpd', [pengeluaranTokoController::class, 'updPengeluaran'])->name('pengeluaranToko');

        // route pengeluaran detail
        Route::post('pengeluarandetailstore', [pengeluarandetailController::class, 'store'])->name('pengeluarandetail.store');
        Route::get('pengeluaranDetail/delete', [pengeluarandetailController::class, 'delete'])->name('pengeluaran_detail.delete');
    });

    Route::get(
        'transaksi',
        [transaksiController::class, 'index']
    )->name('transaksi.index');

    Route::get('transaksi/tambah', [transaksiController::class, 'create'])->name('transaksi.create');
    Route::get('transaksi/{id}/edit', [transaksiController::class, 'edit'])->name('transaksi.edit');
    Route::get('produk/{id}', [transaksiController::class, 'getProduk']);
    Route::delete('transaksihapusmultiple/{id}', [transaksiController::class, 'hapusmultiple']);
    Route::get('transaksiBatal/{id}', [transaksiController::class, 'kembali']);

    //! =============================== Route Transaksi Detail ==========================================
    Route::post('transaksiDetail/store', [transaksiDetailController::class, 'store'])->name('transaksidetail.store');
    Route::get('transaksiDetail/delete', [transaksiDetailController::class, 'delete'])->name('transaksidetail.delete');
    Route::get('transaksiDetail/selesai/{id}', [transaksiDetailController::class, 'selesai']);
    Route::get('struk/{id}', [transaksiDetailController::class, 'invoice']);
    Route::get('transaksishow/{id}', [transaksiController::class, 'show'])->name('transaksi.show');
    Route::get('detail-transaksi/{id}', [transaksiController::class, 'detail']);
    Route::post('/produk/cek-stok', [transaksiDetailController::class, 'cekStok']);

    Route::post('transaksidetail/updateQty', [transaksiDetailController::class, 'updateQty'])->name('transaksidetail.updateQty');
    Route::post('/transaksi/update-diskon-total', [transaksiController::class, 'updateDiskonTotal']);
});
