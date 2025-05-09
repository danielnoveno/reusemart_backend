<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiPenitipanBarang extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'transaksi_penitipan_barangs';
    protected $primaryKey = 'ID_TRANSAKSI_PENITIPAN';
    public $timestamps = true;

    protected $fillable = [
        'ID_PENITIP',
        'TGL_MASUK_TITIPAN',
        'TGL_KELUAR_TITIPAN',
        'NO_NOTA_TRANSAKSI_TITIPAN',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $tahun = Carbon::now()->format('y');
            $bulan = Carbon::now()->format('m');

            $model->NO_NOTA_TRANSAKSI_TITIPAN = "{$tahun}.{$bulan}.{$model->getNextId()}";
        });
    }

    protected function getNextId()
    {
        $lastId = static::max('ID_TRANSAKSI_PENITIPAN');
        return $lastId ? $lastId + 1 : 1;
    }

    public function penitip()
    {
        return $this->belongsTo(Penitip::class, 'ID_PENITIP', 'ID_PENITIP');
    }

    public function detailTransaksiPenitipans()
    {
        return $this->hasMany(DetailTransaksiPenitipBarang::class, 'ID_TRANSAKSI_PENITIPAN', 'ID_TRANSAKSI_PENITIPAN');
    }

    public function pegawaiTransaksiPenitipans()
    {
        return $this->hasMany(PegawaiTransaksiPenitipan::class, 'ID_TRANSAKSI_PENITIPAN', 'ID_TRANSAKSI_PENITIPAN');
    }
}
