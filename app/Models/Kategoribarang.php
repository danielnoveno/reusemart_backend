<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategoribarang extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'kategoribarangs';
    protected $primaryKey = 'ID_KATEGORI';
    public $timestamps = false;
    protected $appends = ['JML_BARANG'];

    protected $fillable = [
        'NAMA_KATEGORI',
        'JML_PRODUK',
    ];

    public function produks()
    {
        return $this->hasMany(Barang::class, 'ID_KATEGORI', 'ID_KATEGORI');
    }

    public function getJMLBARANGAttribute()
    {
        return $this->produks()->count();
    }
}
