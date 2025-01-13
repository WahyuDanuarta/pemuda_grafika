<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\KategoriProduk;
use App\Models\Image;
use App\Models\DetailTransaksiProduk;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('images')->paginate(10);
        confirmDelete('Hapus Data!', 'Apakah anda yakin ingin menghapus data ini?');
        return view('pages.admin.produk.index', compact('produks'));
    }

    public function create()
    {
        $kategori_produks = KategoriProduk::all();
        return view('pages.admin.produk.create', compact('kategori_produks'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'images.*' => 'required|mimes:png,jpeg,jpg', // Validasi untuk banyak gambar
            'kategori_id' => 'required|exists:kategori_produks,id',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan produk
        $validatedData = $validator->validated();
        $produk = Produk::create($validatedData);

        // Simpan gambar
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);

                // Simpan ke tabel images
                Image::create([
                    'produk_id' => $produk->id,
                    'filename' => $imageName,
                ]);
            }
        }

        Alert::success('Berhasil!', 'Produk berhasil ditambahkan!');
        return redirect()->route('admin.produk');
    }

    // Menambahkan fungsi show untuk detail produk
    public function detail($id)
    {
        $produk = Produk::with('images')->findOrFail($id);
        return view('pages.admin.produk.detail', compact('produk'));
    }

    public function edit($id)
    {
        $produk = Produk::with('images')->findOrFail($id); // Mengambil produk beserta gambar
        $kategori_produks = KategoriProduk::all(); // Ambil data kategori produk
        return view('pages.admin.produk.edit', compact('produk', 'kategori_produks')); // Kirim data kategori
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'kategori_id' => 'required|exists:kategori_produks,id',
            'delete_images' => 'array', // Validasi untuk gambar yang akan dihapus
            'delete_images.*' => 'exists:images,id', // Pastikan ID gambar yang dihapus ada di tabel images
            'images.*' => 'nullable|mimes:png,jpeg,jpg', // Validasi untuk gambar baru
        ]);

        $produk = Produk::findOrFail($id);

        // Hapus gambar yang dipilih
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = Image::findOrFail($imageId);
                $oldPath = public_path('images/' . $image->filename);
                if (File::exists($oldPath)) {
                    File::delete($oldPath); // Hapus file gambar dari server
                }
                $image->delete(); // Hapus entri gambar dari database
            }
        }

        // Update gambar baru jika ada
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Simpan gambar baru
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName); // Simpan file baru

                // Simpan ke tabel images
                Image::create([
                    'produk_id' => $produk->id,
                    'filename' => $imageName,
                ]);
            }
        }

        // Update data produk
        $produk->update([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori_id,
        ]);

        // Redirect dengan SweetAlert
        Alert::success('Berhasil!', 'Produk berhasil diperbarui!');
        return redirect()->route('admin.produk');
    }

    public function delete($id)
    {
        $produk = Produk::findOrFail($id);

        // Cek apakah gambar ada, lalu hapus
        $imagePath = public_path('images/' . $produk->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        if ($produk->delete()) {
            // SweetAlert jika berhasil
            Alert::success('Berhasil!', 'Produk berhasil dihapus!');
        } else {
            // SweetAlert jika gagal
            Alert::error('Gagal!', 'Produk gagal dihapus!');
        }

        return redirect()->route('admin.produk'); 
    }

    public function showProduk()
    {
        // Mengambil semua produk beserta kategori
        $produks = Produk::with('kategori')->orderByDesc('view_count')->get();
        $kategori_produks = KategoriProduk::all(); // Ambil semua kategori

        // Mengambil produk terlaris berdasarkan total produk yang terjual lebih dari 5
        $produkTerlaris = \App\Models\DetailTransaksiProduk::selectRaw('produk_id, SUM(total_produk) as total_terjual')
            ->join('transaksi_produks', 'transaksi_produks.id', '=', 'detail_transaksi_produks.transaksi_produk_id')
            ->where('transaksi_produks.status', 'sudah diambil (selesai)') // Pastikan transaksi sudah sudah_diambil
            ->groupBy('produk_id')
            ->havingRaw('SUM(total_produk) >= 5')  // Filter produk yang terjual lebih dari 5
            ->orderByDesc('total_terjual')
            ->get();

        // Mendapatkan data produk terkait
        $produkList = \App\Models\Produk::with('images')->whereIn('id', $produkTerlaris->pluck('produk_id'))->get()->keyBy('id');

        $produkTerlarisWithName = $produkTerlaris->map(function ($item) use ($produkList) {
            $produk = $produkList[$item->produk_id];
            $item->nama_produk = $produk->nama_produk;
            $item->harga_produk = $produk->harga;
            $item->view_count = $produk->view_count; // Menambahkan view count
            // Ambil gambar pertama atau gambar default
            $item->gambar_produk = $produk->images->isNotEmpty() ? $produk->images->first()->filename : 'default.png';
            return $item;
        });
        
        // Mengirimkan data ke view beranda
        return view('pengunjung.beranda', compact('produks', 'kategori_produks', 'produkTerlarisWithName'));
    }

    public function DetailPengunjung($id)
    {
        $produk = Produk::findOrFail($id); // Cari produk berdasarkan ID
        $produk->incrementViewCount();  // Tambahkan 1 ke kolom view_count
        $kategori_produks = KategoriProduk::all(); // Ambil semua kategori
        return view('pengunjung.detail', compact('produk', 'kategori_produks')); // Kirimkan data produk dan kategori
    }

    public function KategoriPengunjung($id)
    {
        $kategori = KategoriProduk::findOrFail($id); // Cari kategori berdasarkan ID
        $produks = Produk::where('kategori_id', $id)->get(); // Cari produk dengan kategori yang sesuai
        $kategori_produks = KategoriProduk::all(); // Ambil semua kategori
        return view('pengunjung.kategori', compact('kategori', 'produks', 'kategori_produks'));
    }

    // public function show($id)
    // {
    //     // Ambil data produk berdasarkan ID
    //     // $produk = Produk::findOrFail($id);
    //     $produk = Produk::with('images')->findOrFail($id); // Mengambil produk beserta gambar
    //     $kategori_produks = KategoriProduk::all(); // Ambil semua kategori

    //     // Kirimkan data ke view
    //     return view('pengunjung.detail', compact('produk', 'kategori_produks'));
    // }
    public function show($id)
    {
        $produk = Produk::with('images')->findOrFail($id); // Mengambil produk beserta gambar
        return view('pengunjung.detail', compact('produk')); // Pastikan view yang benar
    }
}