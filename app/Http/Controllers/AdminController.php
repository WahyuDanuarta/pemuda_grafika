<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\KategoriProduk;
use App\Models\TransaksiProduk;
use App\Models\TransaksiOperasional;
use App\Models\KategoriOperasional;

class AdminController extends Controller
{
    // Menampilkan dashboard Admin Kecil
    public function index()
    {
        $produks = Produk::count(); // Jumlah total produk
        $kategori_produks = KategoriProduk::count();
        $transaksi_produks = TransaksiProduk::count();
        $transaksi_operasionals = TransaksiOperasional::count();
        $kategori_operasionals = KategoriOperasional::count();

        return view('pages.admin.dashboard', compact('produks', 'kategori_produks', 'transaksi_produks', 'transaksi_operasionals', 'kategori_operasionals')); // Sesuaikan dengan nama view Anda
    }

    // Metode lainnya untuk Admin Kecil
    public function kelolaTransaksi()
    {
        // Logika CRUD untuk transaksi
    }
}
