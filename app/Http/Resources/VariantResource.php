<?php

namespace App\Http\Resources;

use App\Helpers\Currency;
use Illuminate\Http\Resources\Json\JsonResource;

class VariantResource extends JsonResource
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
            'id'            =>  $this->id,
            'sku'           =>  $this->sku,
            'combination'   =>  $this->combination,
            'name'          =>  $this->name,
            'price_format'  =>  easy_format_price($this->price),
            'price_after_discount_format'   =>  easy_format_price($this->price_after_discount),
            'quantity'      =>  $this->quantity,
            'weight'        =>  $this->weight,
            'length'        =>  $this->length,
            'width'         =>  $this->width,
            'height'        =>  $this->height,
            // relations
            'discount'          =>  new DiscountResource($this->discount),
        ];
    }
}
