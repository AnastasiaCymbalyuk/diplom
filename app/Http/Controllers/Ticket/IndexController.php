<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $ticket = Ticket::all();
        return $ticket;
    }
}
