<?php

namespace App\Http\Controllers\Place;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke()
    {
        $data = request()->validate([
            'hall_id' => 'integer',
            'type' => 'string',
            'row' => 'integer|max:15',
            'place' => 'integer|max:15',
        ]);
        Place::create($data);
    }
}
