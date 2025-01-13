<?php

namespace App\Http\Controllers;

use App\Models\TransaksiProduk;
use App\Models\Produk;
use App\Models\Admin; // Pastikan mengimpor model Admin
use App\Models\DetailTransaksiProduk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Pagination\Paginator;

class TransaksiProdukController extends Controller
{
    public function index()
    {
        $transaksi_produks = TransaksiProduk::with(['detailTransaksiProduks.produk'])
            ->where('admin_id', Auth::id())
            ->orderBy('created_at', 'desc') 
            ->paginate(10); 
    
        return view('pages.admin.transaksi_produks.index', compact('transaksi_produks'));
    }
    
    
    public function boot()
    {
        Paginator::useBootstrap();
    }

    public function create()
    {
        $admins = Admin::where('peran_id', 4)->get();
        $produks = Produk::all();
        return view('pages.admin.transaksi_produks.create', compact('produks', 'admins'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'alamat' => 'required|string|max:255',
            'status' => 'required|in:pesanan diterima,proses desain,proses revisi,proses cetak,bisa diambil,sudah diambil (selesai),pesanan batal', // Update validasi status
            'produk_id' => 'required|array|min:1',
            'produk_id.*' => 'exists:produks,id',
            'total_produk' => 'required|array|min:1',
            'total_produk.*' => 'integer|min:1',
        ]);
        
    
        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua data terisi dengan benar.');
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $admin = Auth::user();
        if (!$admin) {
            Alert::error('Gagal!', 'Admin tidak ditemukan.');
            return redirect()->back();
        }
    
        // Pengecekan stok produk terlebih dahulu
        foreach ($request->produk_id as $index => $produkId) {
            $produk = Produk::find($produkId);
            if (!$produk) {
                Alert::error('Gagal!', 'Produk dengan ID ' . $produkId . ' tidak ditemukan.');
                return redirect()->back();
            }
    
            $totalProduk = $request->total_produk[$index];
            
            // Pengecekan stok produk
            if ($produk->stok < $totalProduk) {
                Alert::error('Gagal!', 'Stok produk ' . $produk->nama_produk . ' tidak mencukupi.');
                return redirect()->back();
            }
        }
    
        // Simpan data transaksi utama jika stok mencukupi
        $transaksiProduk = TransaksiProduk::create([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'alamat' => $request->alamat,
            'status' => $request->status,
            'admin_id' => $admin->id,
        ]);
    
        $totalHarga = 0;
    
        // Simpan detail transaksi produk
        foreach ($request->produk_id as $index => $produkId) {
            $produk = Produk::find($produkId);
            $totalProduk = $request->total_produk[$index];
            $hargaTotalProduk = $produk->harga * $totalProduk;
    
            // Tambahkan data ke tabel detail transaksi produk
            DetailTransaksiProduk::create([
                'transaksi_produk_id' => $transaksiProduk->id,
                'produk_id' => $produkId,
                'total_produk' => $totalProduk,
                'total_harga' => $hargaTotalProduk,
            ]);
    
            $totalHarga += $hargaTotalProduk;
    
            // Logika stok berkurang jika status adalah 'pesanan diterima'
            if ($request->status == 'pesanan diterima') {
                foreach ($request->produk_id as $index => $produkId) {
                    $produk = Produk::find($produkId);
                    $totalProduk = $request->total_produk[$index];
                    
                    // Pastikan stok cukup sebelum mengurangi
                    if ($produk->stok < $totalProduk) {
                        Alert::error('Gagal!', 'Stok produk ' . $produk->nama_produk . ' tidak mencukupi.');
                        return redirect()->back();
                    }

                    // Kurangi stok produk jika status pesanan diterima
                    $produk->stok -= $totalProduk;
                    $produk->save();
                }
            }

        }
    
        Alert::success('Berhasil!', 'Transaksi Produk berhasil ditambahkan!');
        return redirect()->route('admin.transaksi_produks')->with('success', 'Transaksi Produk berhasil ditambahkan!');
    }

    public function detail($id)
    {
        // Mengambil transaksi utama beserta detail produk dan admin
        $transaksiProduk = TransaksiProduk::with(['detailTransaksiProduks.produk', 'admin'])
            ->where('admin_id', Auth::id())
            ->findOrFail($id);
    
        // Menghitung total jumlah dan total harga produk
        $totalJumlah = $transaksiProduk->detailTransaksiProduks->sum('total_produk');
        $totalHarga = $transaksiProduk->detailTransaksiProduks->sum(function ($detail) {
            return $detail->total_harga;
        });
    
        // Melempar data ke view
        return view('pages.admin.transaksi_produks.detail', compact('transaksiProduk', 'totalJumlah', 'totalHarga'));
    }

