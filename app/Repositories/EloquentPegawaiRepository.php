<?php

namespace App\Repositories;

use App\Pegawai;

class EloquentPegawaiRepository implements Repository
{
    public function all()
    {
        return Pegawai::all();
    }

    public function find($id)
    {
        return Pegawai::find($id);
    }

    public function create($input)
    {
        return Pegawai::create($input);
    }

}
