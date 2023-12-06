<?php

namespace App\Services\Session;
use App\Models\Session;

class Service
{
    public function index()
    {
        $session = Session::all();
        return $session;
    }

    public function store($data)
    {
        Session::create($data);
    }

    public function update($id)
    {
        Session::where('hall_id', $id)->delete();
    }
}