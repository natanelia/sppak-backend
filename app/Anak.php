<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    protected $table = 'anak';
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $dates = ['waktuLahir'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'jenisKelamin',
        'kotaLahirId',
        'waktuLahir',
        'jenisLahir',
        'anakKe',
        'penolongKelahiran',
        'berat',
        'panjang'
    ];

    public function kelahiran() {
        return $this->hasOne(\App\Kelahiran::class, 'anakId');
    }
}
