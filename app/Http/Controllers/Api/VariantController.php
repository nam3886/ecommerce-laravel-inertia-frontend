<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Resources\VariantResource;
use App\Models\Variant;
use Illuminate\Http\Request;

class VariantController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @param int $productId
     * @return \Illuminate\Http\Response
     */
    public function index(int $productId)
    {
        $variants = Variant::select('combination', 'quantity')
            ->whereProductId($productId)
            ->where('quantity', '>', 0)
            ->get();

        return $this->responseJson(data: $variants->pluck('combination'), error: false);
    }

    /**
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Variant $variant)
    {
        return $this->responseJson(data: new VariantResource($variant), error: false);
    }
}
