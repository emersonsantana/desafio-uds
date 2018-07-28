<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
          'code' => 'required|string|unique:products,code|max:255',
          'name' => 'required|string|unique:products,name|max:255',
          'price'=> 'required|numeric|min:1'
        ];
    }
}
