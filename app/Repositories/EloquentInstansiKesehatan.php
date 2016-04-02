<?php

namespace App\Repositories;

use App\Pegawai;

class EloquentInstansiKesehatanRepository implements Repository
{
    public function all()
    {
        return InstansiKesehatan::all();
    }

    public function find($id)
    {
        return InstansiKesehatan::find($id);
    }

    public function create($input)
    {
        return InstansiKesehatan::create($input);
    }

}
