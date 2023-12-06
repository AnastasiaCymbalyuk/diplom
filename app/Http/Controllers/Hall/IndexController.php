<?php

namespace App\Http\Controllers\Hall;

use App\Http\Controllers\Hall\BaseController;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke()
    {
        return $this->service->index();
    }
}
