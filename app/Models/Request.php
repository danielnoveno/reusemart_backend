<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Request extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'requests';
    protected $primaryKey = 'ID_REQUEST';
    public $timestamps = true;
    
    protected $fillable = [
        'ID_ORGANISASI',
        'ID_BARANG',
        'CREATE_AT',
        'DESKRIPSI_REQUEST',
        'STATUS_REQUEST',
    ];

    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class, 'ID_ORGANISASI', 'ID_ORGANISASI');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'ID_BARANG', 'ID_BARANG');
    }

    public function transaksiDonasis()
    {
        return $this->hasMany(TransaksiDonasi::class, 'ID_REQUEST', 'ID_REQUEST');
    }
}
