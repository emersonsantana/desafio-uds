<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrder extends FormRequest
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
          'cpf' => 'required|cpf|exists:consumers,cpf|max:11',
          'product_code' => 'required|string|exists:products,code',
          'qtd' => 'required|numeric',
          'discount_percentage' => 'required|numeric|min:0'
        ];
    }
}
