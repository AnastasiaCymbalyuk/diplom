<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Services\Ticket\Service;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}