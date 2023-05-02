<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class SelledProduct extends FormRequest
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
            'email_user' => 'required|email', Rule::exists('users', 'email'),
            'product_name' => 'required|string', Rule::exists('products', 'name'),
            'number_serie' => 'int|required',
        ];
    }

    public function messages()
    {
        return  [
            'email_user.email' => 'Informe um e-mail valido',
            'email_user.required' => 'Informe o e-mail',
            'product_name.required' => 'Informe o nome do produto',
            'number_serie.required' => 'Informe o numero de serie',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
