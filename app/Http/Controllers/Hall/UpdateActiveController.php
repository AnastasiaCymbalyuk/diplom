<?php

namespace App\Http\Controllers\Hall;

use App\Http\Controllers\Hall\BaseController;
use Illuminate\Http\Request;

class UpdateActiveController extends BaseController
{
    public function __invoke($value, $valueNew)
    {
        $this->service->updateActive($value, $valueNew);
    }
}
