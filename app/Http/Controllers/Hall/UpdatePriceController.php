<?php

namespace App\Http\Controllers\Hall;

use App\Http\Controllers\Hall\BaseController;
use App\Http\Requests\Hall\UpdatePriceRequest;
use Illuminate\Http\Request;

class UpdatePriceController extends BaseController
{
    public function __invoke(UpdatePriceRequest $request, $id)
    {
        $data = $request->validated();
        $this->service->updatePrice($data, $id);
    }
}
