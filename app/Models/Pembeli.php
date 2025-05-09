<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembeli extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'pembelis';
    protected $primaryKey = 'ID_PEMBELI';

    protected $fillable = [
        'NAMA_PEMBELI',
        'TGL_LAHIR_PEMBELI',
        'NO_TELP_PEMBELI',
        'EMAIL_PEMBELI',
        'POINT_LOYALITAS_PEMBELI',
        'PASSWORD_PEMBELI',
    ];
}
