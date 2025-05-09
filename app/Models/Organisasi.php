<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organisasi extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'organisasis';
    protected $primaryKey = 'ID_ORGANISASI';

    protected $fillable = [
        'NAMA_ORGANISASI',
        'ALAMAT_ORGANISASI',
        'NO_TELP_ORGANISASI',
        'EMAIL_ORGANISASI',
        'PASSWORD_ORGANISASI',
    ];
}
