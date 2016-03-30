<?php

namespace App\Repositories;


interface AnakRepository
{
    public function all();

    public function find($id);

    public function create($input);

    public function save($input);
}