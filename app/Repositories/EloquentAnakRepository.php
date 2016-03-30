<?php

namespace App\Repositories;

use App\Anak;

class EloquentAnakRepository implements AnakRepository
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

    public function save($input)
    {
        $anak = new Anak($input);
        return $anak->save();
    }
}