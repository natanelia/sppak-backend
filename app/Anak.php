<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    protected $table = 'anak';
    protected $connection = 'mysql';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'jenisKelamin',
        'kotaLahirId',
        'tanggalLahir',
        'jenisLahir',
        'anakKe',
        'penolongKelahiran',
        'berat',
        'panjang'
    ];
}
