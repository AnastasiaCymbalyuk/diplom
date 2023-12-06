<?php

namespace App\Http\Controllers\Hall;

use App\Http\Controllers\Hall\BaseController;
use App\Http\Requests\Hall\StoreRequest;
use Illuminate\Http\Request;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $this->service->store($data);
    }
}
