<?php

namespace App\Repositories;

use App\Pengguna;

class EloquentPenggunaRepository implements Repository
{
    public function all()
    {
        return Pengguna::all();
    }

    public function find($id)
    {
        return Pengguna::find($id);
    }

    public function create($input)
    {
        return Pengguna::create($input);
    }
    
}