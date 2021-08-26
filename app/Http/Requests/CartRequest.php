<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
        $idRules = $this->isMethod('post') ? 'required' : 'nullable';
        $rowIdRules = $this->isMethod('post') ? 'nullable' : 'required';

        return [
            'qty'   =>  'required|min:1',
            'id'    =>  $idRules . '|exists:App\Models\Product,id',
            'sku'   =>  'nullable|exists:App\Models\Variant,sku',
            'rowId' =>  $rowIdRules . '|string',
        ];
    }
}
