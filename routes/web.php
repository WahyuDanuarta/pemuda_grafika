<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\TransaksiProdukController;
use App\Http\Controllers\TransaksiOperasionalController;
use App\Http\Controllers\KategoriOperasionalController;
use App\Http\Controllers\PengunjungController;
use App\Http\Controllers\DetailTransaksiOperasionalController;
use App\Http\Controllers\DetailTransaksiProdukController;


// Route untuk login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

// Middleware untuk Owner
Route::middleware(['role:Owner'])->group(function () {
    Route::get('/owner/dashboard', [OwnerController::class, 'index'])->name('owner.dashboard');
    
    //admin
    Route::get('/owner/admins', [OwnerController::class, 'index'])->name('owner.admins');
    Route::get('/owner/admins', [OwnerController::class, 'listAdmin'])->name('owner.admins');
    Route::get('/owner/admins/create', [OwnerController::class, 'create'])->name('owner.admins.create');
    Route::post('/owner/admins', [OwnerController::class, 'storeAdmin'])->name('owner.admins.store');
    Route::get('/owner/admins/{id}/edit', [OwnerController::class, 'edit'])->name('owner.admins.edit');
    Route::put('/owner/admins/{id}', [OwnerController::class, 'update'])->name('owner.admins.update');
    Route::delete('/owner/admins/{id}', [OwnerController::class, 'delete'])->name('owner.admins.delete');

    // Menampilkan semua detail transaksi produk
    Route::get('detail_transaksi_produks', [DetailTransaksiProdukController::class, 'index'])->name('owner.detail_transaksi_produks');

    //pengeluaran
    Route::middleware(['auth'])->prefix('admin')->group(function () {
        Route::get('/owner/detail_transaksi_operasionals', [DetailTransaksiOperasionalController::class, 'index'])->name('owner.detail_transaksi_operasionals');
    });
});


// Middleware untuk Admin Kecil
Route::middleware(['role:Admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/produk', [ProdukController::class, 'index'])->name('admin.produk');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('admin.produk.create'); // Harus sama
    Route::post('/produk', [ProdukController::class, 'store'])->name('admin.produk.store');
    Route::get('admin/produk/{id}/detail', [ProdukController::class, 'detail'])->name('admin.produk.detail');
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('admin.produk.edit');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('admin.produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'delete'])->name('admin.produk.delete');

    //kategori produk
    Route::get('/admin/kategori_produks', [KategoriProdukController::class, 'index'])->name('admin.kategori_produks');
    Route::get('/admin/kategori_produks/create', [KategoriProdukController::class, 'create'])->name('admin.kategori_produks.create');
    Route::post('/admin/kategori_produks', [KategoriProdukController::class, 'store'])->name('admin.kategori_produks.store');
    Route::get('/admin/kategori_produks/{id}/edit', [KategoriProdukController::class, 'edit'])->name('admin.kategori_produks.edit');
    Route::put('/admin/kategori_produks/{id}', [KategoriProdukController::class, 'update'])->name('admin.kategori_produks.update');
    Route::delete('/admin/kategori_produks/{id}', [KategoriProdukController::class, 'delete'])->name('admin.kategori_produks.delete');

    //transaksi produk
    Route::get('/admin/transaksi_produks', [TransaksiProdukController::class, 'index'])->name('admin.transaksi_produks');
    Route::get('/admin/transaksi_produks/create', [TransaksiProdukController::class, 'create'])->name('admin.transaksi_produks.create');
    Route::post('/admin/transaksi_produks', [TransaksiProdukController::class, 'store'])->name('admin.transaksi_produks.store');
    Route::get('/admin/transaksi_produks/{id}/edit', [TransaksiProdukController::class, 'edit'])->name('admin.transaksi_produks.edit');
    Route::put('/admin/transaksi_produks/{id}', [TransaksiProdukController::class, 'update'])->name('admin.transaksi_produks.update');
    Route::delete('/admin/transaksi_produks/{id}', [TransaksiProdukController::class, 'delete'])->name('admin.transaksi_produks.delete');
    Route::get('/admin/transaksi_produks/detail/{id}', [TransaksiProdukController::class, 'detail'])->name('admin.transaksi_produks.detail');

    // Transaksi Operasional
    Route::get('/transaksi-operasional', [TransaksiOperasionalController::class, 'index'])->name('admin.transaksi_operasional');
    Route::get('/transaksi-operasional/create', [TransaksiOperasionalController::class, 'create'])->name('admin.transaksi_operasional.create');
    Route::post('/transaksi-operasional', [TransaksiOperasionalController::class, 'store'])->name('admin.transaksi_operasional.store');
    Route::get('/transaksi-operasional/{id}', [TransaksiOperasionalController::class, 'detail'])->name('admin.transaksi_operasional.detail');
    Route::get('/transaksi-operasional/{id}/edit', [TransaksiOperasionalController::class, 'edit'])->name('admin.transaksi_operasional.edit');
    Route::put('/transaksi-operasional/{id}', [TransaksiOperasionalController::class, 'update'])->name('admin.transaksi_operasional.update');
    Route::delete('/transaksi-operasional/{id}', [TransaksiOperasionalController::class, 'delete'])->name('admin.transaksi_operasional.delete');

    //kategori operasional 
    Route::get('kategori_operasional', [KategoriOperasionalController::class, 'index'])->name('admin.kategori_operasional');
    Route::get('kategori_operasional/create', [KategoriOperasionalController::class, 'create'])->name('admin.kategori_operasional.create');
    Route::post('kategori_operasional', [KategoriOperasionalController::class, 'store'])->name('admin.kategori_operasional.store');
    Route::get('kategori_operasional/{id}/edit', [KategoriOperasionalController::class, 'edit'])->name('admin.kategori_operasional.edit');
    Route::put('kategori_operasional/{id}', [KategoriOperasionalController::class, 'update'])->name('admin.kategori_operasional.update');
    Route::delete('kategori_operasional/{id}/delete', [KategoriOperasionalController::class, 'delete'])->name('admin.kategori_operasional.delete');
});

// Pengunjung
Route::prefix('/')->group(function () {
    Route::get('/', [PengunjungController::class, 'index'])->name('pengunjung.beranda');
    Route::get('/', [ProdukController::class, 'showProduk'])->name('pengunjung.beranda'); // Ini akan menimpa yang di atas
    Route::get('/kategori', [PengunjungController::class, 'kategori'])->name('kategori');
    Route::get('/about', [PengunjungController::class, 'about'])->name('about');
    Route::get('/produk/detail/{id}/detail/', [ProdukController::class, 'DetailPengunjung'])->name('produk.detail');
    Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show'); // Pastikan ini ada
    Route::get('/kategori/{id}', [ProdukController::class, 'KategoriPengunjung'])->name('kategori.show');
    Route::get('/search', [PengunjungController::class, 'search'])->name('pengunjung.search');
    // Route::get('/produk/{id}', [ProdukController::class, 'DetailPengunjung'])->name('pengunjung.detail');
    // Route untuk menampilkan detail produk
    Route::get('/produk/detail/{id}', [ProdukController::class, 'DetailPengunjung'])->name('pengunjung.detail');
});

//log out admin
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



