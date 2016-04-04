<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    protected $table = 'penduduk';
    protected $connection = 'db_ppl_core';
    public $incrementing = false;
    
    protected $morphClass = 'MorphPenduduk';

    protected $dates = ['tanggal_lahir'];
    protected $fillable = [
        'id',
        'nama',
        'tanggal_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'id_keluarga',
        'id_ayah',
        'id_ibu',
        'hubungan_keluarga',
        'golongan_darah',
        'agama',
        'wni',
        'status_perkawinan',
        'pekerjaan',
        'pendidikan',
        'id_izin_tetap',
        'id_passport',
        'status',
    ];

    public function setUpdatedAt($value)
    {
        // Do nothing.
    }

    public static function generateId($kelurahanId, $tanggalLahir)
    {
        $kelurahan = Kelurahan::findOrFail($kelurahanId);
        $kecamatan = $kelurahan->kecamatan;
        $kota = $kecamatan->kota;
        $provinsi = $kota->provinsi;

        $kecamatanId = $kecamatan['id'];
        $kotaId = $kota['id'];
        $provinsiId = $provinsi['id'];

        return self::__generateId($provinsiId, $kotaId, $kecamatanId, $tanggalLahir);
    }

    public static function __generateId($provinsiId, $kotaId, $kecamatanId, $tanggalLahir)
    {
        $birthDate = date_parse($tanggalLahir);
        $formatTanpaNomorUrut = '%02d%02d%02d%02d%02d%02d';
        $idStartsWith = sprintf($formatTanpaNomorUrut, $provinsiId, $kotaId, $kecamatanId, $birthDate['day'], $birthDate['month'], substr($birthDate['year'], -2));

        $lastPendudukUrut = Penduduk::select('id')->where('id', 'LIKE', "$idStartsWith%")->orderBy('id', 'desc')->first();
        if ($lastPendudukUrut == null) {
            $nextNomorUrut = 0;
        } else {
            $nextNomorUrut = intval(substr($lastPendudukUrut['id'], -4)) + 1;
        }
        return $idStartsWith . sprintf('%04d', $nextNomorUrut);
    }

    public function pengguna()
    {
        return $this->morphOne('MorphPengguna', 'userable');
    }
}
