<?php

namespace App\Services\Movie;
use App\Models\Movie;

class Service
{
    public function delete($id)
    {
        $movie = Movie::find($id);
        $movie->delete();
    }

    public function index()
    {
        $movie = Movie::all();
        return $movie;
    }

    public function store($data)
    {
        Movie::create($data);
    }
}