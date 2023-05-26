<?php

namespace App\Http\Requests;


use App\Http\Requests\validationRequest;

class TradeRequest extends validationRequest
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
            'new_user' => 'required|string|exists:users,email',
            'product_name' => 'required|string|exists:products,name',
        ];
    }

    public function messages(){
        return [
            'new_user.required' => 'Informe o novo usuario do produto',
            'new_user.exists' => 'Usuario nao existe',
            'product_name.required' => 'Informe o nome do produto que deseja transferir',
            'product_name.exists'  => 'Produto não existe'
        ];
    }


}
