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
            'name' => ['string'],
            'price' => ['float'],            
            'description' => ['string'],
            'product_image' => ['image']
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'Informe um nome valido',
            'price.float' => 'O preço precisa ser um número',
            'description.string' => 'Informe uma descrição valida',
            'product_image.image' => 'O arquivo de imagem está no formato incorreto'
        ];
        
    }
}
