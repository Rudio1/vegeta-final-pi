<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'password' => ['required', 'string'],
            'password_confirmed' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'O nome precisa ser uma string',
            'name.required' => 'O nome é obrigatorio',
            'email.unique' => 'Este e-mail já esta cadastrado',
            'password.min' => 'A senha precisa ter no minimo 8 digitos', 
            'password.required' => 'A senha é obrigatoria',
            'password_confirmed.required' => 'Você deve confirmar sua senha',
            'password_confirmed.confirmed' => 'As senhas devem ser iguais',
        ];
        
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

    
}
