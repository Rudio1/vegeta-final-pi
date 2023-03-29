<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PutUsers extends FormRequest
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
            'email' => 'required|string|email|max:255|unique:users,email',Rule::unique('users')->ignore($userId),
            'senha' => 'string|min:8',
        ];
    }

    public function messages()
    {
        return [
            'nome.string' => 'O nome precisa ser uma string',
            'email.unique' => 'Este e-mail já esta cadastrado',
            'email.required' => 'Informe um e-mail',
            'senha.min' => 'A senha precisa ter no minimo 8 digitos',
        ];
        
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
