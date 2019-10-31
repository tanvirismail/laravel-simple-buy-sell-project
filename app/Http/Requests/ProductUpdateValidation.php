<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateValidation extends FormRequest
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
            "name"=>'required|min:3',
            "description"=>'required|string',
            "quantity"=>'required|numeric|not_in:0',
            "status"=>'required|string|in:available,unavailable',
            "image"=>'sometimes|required|file|mimes:jpeg,bmp,png,jpg',
            "category"=>'required|array'
        ];
    }

}
