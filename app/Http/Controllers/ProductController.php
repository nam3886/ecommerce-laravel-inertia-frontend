<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ShowProductResource;
use App\Models\AttributeValue;
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

            return Product::with('discount', 'gallery', 'brand', 'categories')
                ->active()->inStock()->withCount('variants')
                ->whereBrandId($product->brand_id)
                ->orWhereHas('tags', fn ($query) => $query->whereIn('tags.id', $tags))
                ->orWhereHas('categories', fn ($query) => $query->whereIn('categories.id', $categories))
                ->inRandomOrder()
                ->take(config('settings.get_related_products'))
                ->get();
        });

        $ownProduct = cache()->rememberForever("own_product{$product->shop_id}", function () use ($product) {
            return Product::with('discount', 'gallery', 'brand')
                ->active()->inStock()
                ->whereShopId($product->shop_id)
                ->inRandomOrder()
                ->take(config('settings.get_own_products'))
                ->get();
        });

        return Inertia::render('Product')
            ->with('product', new ShowProductResource($product))
            ->with('related', ProductResource::collection($related->except($product->id)))
            ->with('ownProducts', ProductResource::collection($ownProduct->except($product->id)));
    }

    /**
     * @param int $product
     * @return \Illuminate\Http\Response
     */
    public function showAttributes(int $productId)
    {
        $attributes = $this->getAttributesByProductId($productId);

        return $this->responseJson(error: false, data: $attributes);
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
