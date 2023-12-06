<?php

namespace App\Http\Controllers\Session;

use App\Http\Controllers\Session\BaseController;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke()
    {
        return $this->service->index();
    }
}
