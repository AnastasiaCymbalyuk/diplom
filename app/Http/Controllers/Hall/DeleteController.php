<?php

namespace App\Http\Controllers\Hall;

use App\Http\Controllers\Hall\BaseController;
use Illuminate\Http\Request;

class DeleteController extends BaseController
{
    public function __invoke($id)
    {
        $this->service->delete($id);
    }
}
