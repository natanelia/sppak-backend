<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $table = 'kelurahan';
    protected $connection = 'db_ppl_core';

    protected $morphClass = 'MorphKelurahan';

    public function pengguna()
    {
        return $this->morphOne('MorphKelurahan', 'userable');
    }

    public function kecamatan()
    {
        return $this->hasOne(Kecamatan::class, 'id', 'id_kecamatan');
    }

    public function pengurus()
    {
        return $this->hasOne(Penduduk::class, 'id', 'id_pengurus');
    }

    public function insertAllRelated()
    {
        $this->pengguna;
        $this->kecamatan;
        $this->pengurus;
    }
}
