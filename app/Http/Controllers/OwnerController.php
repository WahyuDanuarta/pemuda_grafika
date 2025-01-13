<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\TransaksiOperasional;
use App\Models\TransaksiProduk;
use Carbon\Carbon;
use App\Models\DetailTransaksiProduk;
use App\Models\DetailTransaksiOperasional;
use Illuminate\Support\Facades\Validator;

class OwnerController extends Controller
{
    // Menampilkan Dashboard Admin Besar
    public function index()
    {
        // Hitung jumlah admin
        $admins = Admin::where('peran_id', 2)->count();

        // Hitung jumlah transaksi produk dan operasional
        $transaksiProduks = TransaksiProduk::where('status', 'sudah diambil (selesai)')->count();
        $transaksiOperasionals = TransaksiOperasional::count(); // Hitung semua transaksi operasional

        // Ambil data transaksi produk per minggu berdasarkan detail transaksi produk
        $transaksiProdukPerMinggu = DetailTransaksiProduk::selectRaw('YEAR(detail_transaksi_produks.created_at) as year, MONTH(detail_transaksi_produks.created_at) as month, FLOOR((DAY(detail_transaksi_produks.created_at)-1)/7) + 1 as week, COUNT(*) as count')
            ->join('transaksi_produks', 'detail_transaksi_produks.transaksi_produk_id', '=', 'transaksi_produks.id')
            ->where('transaksi_produks.status', 'sudah diambil (selesai)') // Filter berdasarkan status
            ->groupBy('year', 'month', 'week')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->orderBy('week', 'asc')
            ->pluck('count', 'week');

        // Ambil data transaksi operasional per minggu berdasarkan detail transaksi operasional
        $transaksiOperasionalPerMinggu = DetailTransaksiOperasional::selectRaw('YEAR(detail_transaksi_operasionals.created_at) as year, MONTH(detail_transaksi_operasionals.created_at) as month, FLOOR((DAY(detail_transaksi_operasionals.created_at)-1)/7) + 1 as week, COUNT(*) as count')
            ->join('transaksi_operasionals', 'detail_transaksi_operasionals.transaksi_operasional_id', '=', 'transaksi_operasionals.id')
            ->groupBy('year', 'month', 'week')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->orderBy('week', 'asc')
            ->pluck('count', 'week');

        // Kirim data ke view dashboard admin besar
        return view('pages.owner.dashboard', compact('admins', 'transaksiProduks', 'transaksiOperasionals', 'transaksiProdukPerMinggu', 'transaksiOperasionalPerMinggu'));
    }
    // Menampilkan daftar admin kecil
    public function listAdmin()
    {
        // Ambil data admin kecil berdasarkan peran_id = 2
        $admins = Admin::where('peran_id', 2)->get();

        // Menampilkan notifikasi jika ada
        if (session('success')) {
            Alert::success('Berhasil!', session('success'));
        }

        if (session('error')) {
            Alert::error('Error!', session('error'));
        }

        confirmDelete('Hapus Data!', 'Apakah anda yakin ingin menghapus data ini?');
        // Kirim data ke view
        return view('pages.owner.admins.index', compact('admins'));
    }

    // Menampilkan form tambah admin kecil
    public function create()
    {
        return view('pages.owner.admins.create');
    }

    // Menyimpan admin kecil baru
    public function storeAdmin(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'username' => 'required|string|unique:admins,username', // Hapus validasi 'email'
            'password' => 'required|string|min:9',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            // Menampilkan pesan error dengan SweetAlert
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan admin kecil
        Admin::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password), // Enkripsi password
            'peran_id' => 2, // Set peran_id untuk Admin Kecil
        ]);

        // Menampilkan pesan sukses dengan SweetAlert
        Alert::success('Berhasil!', 'Admin Kecil berhasil ditambahkan!');
        return redirect()->route('owner.admins')->with('success', 'Admin Kecil berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $admins = Admin::findOrFail($id);
        return view('pages.owner.admins.edit', compact('admins'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:admins,username,' . $id,
            'password' => 'nullable|min:9', // password bersifat opsional
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cari admin kecil yang akan diupdate
        $admins = Admin::findOrFail($id);

        // Update username
        $admins->username = $request->username;

        // Jika password baru diberikan
        if ($request->filled('password')) {
            // Hash password baru
            $admins->password = bcrypt($request->password);
        }

        // Simpan perubahan
        $admins->save();

        // Menampilkan pesan sukses di SweetAlert
        Alert::success('Berhasil!', 'Admin kecil berhasil diperbarui!');
        return redirect()->route('owner.admins')->with('success', 'Admin Kecil berhasil diperbarui!');
    }

    public function delete($id)
    {
        $admins = Admin::findOrFail($id);
        $admins->delete();
        
        if ($admins){
            Alert::success('Berhasil!', 'Admin Kecil Berhasil dihapus!');
            return redirect()->back();
        } else {
            Alert::error('Gagal!', 'Admin Kecil gagal dihapus!');
            return redirect()->back();
        }
    }

    public function laporanPenjualan()
    {
        // Logika menampilkan laporan penjualan
    }
}