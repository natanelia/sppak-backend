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
}
