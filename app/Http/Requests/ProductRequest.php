<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
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
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'product_image' => ['file'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Informe o nome',
            'price.required' => 'Informe o preço',
            'description.required' => 'Informe a descrição',
            'product_image.file' => 'O arquivo enviado precisa ser uma imagem',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

}
