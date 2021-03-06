<?php

namespace App\Http\Resources;

use App\Helpers\Currency;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'slug'                          =>  $this->slug,
            'sku'                           =>  $this->sku,
            'name'                          =>  $this->name,
            'price_format'                  =>  easy_format_price($this->price),
            'price_after_discount_format'   =>  easy_format_price($this->price_after_discount),
            'quantity'                      =>  $this->quantity,
            'sub_description'               =>  $this->sub_description,
            'is_featured'                   =>  $this->is_featured,
            'flag'                          =>  $this->flag,
            'view'                          =>  $this->view,
            // relations
            'gallery'                       =>  new GalleryResource($this->gallery),
            'discount'                      =>  new DiscountResource($this->discount),
            // 'categories'                    =>  CategoryResource::collection($this->categories),
            'brand'                         =>  new BrandResource($this->brand),
            'has_variants'                  =>  boolval($this->variants_count),
        ];
    }
}
