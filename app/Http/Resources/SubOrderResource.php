<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubOrderResource extends JsonResource
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
            'id'                    =>  $this->id,
            'delivery_order_code'   =>  $this->delivery_order_code,
            'shipping_fee'          =>  $this->shipping_fee,
            'items_count'           =>  $this->items_count,
            'discount'              =>  $this->discount,
            'tax'                   =>  $this->tax,
            'subtotal'              =>  $this->subtotal,
            'total'                 =>  $this->total,
            'grandtotal'            =>  $this->grandtotal,
            'shipping_fee_format'   =>  easy_format_price($this->shipping_fee),
            'discount_format'       =>  easy_format_price($this->discount),
            'tax_format'            =>  easy_format_price($this->tax),
            'subtotal_format'       =>  easy_format_price($this->subtotal),
            'total_format'          =>  easy_format_price($this->total),
            'grandtotal_format'     =>  easy_format_price($this->grandtotal),
            'note'                  =>  $this->note,
            'status'                =>  $this->status,
            // relations
            'shop'                  =>  new ShopResource($this->shop),
            'items'                 =>  OrderDetailResource::collection($this->items),
        ];
    }
}
