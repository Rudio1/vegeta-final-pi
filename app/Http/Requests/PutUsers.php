<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class PutUsers extends validationRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $userId = $this->route('id');

        return [
            'nome' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email',Rule::unique('users')->ignore($userId),
            'senha' => 'string|min:8',
        ];
    }

    public function messages()
    {
        return [
            'nome.max' => 'Informe um nome valido',
            'email.unique' => 'Este e-mail já esta cadastrado',
            'senha.min' => 'A senha precisa ter no minimo 8 digitos',
        ];
        
    }
}
