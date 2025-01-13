<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\KategoriProduk;

class PengunjungController extends Controller
{
    public function index()
    {
        return view('pengunjung.beranda');
    }
    public function kategori()
    {
        return view('pengunjung.kategori'); // Mengarahkan ke file blade di folder pengunjung
    }

    public function detail()
    {
        return view('pengunjung.kategori'); // Mengarahkan ke file blade di folder pengunjung
    }

    public function about()
    {
        $kategori_produks = KategoriProduk::all();
        return view('pengunjung.about',compact('kategori_produks'));; // Mengarahkan ke file blade di folder pengunjung
    }

    // Metode pencarian produk
    public function search(Request $request)
    {
        $keyword = $request->input('search');
        $produks = Produk::where('nama_produk', 'like', '%' . $keyword . '%')->get();
        $kategori_produks = KategoriProduk::all(); // Ambil semua kategori

        return view('pengunjung.search', compact('produks', 'kategori_produks'));
    }
}
