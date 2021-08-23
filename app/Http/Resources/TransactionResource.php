<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'is_paid'               =>  $this->is_paid,
            'transaction_number'    =>  $this->transaction_number,
            'bank_tran_number'      =>  $this->bank_tran_number,
            'bank_code'             =>  $this->bank_code,
        ];
    }
}
