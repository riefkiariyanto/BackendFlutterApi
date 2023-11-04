<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:250',
            'category' => 'required|string|min:3|max:250',
            'price' => 'required|int|min:3|max:250',
            'qty' => 'required|int|min:3|max:250',
            'description' => 'required|string|min:3|max:6000',
            'image' => 'required|image|max:1024|mimes:jpg,jpeg,png',
        ];
    }
}