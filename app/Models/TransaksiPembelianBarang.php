<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiPembelianBarang extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'transaksi_pembelian_barangs';
    protected $primaryKey = 'ID_TRANSAKSI_PEMBELIAN';
    public $timestamps = true;

    protected $fillable = [
        'ID_PEMBELI',
        'BUKTI_TRANSFER',
        'TGL_AMBIL_KIRIM',
        'TGL_LUNAS_PEMBELIAN',
        'TGL_PESAN_PEMBELIAN',
        'TOT_HARGA_PEMBELIAN',
        'STATUS_TRANSAKSI',
        'DELIVERY_METHOD',
        'ONGKOS_KIRIM',
        'POIN_DIDAPAT',
        'POIN_POTONGAN',
        'STATUS_BUKTI_TRANSFER',
    ];

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'ID_PEMBELI', 'ID_PEMBELI');
    }

    public function detailTransaksiPembelians()
    {
        return $this->hasMany(DetailTransaksiPembelianBarang::class, 'ID_TRANSAKSI_PEMBELIAN', 'ID_TRANSAKSI_PEMBELIAN');
    }

    public function pegawaiTransaksiPembelians()
    {
        return $this->hasMany(PegawaiTransaksiPembelian::class, 'ID_TRANSAKSI_PEMBELIAN', 'ID_TRANSAKSI_PEMBELIAN');
    }

    public function komisis()
    {
        return $this->hasMany(Komisi::class, 'ID_TRANSAKSI_PEMBELIAN', 'ID_TRANSAKSI_PEMBELIAN');
    }
}
