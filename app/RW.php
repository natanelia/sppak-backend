<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RW extends Model
{
    protected $table = 'rw';
    protected $connection = 'db_ppl_core';

    public function kelurahan()
    {
        return $this->hasOne(Kelurahan::class, 'id', 'id_kelurahan');
    }

    public function pengurus()
    {
        return $this->hasOne(Penduduk::class, 'id', 'id_pengurus');
    }
}
