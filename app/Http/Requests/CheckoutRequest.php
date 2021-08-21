<?php

namespace App\Http\Requests;

use App\Models\PaymentMethod;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'delivery_method_id'    =>  'required|integer|exists:App\Models\DeliveryMethod,id',
            'payment_method_id'     =>  'required|integer|exists:App\Models\PaymentMethod,id',
            'stripe_token'          =>  'required_if:payment_method_id,1|string|min:3|max:255',
        ];
    }
}
