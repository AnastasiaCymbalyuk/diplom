<?php

namespace App\Http\Controllers\Place;

use App\Http\Controllers\Place\BaseController;
use Illuminate\Http\Request;

class UpdateController extends BaseController
{
    public function __invoke($id)
    {
        $this->service->update($id);
    }
}
