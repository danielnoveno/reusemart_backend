<?php
// app/Models/Alamat.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alamat extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'alamats';
    protected $primaryKey = 'ID_ALAMAT';
    public $timestamps = false;
    protected $fillable = [
        'ID_PEMBELI',
        'JUDUL',
        'NAMA_JALAN',
        'PROVINSI',
        'KABUPATEN',
        'KECAMATAN',
        'DESA_KELURAHAN',
    ];
    protected static function booted()
    {
        static::saving(function ($alamat) {
            if ($alamat->isDirty('DESA_KELURAHAN')) {
                $desa = DesaKelurahan::find($alamat->DESA_KELURAHAN);
                $alamat->DESA_KELURAHAN = $desa->nama_desa_kelurahan;

                $kecamatan = Kecamatan::find($desa->id_kecamatan);
                $alamat->KECAMATAN = $kecamatan->nama_kecamatan;

                $kabupaten = Kabupaten::find($kecamatan->id_kabupaten_kota);
                $alamat->KABUPATEN = $kabupaten->nama_kabupaten_kota;

                $provinsi = Provinsi::find($kabupaten->id_provinsi);
                $alamat->PROVINSI = $provinsi->nama_provinsi;
            }
        });
    }
    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'ID_PEMBELI', 'ID_PEMBELI');
    }
    public function provinsiData()
    {
        return $this->belongsTo(Provinsi::class, 'PROVINSI', 'nama_provinsi');
    }
    public function kabupatenData()
    {
        return $this->belongsTo(Kabupaten::class, 'KABUPATEN', 'nama_kabupaten_kota');
    }
    public function kecamatanData()
    {
        return $this->belongsTo(Kecamatan::class, 'KECAMATAN', 'nama_kecamatan');
    }
    public function desaData()
    {
        return $this->belongsTo(DesaKelurahan::class, 'DESA_KELURAHAN', 'nama_desa_kelurahan');
    }
}
