<?php

namespace App\Http\Controllers\Session;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke($id)
    {
        $session = Session::where('hall_id', $id)->delete();
    }
}
