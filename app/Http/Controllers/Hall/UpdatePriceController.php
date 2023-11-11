<?php

namespace App\Http\Controllers\Hall;

use App\Http\Controllers\Controller;
use App\Models\Hall;
use Illuminate\Http\Request;

class UpdatePriceController extends Controller
{
    public function __invoke($id)
    {
        $data = request()->validate([
            'price' => 'integer',
            'vipPrice' => 'integer',
        ]);
        $hall = Hall::find($id);
        $hall->price = $data['price'];
        $hall->vipPrice = $data['vipPrice'];
        $hall->save();
    }
}
