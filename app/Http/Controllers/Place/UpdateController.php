<?php

namespace App\Http\Controllers\Place;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke($id)
    {
        $hall = Place::where('hall_id', $id)->delete();
    }
}
