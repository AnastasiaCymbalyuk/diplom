<?php

namespace App\Http\Controllers\Session;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $session = Session::all();
        return $session;
    }
}
