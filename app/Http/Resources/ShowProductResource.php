<?php

namespace App\Http\Resources;

use App\Helpers\Currency;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                            =>  $this->id,
            'sku'                           =>  $this->sku,
            'name'                          =>  $this->name,
            'price_format'                  =>  easy_format_price($this->price),
            'price_after_discount_format'   =>  easy_format_price($this->price_after_discount),
            'quantity'                      =>  $this->quantity,
            'sub_description'               =>  $this->sub_description,
            'description'                   =>  $this->description,
            'is_featured'                   =>  $this->is_featured,
            'flag'                          =>  $this->flag,
            'view'                          =>  $this->view,
            // relations
            'gallery'                       =>  new GalleryResource($this->gallery),
            'discount'                      =>  new DiscountResource($this->discount),
            'seo'                           =>  new SeoResource($this->seo),
            'brand'                         =>  new BrandResource($this->brand),
            'shop'                          =>  new ShopResource($this->shop),
            // 'categories'                    =>  CategoryResource::collection($this->categories),
            // 'tags'                          =>  CategoryResource::collection($this->tags),
            'has_variants'                  =>  $this->hasVariants(),
            // 'variants'                      =>  VariantResource::collection($this->variants),
        ];
    }
}
