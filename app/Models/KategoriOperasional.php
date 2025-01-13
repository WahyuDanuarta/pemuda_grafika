<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriOperasional extends Model
{
    use HasFactory;

    protected $table = 'kategori_operasionals';
    protected $fillable = ['jenis_operasional'];

    public function detailTransaksiOperasionals()
    {
        return $this->hasMany(DetailTransaksiOperasional::class, 'kategori_id');
    }
    public function kategoriOperasional()
    {
        return $this->belongsTo(KategoriOperasional::class, 'kategori_operasional_id');
    }

}
