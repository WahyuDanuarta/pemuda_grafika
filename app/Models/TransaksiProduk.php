<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiProduk extends Model
{
    use HasFactory;

    protected $table = 'transaksi_produks';
    protected $fillable = ['nama', 'keterangan', 'alamat', 'jumlah', 'status', 'admin_id'];

    /**
     * Relasi dengan model Produk
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function detailTransaksiProduks()
    {
        return $this->hasMany(DetailTransaksiProduk::class, 'transaksi_produk_id');
    }

}