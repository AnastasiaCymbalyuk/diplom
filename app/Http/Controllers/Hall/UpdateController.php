<?php

namespace App\Http\Controllers\Hall;

use App\Http\Controllers\Hall\BaseController;
use App\Http\Requests\Hall\UpdateRequest;
use Illuminate\Http\Request;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, $id)
    {
        $data = $request->validated();
        $this->service->update($data, $id);
    }
}
