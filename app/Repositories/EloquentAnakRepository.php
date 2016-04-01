<?php

namespace App\Repositories;

use App\Anak;

class EloquentAnakRepository implements Repository
{
    public function all()
    {
        return Anak::all();
    }

    public function find($id)
    {
        return Anak::find($id);
    }

    public function create($input)
    {
        return Anak::create($input);
    }
    
}