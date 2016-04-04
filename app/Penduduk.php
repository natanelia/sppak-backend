<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    protected $table = 'penduduk';
    protected $connection = 'db_ppl_core';
    public $incrementing = false;
    
    protected $morphClass = 'MorphPenduduk';

    public function pengguna()
    {
        return $this->morphOne('MorphPengguna', 'userable');
    }
}
