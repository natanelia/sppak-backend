<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstansiKesehatan extends Model
{
  protected $table = 'instansiKesehatan';
  protected $connection = 'mysql';

  protected $morphClass = 'MorphInstansiKesehatan';

  public function pengguna()
  {
      return $this->morphOne('MorphInstansiKesehatan', 'userable');
  }

  public function kota()
  {
      return $this->belongsTo(Kota::class, 'kotaId');
  }
}
