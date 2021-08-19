<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAddressRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

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
            // 'delivery_method_id'        =>   'required|integer|exists:App\Models\DeliveryMethod,id',
            // 'payment_method_id'         =>   'required|integer|exists:App\Models\DeliveryMethod,id',
            'name'                      =>  'required|string|min:3|max:50',
            'phone'                     =>  'required|regex:/(0[1-9])[0-9]{8}$/|unique:App\Models\User,phone,' . auth()->id(),
            'address'                   =>  'required|string',
            'ghn_address.address'       =>  'required|string|min:3|max:255',
            'ghn_address.district_id'   =>  'required|integer',
            'ghn_address.ward_code'     =>  'required|string',
        ];
    }
}
