<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Barang extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'barangs';
    protected $primaryKey = 'ID_BARANG';
    public $timestamps = false;

    protected $fillable = [
        'ID_KATEGORI',
        'NAMA_BARANG',
        'KODE_BARANG',
        'HARGA_BARANG',
        'TGL_MASUK',
        'TGL_KELUAR',
        'TGL_AMBIL',
        'GARANSI',
        'BERAT',
        'DESKRIPSI',
        'RATING',
        'STATUS_BARANG',
    ];

    protected $casts = [
        'TGL_MASUK' => 'date',
        'TGL_KELUAR' => 'date',
        'TGL_AMBIL' => 'date',
        'GARANSI' => 'date',
    ];

    public function kategoribarang()
    {
        return $this->belongsTo(Kategoribarang::class, 'ID_KATEGORI', 'ID_KATEGORI');
    }

    public function diskusis()
    {
        return $this->hasMany(Diskusi::class, 'ID_BARANG', 'ID_BARANG');
    }

    public function detailTransaksiPembelians()
    {
        return $this->hasMany(DetailTransaksiPembelianBarang::class, 'ID_BARANG', 'ID_BARANG');
    }

    public function detailTransaksiPenitipans()
    {
        return $this->hasMany(DetailTransaksiPenitipBarang::class, 'ID_BARANG', 'ID_BARANG');
    }

    public function requests()
    {
        return $this->hasMany(Request::class, 'ID_BARANG', 'ID_BARANG');
    }

    protected static function booted()
    {
        static::creating(function ($barang) {
            $prefix = strtoupper(Str::substr($barang->NAMA_BARANG, 0, 1));
            $kategori = Kategoribarang::find($barang->ID_KATEGORI);

            if ($kategori) {
                $nomor = $kategori->JML_PRODUK + 1;
                $kategori->increment('JML_PRODUK');
                $barang->KODE_BARANG = $prefix . str_pad($nomor, 4, '0', STR_PAD_LEFT);
            }

            if (empty($barang->STATUS_BARANG)) {
                $barang->STATUS_BARANG = 'Tersedia';
            }
        });
    }
}
