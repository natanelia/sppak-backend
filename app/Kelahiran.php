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
}
