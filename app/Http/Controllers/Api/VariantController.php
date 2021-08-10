<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Resources\VariantResource;
use App\Models\Variant;
use Illuminate\Http\Request;

class VariantController extends BaseController
{
    /**
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Variant $variant)
    {
        return $this->responseJson(data: new VariantResource($variant), error: false);
    }
}