    public function edit($id)
    {
        // Ambil transaksi produk berdasarkan ID
        $transaksi_produks = TransaksiProduk::where('admin_id', Auth::id())->findOrFail($id);
    
        // Cek apakah status transaksi sudah sudah diambil (selesai)
        if ($transaksi_produks->status == 'sudah diambil (selesai)') {
            Alert::error('Transaksi Selesai!', 'Transaksi ini sudah diambil (selesai) dan tidak bisa diedit.');
            return redirect()->route('admin.transaksi_produks');
        }
    
        // Ambil semua produk yang ada
        $produks = Produk::all();
    
        // Ambil detail transaksi produk yang terkait dengan transaksi ini
        $detailTransaksiProduks = DetailTransaksiProduk::where('transaksi_produk_id', $id)->get();
    
        return view('pages.admin.transaksi_produks.edit', compact('transaksi_produks', 'produks', 'detailTransaksiProduks'));
    }
    
    public function update(Request $request, $id)
    {
        // Ambil transaksi produk yang akan diupdate
        $transaksi_produks = TransaksiProduk::where('admin_id', Auth::id())->findOrFail($id);

        // Cek apakah status transaksi sudah sudah diambil (selesai)
        if ($transaksi_produks->status == 'sudah diambil (selesai)') {
            Alert::error('Gagal!', 'Transaksi ini sudah diambil (selesai) dan tidak bisa diperbarui.');
            return redirect()->route('admin.transaksi_produks');
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'alamat' => 'required|string|max:255',
            'status' => 'required|in:pesanan diterima,proses desain,proses revisi,proses cetak,bisa diambil,sudah diambil (selesai),pesanan batal', // Update validasi status
            'produk_id' => 'required|array|min:1',
            'produk_id.*' => 'exists:produks,id',
            'total_produk' => 'required|array|min:1',
            'total_produk.*' => 'integer|min:1',
        ]);
        

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua data terisi dengan benar.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $admin = Auth::user();
        if (!$admin) {
            Alert::error('Gagal!', 'Admin tidak ditemukan.');
            return redirect()->back();
        }

        // Update data transaksi utama
        $transaksi_produks->update([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'alamat' => $request->alamat,
            'status' => $request->status,
            'admin_id' => $admin->id,
        ]);

       // Cek apakah status transaksi berubah menjadi 'pesanan batal'
        if ($request->status == 'pesanan batal') {
            // Mengembalikan stok produk untuk transaksi yang dibatalkan
            foreach ($transaksi_produks->detailTransaksiProduks as $detail) {
                $produk = $detail->produk;
                $produk->stok += $detail->total_produk;  // Menambahkan stok produk yang dibatalkan
                $produk->save();  // Simpan perubahan stok
            }
        }

        // Hapus detail transaksi produk lama
        DetailTransaksiProduk::where('transaksi_produk_id', $id)->delete();

        $totalHarga = 0;

        // Pengecekan stok produk
        foreach ($request->produk_id as $index => $produkId) {
            $produk = Produk::find($produkId);
            if (!$produk) {
                Alert::error('Gagal!', 'Produk dengan ID ' . $produkId . ' tidak ditemukan.');
                return redirect()->back();
            }

            $totalProduk = $request->total_produk[$index];
            
            // Pengecekan stok produk
            if ($produk->stok < $totalProduk) {
                Alert::error('Gagal!', 'Stok produk ' . $produk->nama_produk . ' tidak mencukupi.');
                return redirect()->back();
            }

            $hargaTotalProduk = $produk->harga * $totalProduk;

            // Tambahkan data ke tabel detail transaksi produk
            DetailTransaksiProduk::create([
                'transaksi_produk_id' => $transaksi_produks->id,
                'produk_id' => $produkId,
                'total_produk' => $totalProduk,
                'total_harga' => $hargaTotalProduk,
            ]);

            $totalHarga += $hargaTotalProduk;

           // Update stok produk jika statusnya "pesanan diterima"
            if ($request->status == 'pesanan diterima') {
                $produk->stok -= $totalProduk;  // Kurangi stok produk
                $produk->save();  // Simpan perubahan stok
            }        

        }

        Alert::success('Berhasil!', 'Transaksi Produk berhasil diperbarui!');
        return redirect()->route('admin.transaksi_produks')->with('success', 'Transaksi Produk berhasil diperbarui!');
    }

    public function delete($id)
    {
        $transaksi_produks = TransaksiProduk::findOrFail($id);
        $transaksi_produks->delete();

        if ($transaksi_produks) {
            Alert::success('Berhasil!', 'Transaksi Produk berhasil dihapus!');
            return redirect()->back();
        } else {
            Alert::error('Gagal!', 'Transaksi Produk gagal dihapus!');
            return redirect()->back();
        }
    }
}