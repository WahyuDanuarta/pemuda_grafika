<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['produk_id', 'filename'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
