<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Movie\BaseController;
use App\Http\Requests\Movie\StoreRequest;
use Illuminate\Http\Request;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $this->service->store($data);
    }
}
