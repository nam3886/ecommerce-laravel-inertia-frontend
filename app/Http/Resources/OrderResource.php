<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'order_code'            =>  $this->order_code,
            'items_count'           =>  $this->items_count,
            'discount'              =>  $this->discount,
            'tax'                   =>  $this->tax,
            'subtotal'              =>  $this->subtotal,
            'total'                 =>  $this->total,
            'grandtotal'            =>  $this->grandtotal,
            'discount_format'       =>  easy_format_price($this->discount),
            'tax_format'            =>  easy_format_price($this->tax),
            'subtotal_format'       =>  easy_format_price($this->subtotal),
            'total_format'          =>  easy_format_price($this->total),
            'grandtotal_format'     =>  easy_format_price($this->grandtotal),
            'is_paid'               =>  $this->is_paid,
            'transaction_number'    =>  $this->transaction_number,
            'bank_tran_number'      =>  $this->bank_tran_number,
            'bank_code'             =>  $this->bank_code,
            'create_order_success'  =>  $this->create_order_success,
            'created_at'            =>  $this->created_at->toDateTimeString(),
            // relations
            'payment_method'        =>  new PaymentMethodResource($this->paymentMethod),
            'billing_address'       =>  $this->billingAddress,
            'sub_orders'            =>  SubOrderResource::collection($this->subOrders),
        ];
    }
}
