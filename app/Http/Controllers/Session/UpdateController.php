<?php

namespace App\Http\Controllers\Session;

use App\Http\Controllers\Session\BaseController;
use Illuminate\Http\Request;

class UpdateController extends BaseController
{
    public function __invoke($id)
    {
        $this->service->update($id);
    }
}
