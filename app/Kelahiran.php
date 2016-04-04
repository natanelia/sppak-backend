<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelahiran extends Model
{
    protected $table = 'kelahiran';
    protected $connection = 'mysql';

    protected $date = ['waktuCetakTerakhir'];
    protected $fillable = [
        'anakId',
        'kelurahanId',
        'instansiKesehatanId',
        'kartuKeluargaId',
        'aktaNikahId',
        'ibuId',
        'ayahId',
        'saksiSatuId',
        'saksiDuaId',
        'pemohonId',
        'status',
        'verifikasiSaksi1',
        'verifikasiSaksi2',
        'verifikasiInstansiKesehatan',
        'verifikasiAdmin',
        'waktuCetakTerakhir',
    ];

    public function anak() {
        return $this->belongsTo(\App\Anak::class, 'anakId');
    }

    public function kelurahan() {
        return $this->hasOne(\App\Kelurahan::class, 'id', 'kelurahanId');
    }

    public function instansiKesehatan() {
        return $this->hasOne(\App\InstansiKesehatan::class, 'id', 'instansiKesehatanId');
    }

    public function keluarga() {
        return $this->hasOne(\App\Keluarga::class, 'id', 'kartuKeluargaId');
    }

    public function ibu() {
        return $this->hasOne(\App\Penduduk::class, 'id', 'ibuId');
    }

    public function ayah() {
        return $this->hasOne(\App\Penduduk::class, 'id', 'ayahId');
    }

    public function pemohon() {
        return $this->hasOne(\App\Penduduk::class, 'id', 'pemohonId');
    }

    public function insertAllRelated() {
        $this->anak;
        $this->kelurahan;
        $this->instansiKesehatan;
        $this->keluarga;
        $this->ibu;
        $this->ayah;
        $this->pemohon;
    }
}
