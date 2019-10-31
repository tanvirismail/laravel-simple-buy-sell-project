<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuantityCheck extends FormRequest
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
            "quantity"=>'required|lte_db:products,quantity,'. request()->id
        ];
    }

	public function messages()
    {
        return [
            "quantity.lte_db"=>'Quantity Not Available.'
        ];
    }
	
	
}
