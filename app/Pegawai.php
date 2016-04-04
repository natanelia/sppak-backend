<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
  protected $table = 'pegawai';
  protected $connection = 'db_ppl_core';

  protected $morphClass = 'MorphPegawai';

  protected $primaryKey = 'nip';
  public function pengguna()
  {
      return $this->morphOne('MorphPegawai', 'userable');
  }
}
