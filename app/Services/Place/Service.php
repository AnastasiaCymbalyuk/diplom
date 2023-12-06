<?php

namespace App\Services\Place;
use App\Models\Place;

class Service
{
    public function index()
    {
        $place = Place::all();
        return $place;
    }

    public function store($data)
    {
        Place::create($data);
    }

    public function update($id)
    {
        Place::where('hall_id', $id)->delete();
    }
}