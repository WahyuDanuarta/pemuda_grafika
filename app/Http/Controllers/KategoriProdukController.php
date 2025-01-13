<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use App\Models\Produk; // Import model Produk
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Import Validator
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

class KategoriProdukController extends Controller
{
    public function index()
    {
        $kategori_produks = KategoriProduk::paginate(10);
        confirmDelete('Hapus Data!', 'Apakah anda yakin ingin menghapus data ini?');
        return view('pages.admin.kategori_produks.index', compact('kategori_produks'));
    }

    public function create()
    {
        return view('pages.admin.kategori_produks.create');
    }
    
    public function store(Request $request)
    {
        // Gunakan Validator::make seperti di file lama
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Menyimpan data kategori produk jika validasi berhasil
        KategoriProduk::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        // Menampilkan pesan sukses di SweetAlert
        Alert::success('Berhasil!', 'Kategori Produk berhasil ditambahkan!');
        return redirect()->route('admin.kategori_produks')->with('success', 'Kategori Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kategori_produks = KategoriProduk::findOrFail($id);
        return view('pages.admin.kategori_produks.edit', compact('kategori_produks'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input menggunakan Validator::make()
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kategori_produks = KategoriProduk::findOrFail($id);
        $kategori_produks->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        // Menampilkan pesan sukses di SweetAlert
        Alert::success('Berhasil!', 'Kategori Produk berhasil diperbarui!');
        return redirect()->route('admin.kategori_produks')->with('success', 'Kategori Produk berhasil diperbarui!');
    }

    public function delete($id)
    {
        $kategori_produks = KategoriProduk::findOrFail($id);
        $kategori_produks->delete();
        
        if ($kategori_produks){
            Alert::success('Berhasil!', 'Kategori Produk Berhasil dihapus!');
            return redirect()->back();
        } else {
            Alert::error('Gagal!', 'Kategori Produk gagal dihapus!');
            return redirect()->back();
        }
    }

    // public function showKategori()
    // {
    //     // Mendapatkan semua kategori produk
    //     $kategori_produks = KategoriProduk::all();  
    //     return view('pengunjung.kategori', compact('kategori_produks'));
    // }

// public function showKategori($id)
// {
//     // Ambil data kategori berdasarkan ID
//     $kategori = Kategori::find($id);

//     // Jika kategori tidak ditemukan, lempar error atau redirect
//     if (!$kategori) {
//         return redirect()->route('home')->with('error', 'Kategori tidak ditemukan.');
//     }

//     // Ambil produk yang sesuai dengan kategori
//     $produks = Produk::where('kategori_id', $id)->get();

//     // Kirim data ke view
//     return view('pengunjung.kategori', [
//         'kategori_produks' => $kategori,
//         'produks' => $produks,
//     ]);
// }


}