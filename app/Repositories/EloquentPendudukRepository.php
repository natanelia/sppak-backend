<?php

namespace App\Repositories;

use App\Penduduk;

class EloquentPendudukRepository implements Repository
{
    public function all()
    {
        return Penduduk::all();
    }

    public function find($id)
    {
        return Penduduk::find($id);
    }

    public function create($input)
    {
        return Penduduk::create($input);
    }

}