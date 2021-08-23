<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
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
            'ghn_shop_id'   => $this->ghn_shop_id,
            'slug'          => $this->slug,
            'phone'         => $this->phone,
            'name'          => $this->name,
            'address'       => $this->address,
            'ghn_address'   => $this->ghn_address,
            'avatar'        => $this->avatar,
        ];
    }
}
