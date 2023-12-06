<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Ticket\BaseController;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke()
    {
        return $this->service->index();
    }
}
