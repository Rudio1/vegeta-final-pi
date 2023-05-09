<?php

namespace App\Http\Requests;


class LoginRequest extends validationRequest
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
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Informe um e-mail',
            'email.email' => 'Email Invalido',
            'email.exists' => 'E-mail ou senha incorreto',
            'password.min' => 'Senha muito fraca',
            'password.required' => 'Informe sua senha',
            'password.password' => 'E-mail ou senha incorreto',
        ];
    }
}
