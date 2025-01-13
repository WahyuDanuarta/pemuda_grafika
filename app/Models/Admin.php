<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['nama', 'username', 'password', 'peran_id'];

    protected $hidden = ['password'];

    public function peran()
    {
        return $this->belongsTo(Peran::class, 'peran_id');
    }
}
