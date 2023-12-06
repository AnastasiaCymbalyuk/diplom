<?php

namespace App\Http\Controllers\Session;

use App\Http\Controllers\Controller;
use App\Services\Session\Service;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}