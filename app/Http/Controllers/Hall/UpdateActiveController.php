<?php

namespace App\Http\Controllers\Hall;

use App\Http\Controllers\Controller;
use App\Models\Hall;
use Illuminate\Http\Request;

class UpdateActiveController extends Controller
{
    public function __invoke($value, $valueNew)
    {
        $hall = Hall::where("isActive", $value)->update(["isActive" => $valueNew]);
    }
}
