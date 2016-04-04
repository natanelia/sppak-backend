<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table = 'provinsi';
    protected $connection = 'db_ppl_core';

    protected $hidden = ['created_at', 'updated_at'];
    
    public function pengurus()
    {
        return $this->hasOne(Penduduk::class, 'id', 'id_pengurus');
    }

    public function kota()
    {
        return $this->hasMany(Kota::class, 'id_provinsi');
    }
}
