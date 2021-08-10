<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ShowProductResource;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends BaseController
{
    /**
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $related = cache()->rememberForever("related{$product->id}", function () use ($product) {
            $categories = $product->categories->pluck('id');

            $tags = $product->tags->pluck('id');

            return Product::with('categories', 'discount', 'gallery', 'brand')->withCount('variants')
                ->whereBrandId($product->brand_id)
                ->orWhereHas('tags', fn ($query) => $query->whereIn('tags.id', $tags))
                ->orWhereHas('categories', fn ($query) => $query->whereIn('categories.id', $categories))
                ->inRandomOrder()
                ->take(4)
                ->get()
                ->except($product->id);
        });

        return Inertia::render('Product')
            ->with('attributes', $this->getAttributesByProductId($product->id))
            ->with('product', new ShowProductResource($product))
            ->with('related', ProductResource::collection($related));
    }

    /**
     * @param int $product
     * @return \Illuminate\Http\Response
     */
    public function showAttributes(int $productId)
    {
        return $this->responseJson(error: false, data: [
            'attributes' => $this->getAttributesByProductId($productId),
        ]);
    }

    /**
     * @param int $productId
     * @return \Illuminate\Support\Collection
     */
    private function getAttributesByProductId(int $productId)
    {
        $attributeValues = AttributeValue::with('attribute')
            ->whereHas('variants', fn ($query) => $query->whereProductId($productId))
            ->get();

        return $attributeValues->groupBy('attribute_id')
            ->map(function ($attributeValue) {

                $attribute = $attributeValue->first()->attribute;

                return [
                    'id' => $attribute->id,
                    'name' => $attribute->name,
                    'code' => $attribute->code,
                    'values' => $attributeValue,
                ];
            })->values();
    }
}
