<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke()
    {
        $data = request()->validate([
            'place_id' => 'integer',
            'session_id' => 'integer',
            'type' => 'string|min:2|max:25',
            'date' => 'string',
            'price' => 'integer',
            'row' => 'integer|max:15',
            'place' => 'integer|max:15',
            'qr' => 'string',
        ]);
        Ticket::create($data);
    }
}
