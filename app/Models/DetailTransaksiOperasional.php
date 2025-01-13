<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksiOperasional extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_operasional_id',
        'kategori_operasional_id',
        'biaya',
        'total_pengeluaran',
    ];

    public function transaksiOperasional()
    {
        return $this->belongsTo(TransaksiOperasional::class, 'transaksi_operasional_id');
    }

    public function kategorioperasional()
    {
    return $this->belongsTo(KategoriOperasional::class, 'kategori_operasional_id');
    }
    
}
