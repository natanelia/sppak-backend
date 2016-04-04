<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $table = 'kota';
    protected $connection = 'db_ppl_core';

    protected $hidden = ['created_at', 'updated_at'];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'id_provinsi');
    }

    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class, 'id_kota');
    }

    public function pengurus()
    {
        return $this->hasOne(Penduduk::class, 'id', 'id_pengurus');
    }
}
