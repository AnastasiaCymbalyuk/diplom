<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Movie\BaseController;
use Illuminate\Http\Request;

class DeleteController extends BaseController
{
    public function __invoke($id)
    {
        $this->service->delete($id);
    }
}
