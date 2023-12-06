<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Ticket\BaseController;
use App\Http\Requests\Ticket\StoreRequest;
use Illuminate\Http\Request;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $this->service->store($data);
    }
}
