<?php

namespace App\Http\Controllers\Session;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke()
    {
        $data = request()->validate([
            'hall_id' => 'integer',
            'time' => 'string',
            'movie_id' => 'integer',
        ]);
        Session::create($data);
    }
}
