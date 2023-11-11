<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $movie = Movie::all();
        return $movie;
    }
}
