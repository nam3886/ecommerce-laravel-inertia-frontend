<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $name = str_replace('()', '', $this->name . "({$this->pivot->variant?->name})");

        return [
            'id'            =>  $this->id,
            'sku'           =>  $this->pivot->sku,
            'quantity'      =>  $this->pivot->quantity,
            'price_format'  =>  easy_format_price($this->pivot->price),
            'name'          =>  $name,
            'slug'          =>  $this->slug,
        ];
    }
}
