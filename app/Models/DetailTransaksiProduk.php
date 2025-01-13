<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksiProduk extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi_produks';

    protected $fillable = [
        'transaksi_produk_id',
        'produk_id',
        'total_produk',
        'total_harga',
    ];

    // Relasi ke TransaksiProduk
    public function transaksiProduk()
    {
        return $this->belongsTo(TransaksiProduk::class, 'transaksi_produk_id');
    }

    // Relasi ke Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id'); // Ganti 'admin_id' dengan nama kolom relasi di tabel Anda
    }


}