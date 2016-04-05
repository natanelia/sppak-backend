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
        return $this->belongsTo(Anak::class, 'anakId');
    }

    public function kelurahan() {
        return $this->belongsTo(Kelurahan::class, 'kelurahanId');
    }

    public function instansiKesehatan() {
        return $this->belongsTo(InstansiKesehatan::class, 'instansiKesehatanId');
    }

    public function keluarga() {
        return $this->belongsTo(Keluarga::class, 'kartuKeluargaId');
    }

    public function ibu() {
        return $this->belongsTo(Penduduk::class, 'ibuId');
    }

    public function ayah() {
        return $this->belongsTo(Penduduk::class, 'ayahId');
    }

    public function pemohon() {
        return $this->belongsTo(Penduduk::class, 'pemohonId');
    }

    public function saksiSatu() {
        return $this->hasOne(Saksi::class, 'id', 'saksiSatuId');
    }

    public function saksiDua() {
        return $this->hasOne(Saksi::class, 'id', 'saksiDuaId');
    }

    public function insertAllRelated() {
        $this->anak;
        $this->kelurahan;
        $this->instansiKesehatan;
        $this->keluarga;
        $this->ibu;
        $this->ayah;
        $this->pemohon;
        $this->saksiSatu;
        $this->saksiDua;
    }
}
