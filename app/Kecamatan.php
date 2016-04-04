<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';
    protected $connection = 'db_ppl_core';

    protected $hidden = ['created_at', 'updated_at'];

    public function kelurahan()
    {
        return $this->hasMany(Kelurahan::class, 'id_kecamatan');
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'id_kota');
    }

    public function pengurus()
    {
        return $this->hasOne(Penduduk::class, 'id', 'id_pengurus');
    }
}
