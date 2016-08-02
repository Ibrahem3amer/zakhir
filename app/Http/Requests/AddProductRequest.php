<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddProductRequest extends Request
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
            'pr_name' => 'required|max:100',
            'pr_price' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'pr_name.required' => 'Product name is required',
            'pr_name.unique:photos' => 'Product name is already exists',
            'pr_name.max:100' => 'Product name must not exceed 100 characters',
            'pr_price.required'  => 'Price is required',
            'pr_price.numeric'  => 'Price must be a numeric value',
        ];
    }
}
