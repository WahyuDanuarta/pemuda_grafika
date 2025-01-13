<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiOperasional;
use App\Models\KategoriOperasional;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\DetailTransaksiOperasional;

class TransaksiOperasionalController extends Controller
{
    public function index()
    {
        $transaksiOperasionals = TransaksiOperasional::with(['admin', 'detailTransaksiOperasionals.kategoriOperasional'])
            ->where('admin_id', Auth::id())
            ->orderBy('created_at', 'desc') 
            ->paginate(10); 

        confirmDelete('Hapus Data!', 'Apakah Anda yakin ingin menghapus data ini?');

        return view('pages.admin.transaksi_operasional.index', compact('transaksiOperasionals'));
    }

    public function detail($id)
    {
        // Ambil transaksi dengan detail yang diperlukan
        $transaksi = TransaksiOperasional::with(['admin', 'detailTransaksiOperasionals.kategoriOperasional'])
            ->where('admin_id', Auth::id())
            ->findOrFail($id);
        
        // Hitung total biaya dari detail transaksi
        $totalBiaya = 0;
        foreach ($transaksi->detailTransaksiOperasionals as $detail) {
            $totalBiaya += $detail->biaya;
        }

        // Tambahkan total biaya ke objek transaksi
        $transaksi->totalBiaya = $totalBiaya;

        // Kirim data transaksi ke view
        return view('pages.admin.transaksi_operasional.detail', compact('transaksi'));
    }


    public function create()
    {
        $kategori_operasionals = KategoriOperasional::all();
        return view('pages.admin.transaksi_operasional.create', compact('kategori_operasionals'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'keterangan' => 'required|string|max:255',
            'kategori_operasional_id' => 'required|array', // Harus berupa array
            'kategori_operasional_id.*' => 'exists:kategori_operasionals,id',
            'biaya' => 'required|array', // Biaya harus berupa array sesuai kategori
            'biaya.*' => 'numeric|min:0', // Validasi untuk setiap biaya
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        // Simpan data transaksi operasional
        $transaksi = TransaksiOperasional::create([
            'keterangan' => $validatedData['keterangan'],
            'admin_id' => Auth::id(),
        ]);

        // Simpan data detail transaksi operasional
        foreach ($validatedData['kategori_operasional_id'] as $index => $kategoriId) {
            // Hitung total_pengeluaran, misalnya total_pengeluaran = biaya * jumlah_item
            $biaya = $validatedData['biaya'][$index];
            $jumlahItem = 1; // Misalnya jumlah item adalah 1 (bisa disesuaikan sesuai kebutuhan)
            $totalPengeluaran = $biaya * $jumlahItem; // Sesuaikan rumus perhitungan ini dengan kebutuhan Anda

            // Insert data detail transaksi operasional, pastikan total_pengeluaran disertakan
            DetailTransaksiOperasional::create([
                'transaksi_operasional_id' => $transaksi->id,
                'kategori_operasional_id' => $kategoriId,
                'biaya' => $biaya,
                'total_pengeluaran' => $totalPengeluaran, // Menambahkan total_pengeluaran
            ]);
        }

        Alert::success('Berhasil!', 'Transaksi operasional berhasil ditambahkan!');
        return redirect()->route('admin.transaksi_operasional');
    }


    public function edit($id)
    {
        $transaksi = TransaksiOperasional::with('kategoriOperasionals')
            ->where('admin_id', Auth::id())
            ->findOrFail($id); 

        $kategori_operasionals = KategoriOperasional::all();

        return view('pages.admin.transaksi_operasional.edit', compact('transaksi', 'kategori_operasionals'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'keterangan' => 'required|string|max:255',
            'kategori_operasional_id' => 'required|array',
            'kategori_operasional_id.*' => 'exists:kategori_operasionals,id',
            'biaya' => 'required|array',
            'biaya.*' => 'numeric|min:0',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $transaksi = TransaksiOperasional::where('admin_id', Auth::id()) 
            ->findOrFail($id);
            
        $validatedData = $validator->validated();

        // Update data transaksi
        $transaksi->update([
            'keterangan' => $validatedData['keterangan'],
        ]);

        // Hapus detail transaksi sebelumnya
        $transaksi->detailTransaksiOperasionals()->delete();

        // Tambahkan detail transaksi baru
        foreach ($validatedData['kategori_operasional_id'] as $index => $kategoriId) {
            $biaya = $validatedData['biaya'][$index];
            $totalPengeluaran = $biaya; // Jika total_pengeluaran hanya sama dengan biaya

            DetailTransaksiOperasional::create([
                'transaksi_operasional_id' => $transaksi->id,
                'kategori_operasional_id' => $kategoriId,
                'biaya' => $biaya,
                'total_pengeluaran' => $totalPengeluaran, // Pastikan nilai ini disertakan
            ]);
        }


        Alert::success('Berhasil!', 'Transaksi operasional berhasil diperbarui!');
        return redirect()->route('admin.transaksi_operasional');
    }


    public function delete($id)
    {
        $transaksi = TransaksiOperasional::findOrFail($id);

        if ($transaksi->delete()) {
            Alert::success('Berhasil!', 'Transaksi operasional berhasil dihapus!');
        } else {
            Alert::error('Gagal!', 'Transaksi operasional gagal dihapus!');
        }

        return redirect()->route('admin.transaksi_operasional');
    }
}