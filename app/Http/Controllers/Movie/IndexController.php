<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Movie\BaseController;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke()
    {
        return $this->service->index();
    }
}
