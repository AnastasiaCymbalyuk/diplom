<?php

namespace App\Http\Controllers\Session;

use App\Http\Controllers\Session\BaseController;
use App\Http\Requests\Session\StoreRequest;
use Illuminate\Http\Request;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $this->service->store($data);
    }
}
