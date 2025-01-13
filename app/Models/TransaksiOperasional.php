<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiOperasional extends Model
{
    use HasFactory;

    protected $table = 'transaksi_operasionals'; // Nama tabel
    protected $fillable = ['keterangan', 'admin_id' ]; // Kolom yang dapat diisi

    /**
     * Relasi ke model Admin
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    /**
     * Relasi ke model KategoriOperasional
     */
    public function detailTransaksiOperasionals()
    {
        return $this->hasMany(DetailTransaksiOperasional::class, 'transaksi_operasional_id');
    }

    // Relasi many-to-many ke KategoriOperasional
    public function kategoriOperasionals()
    {
        return $this->belongsToMany(
            KategoriOperasional::class,         // Model KategoriOperasional
            'detail_transaksi_operasionals',   // Nama tabel pivot
            'transaksi_operasional_id',        // Foreign key di tabel pivot untuk TransaksiOperasional
            'kategori_operasional_id'          // Foreign key di tabel pivot untuk KategoriOperasional
        );
    }

}
