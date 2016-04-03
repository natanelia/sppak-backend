<?php

namespace App\Repositories;

use App\Kelahiran;

class EloquentKelahiranRepository implements Repository
{
    public function all()
    {
        return Kelahiran::all();
    }

    public function find($id)
    {
        return Kelahiran::find($id);
    }

    public function create($input)
    {
        return Kelahiran::create($input);
    }
    
}