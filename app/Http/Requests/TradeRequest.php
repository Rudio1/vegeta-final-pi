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
            'new_user' => 'required|string|exists:users,email'
        ];
    }

    public function messages(){
        return [
            'new_user.required' => 'Informe o novo usuario do produto',
            'new_user.exists' => 'Usuario nao existe',
        ];
    }


}
