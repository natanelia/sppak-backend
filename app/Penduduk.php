<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    protected $table = 'penduduk';
    protected $connection = 'db_ppl_core';
    public $incrementing = false;
    
    protected $morphClass = 'MorphPenduduk';

    protected $fillable = [
        'id',
        'nama',
        'tanggal_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'id_keluarga',
        'id_ayah',
        'id_ibu',
        'hubungan_keluarga',
        'golongan_darah',
        'agama',
        'wni',
        'status_perkawinan',
        'pekerjaan',
        'pendidikan',
        'id_izin_tetap',
        'id_passport',
        'status',
    ];

    public function pengguna()
    {
        return $this->morphOne('MorphPengguna', 'userable');
    }
}
