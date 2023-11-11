<?php

namespace App\Http\Controllers\Hall;

use App\Http\Controllers\Controller;
use App\Models\Hall;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke($id)
    {
        $data = request()->validate([
            'row' => 'integer|max:15',
            'place' => 'integer|max:15',
        ]);
        $hall = Hall::find($id);
        $hall->row = $data['row'];
        $hall->place = $data['place'];
        $hall->save();
    }
}
