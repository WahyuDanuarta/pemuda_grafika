<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';
    protected $fillable = ['nama_produk', 'harga', 'stok', 'deskripsi', 'kategori_id', 'view_count'];

    /**
     * Relasi dengan model KategoriProduk
     */
    public function kategori()
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_id');
    }

    public function detailTransaksiProduks()
    {
        return $this->hasMany(DetailTransaksiProduk::class, 'produk_id');
    }

     // Definisikan relasi ke model Image
     public function images()
     {
         return $this->hasMany(Image::class);
     }
 

    // Method untuk menambah jumlah view_count
    public function incrementViewCount()
    {
        $this->increment('view_count'); // Tambah 1 ke kolom view_count
    }
}