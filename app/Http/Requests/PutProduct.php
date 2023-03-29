<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PutProduct extends FormRequest
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


        //Falta definir os tipos de validação a serem feitas.

        return [
            'name' => '',
            'price' => '',            
            'description' => '',
            'product_image' => ''
        ];
    }

    public function messages()
    {
        //Aqui entrará a validação de retorno para o front-end
    }
}
