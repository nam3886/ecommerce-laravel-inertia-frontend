<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DiscountResource extends JsonResource
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
            // 'price'         =>  $this->price,
            'price_format'  =>  $this->discountFormat(),
            'start'         =>  $this->start,
            'end'           =>  $this->end,
            'unit'          =>  $this->unit,
            'valid'         =>  $this->valid,
        ];
    }
}
