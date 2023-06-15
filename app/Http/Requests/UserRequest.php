<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Requests\validationRequest;

class UserRequest extends validationRequest
{

    function __construct()
    {
        
    }
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
            'email' => ['required', 'unique:users'],
            'password' => 'required',
            'password_confirmed' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatorio',
            'email.unique' => 'Este e-mail já esta cadastrado',
            'password.required' => 'A senha é obrigatoria',
            'password_confirmed.required' => 'Você deve confirmar sua senha',
            'password_confirmed.same' => 'As senhas devem ser iguais',
        ];
        
    }


    
}
