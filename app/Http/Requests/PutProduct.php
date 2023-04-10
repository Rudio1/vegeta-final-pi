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
            'name' => 'string|max:255',
            'price' => 'string|min:15|max:255',            
            'description' => 'string|min:15',
            'product_image' => 'max:10240|mimes:jpg,png,svg,jpeg'
        ];
    }

    public function messages()
    {
        return [
        ];
        
    }
}
