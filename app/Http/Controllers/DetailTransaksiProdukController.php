<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksiProduk;
use App\Models\TransaksiProduk;
use Illuminate\Http\Request;

class DetailTransaksiProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = TransaksiProduk::with(['admin', 'detailTransaksiProduks.produk'])
            ->where('status', 'sudah diambil (selesai)') // Filter berdasarkan status transaksi
            ->orderBy('created_at', 'desc'); // Menambahkan orderBy untuk mengurutkan data berdasarkan created_at secara descending
    
        // Filter berdasarkan tanggal
        $query->when($request->filled('start_date'), function ($query) use ($request) {
            $query->whereDate('created_at', $request->start_date);
        })
        ->when($request->filled('start_year'), function ($query) use ($request) {
            $query->whereYear('created_at', $request->start_year);
        })
        ->when($request->filled('start_month'), function ($query) use ($request) {
            $query->whereMonth('created_at', $request->start_month);
        });
    
        // Ambil data transaksi produk sesuai filter
        $transaksiProduks = $query->get();
    
        // Validasi jika data transaksi tidak ditemukan
        if ($transaksiProduks->isEmpty()) {
            return view('pages.owner.detail_transaksi_produks.index', [
                'transaksiProduks' => $transaksiProduks,
                'total_harga_keseluruhan' => 0, // Total keseluruhan 0 jika tidak ada data
                'error' => 'Data transaksi produk tidak ditemukan. Silakan coba filter lainnya.',
                'produkTerlaris' => [] // Menampilkan produk terlaris kosong
            ]);
        }
    
        // Menambahkan detail transaksi produk setelah status transaksi selesai
        foreach ($transaksiProduks as $transaksi) {
            // Periksa apakah status transaksi sudah "sudah diambil(selesai)"
            if ($transaksi->status == 'sudah diambil(selesai)') {
                foreach ($transaksi->detailTransaksiProduks as $detail) {
                    // Simpan detail transaksi produk ke dalam tabel detail_transaksi_produk
                    DetailTransaksiProduk::create([
                        'transaksi_produk_id' => $transaksi->id,
                        'produk_id' => $detail->produk_id,
                        'total_produk' => $detail->total_produk,
                        'harga' => $detail->produk->harga,  // Sesuaikan dengan harga produk
                        // Kolom lain yang diperlukan, seperti diskon atau tambahan lainnya
                    ]);
                }
            }
    
            // Hitung total harga per transaksi
            $transaksi->total_harga = $transaksi->detailTransaksiProduks->sum(function ($detail) {
                return $detail->produk->harga * $detail->total_produk;
            });
        }
    
        // Hitung total keseluruhan
        $total_harga_keseluruhan = $transaksiProduks->sum('total_harga');
    
        // Menghitung produk terlaris
        $produkTerlaris = DetailTransaksiProduk::selectRaw('produk_id, SUM(total_produk) as total_terjual')
            ->groupBy('produk_id')
            ->orderByDesc('total_terjual')
            ->limit(5)  // Mengambil 5 produk terlaris
            ->get();
    
        // Mendapatkan informasi produk terkait
        $produkList = \App\Models\Produk::whereIn('id', $produkTerlaris->pluck('produk_id'))->get()->keyBy('id');
    
        // Menambahkan nama produk dan jumlah terjual ke dalam koleksi produk terlaris
        $produkTerlarisWithName = $produkTerlaris->map(function ($item) use ($produkList) {
            $produk = $produkList[$item->produk_id];
            $item->nama_produk = $produk->nama;
            return $item;
        });
    
        // Mengirimkan data ke view
        return view('pages.owner.detail_transaksi_produks.index', compact(
            'transaksiProduks', 
            'total_harga_keseluruhan',
            'produkTerlarisWithName' // Mengirimkan data produk terlaris
        ));
    }
    
}