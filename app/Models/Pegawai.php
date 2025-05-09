<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawais';
    protected $primaryKey = 'ID_PEGAWAI';

    protected $fillable = [
        'ID_JABATAN',
        'NAMA_PEGAWAI',
        'NO_TELP_PEGAWAI',
        'EMAIL_PEGAWAI',
        'PASSWORD_PEGAWAI',
        'KOMISI_PEGAWAI',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pegawai) {
            $jabatan = Jabatan::find($pegawai->ID_JABATAN);

            if ($jabatan && strtolower($jabatan->NAMA_JABATAN) === 'Hunter') {
                $pegawai->KOMISI_PEGAWAI = Komisi::where('ID_PEGAWAI', $pegawai->ID_PEGAWAI)->sum('NOMINAL_KOMISI') ?? 0;
            } else {
                $pegawai->KOMISI_PEGAWAI = 0;
            }
        });
    }

    public function jabatans()
    {
        return $this->belongsTo(Jabatan::class, 'ID_JABATAN', 'ID_JABATAN');
    }

    public function komisis()
    {
        return $this->hasMany(Komisi::class, 'ID_PEGAWAI', 'ID_PEGAWAI');
    }
}
