<?php

namespace App\Http\Controllers\Place;

use App\Http\Controllers\Place\BaseController;
use App\Http\Requests\Place\StoreRequest;
use Illuminate\Http\Request;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $this->service->store($data);
    }
}
