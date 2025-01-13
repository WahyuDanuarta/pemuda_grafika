<?php

namespace App\Http\Controllers;

use App\Models\KategoriOperasional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Import Validator
use RealRashid\SweetAlert\Facades\Alert;

class KategoriOperasionalController extends Controller
{
    // Menampilkan daftar kategori operasional
    public function index()
    {
        $kategoriOperasional = KategoriOperasional::paginate(10);
        confirmDelete('Hapus Data!', 'Apakah anda yakin ingin menghapus data ini?');
        return view('pages.admin.kategori_operasional.index', compact('kategoriOperasional'));
    }

    // Menampilkan form untuk membuat kategori operasional baru
    public function create()
    {
        return view('pages.admin.kategori_operasional.create');
    }

    // Menyimpan kategori operasional baru
    public function store(Request $request)
    {
        // Validasi input menggunakan Validator::make()
        $validator = Validator::make($request->all(), [
            'jenis_operasional' => 'required|string|max:255',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Menyimpan kategori operasional jika validasi berhasil
        KategoriOperasional::create([
            'jenis_operasional' => $request->jenis_operasional,
        ]);

        // Menampilkan pesan sukses di SweetAlert
        Alert::success('Berhasil!', 'Kategori Operasional berhasil ditambahkan!');
        return redirect()->route('admin.kategori_operasional')->with('success', 'Kategori Operasional berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit kategori operasional
    public function edit($id)
    {
        $kategoriOperasional = KategoriOperasional::findOrFail($id);
        return view('pages.admin.kategori_operasional.edit', compact('kategoriOperasional'));
    }

    // Memperbarui kategori operasional
    public function update(Request $request, $id)
    {
        // Validasi input menggunakan Validator::make()
        $validator = Validator::make($request->all(), [
            'jenis_operasional' => 'required|string|max:255',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kategoriOperasional = KategoriOperasional::findOrFail($id);
        $kategoriOperasional->update([
            'jenis_operasional' => $request->jenis_operasional,
        ]);

        // Menampilkan pesan sukses di SweetAlert
        Alert::success('Berhasil!', 'Kategori Operasional berhasil diperbarui!');
        return redirect()->route('admin.kategori_operasional')->with('success', 'Kategori Operasional berhasil diperbarui');
    }

    // Menghapus kategori operasional
    public function delete($id)
    {
        $kategoriOperasional = KategoriOperasional::findOrFail($id);
        $kategoriOperasional->delete();
        
        if ($kategoriOperasional) {
            Alert::success('Berhasil!', 'Kategori Operasional berhasil dihapus!');
            return redirect()->back();
        } else {
            Alert::error('Gagal!', 'Kategori Operasional gagal dihapus!');
            return redirect()->back();
        }
    }
}
