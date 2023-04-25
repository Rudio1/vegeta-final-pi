<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'password' => 'required|string|exists:users,password',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Informe um e-mail',
            'email.email' => 'Email Invalido',
            'email.exists' => 'E-mail não cadastrado',
            'password.min' => 'Senha muito fraca',
            'password.required' => 'Informe sua senha',
            'password.password' => 'Senha incorreta',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
