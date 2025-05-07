<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penitip extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'penitips';
    protected $primaryKey = 'ID_PENITIP';

    protected $fillable = [
        'NAMA_PENITIP',
        'NO_KTP',
        'ALAMAT_PENITIP',
        'TGL_LAHIR_PENITIP',
        'NO_TELP_PENITIP',
        'EMAIL_PENITIP',
        'PASSWORD_PENITIP',
    ];
    protected $hidden = [
        'PASSWORD_PENITIP',
    ];
}
