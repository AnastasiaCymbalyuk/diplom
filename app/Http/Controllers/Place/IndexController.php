<?php

namespace App\Http\Controllers\Place;

use App\Http\Controllers\Place\BaseController;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke()
    {
        return $this->service->index();
    }
}
