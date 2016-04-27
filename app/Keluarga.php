<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    protected $table = 'keluarga';
    protected $connection = 'db_ppl_core';

    public function rt()
    {
        return $this->hasOne(RT::class, 'id', 'id_rt');
    }
}
