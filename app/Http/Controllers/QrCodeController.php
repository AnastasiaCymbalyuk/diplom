<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function show($id)
    {
        return QrCode::size(200)
        ->backgroundColor(0, 0, 0)
        ->color(255, 140, 0)
        ->margin(3)
        ->format('svg')
        ->generate($id);
    }

    
}
