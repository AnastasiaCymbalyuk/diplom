<?php

namespace App\Http\Controllers\Hall;

use App\Http\Controllers\Controller;
use App\Models\Hall;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $hall = Hall::all();
        return $hall;
    }
}
