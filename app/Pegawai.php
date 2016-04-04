<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
  protected $table = 'pegawai';
  protected $connection = 'db_ppl_core';

  protected $morphClass = 'MorphPegawai';

  public function pegawai()
  {
      return $this->morphOne('MorphPegawai', 'userable');
  }
}
