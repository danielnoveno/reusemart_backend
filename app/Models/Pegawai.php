<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'ID_PEGAWAI';
    public $timestamps = false;

    protected $fillable = [
        'ID_JABATAN',
        'NAMA_PEGAWAI',
        'NO_TELP_PEGAWAI',
        'EMAIL_PEGAWAI',
        'KOMISI_PEGAWAI'
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'ID_JABATAN', 'ID_JABATAN');
    }
}
