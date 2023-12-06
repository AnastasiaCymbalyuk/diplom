<?php

namespace App\Http\Controllers\Place;

use App\Http\Controllers\Controller;
use App\Services\Place\Service;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}