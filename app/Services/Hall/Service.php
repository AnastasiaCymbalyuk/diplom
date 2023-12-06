<?php

namespace App\Services\Hall;
use App\Models\Hall;

class Service
{
    public function delete($id)
    {
        $hall = Hall::find($id);
        $hall->delete();
    }

    public function index()
    {
        $hall = Hall::all();
        return $hall;
    }

    public function store($data)
    {
        Hall::create($data);
    }

    public function updateActive($value, $valueNew)
    {
        Hall::where("isActive", $value)->update(["isActive" => $valueNew]);
    }

    public function update($data, $id)
    {
        $hall = Hall::find($id);
        $hall->row = $data['row'];
        $hall->place = $data['place'];
        $hall->save();
    }

    public function updatePrice($data, $id)
    {
        $hall = Hall::find($id);
        $hall->price = $data['price'];
        $hall->vipPrice = $data['vipPrice'];
        $hall->save();
    }
}