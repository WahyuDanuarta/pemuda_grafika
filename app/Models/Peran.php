<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peran extends Model
{
    use HasFactory;

    protected $fillable = ['nama_peran'];

    public function admins()
    {
        return $this->hasMany(Admin::class, 'peran_id');
    }
}

