<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RT extends Model
{
    protected $table = 'rt';
    protected $connection = 'db_ppl_core';

    public function RW()
    {
        return $this->hasOne(RW::class, 'id', 'id_rw');
    }

    public function pengurus()
    {
        return $this->hasOne(Penduduk::class, 'id', 'id_pengurus');
    }
}
