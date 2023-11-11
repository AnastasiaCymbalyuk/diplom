<?php

namespace App\Http\Controllers\Place;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $hall = Place::all();
        return $hall;
    }
}
