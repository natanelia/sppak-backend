<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saksi extends Model
{
    protected $table = 'saksi';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pendudukId', 'email', 'token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'token'
    ];
}
