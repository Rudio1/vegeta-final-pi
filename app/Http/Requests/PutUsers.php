<?php

namespace App\Http\Requests;

use App\Models\User;
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
            'email' => [
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($userId),
                function ($getvalue) use ($userId) {
                    $user = User::find($userId);
                    if ($user && $user->email !== $getvalue) {
                        return 'Não é possível atualizar o email';
                    }
                }
            ],
            'senha' => 'string|min:8',
        ];
    }

    public function messages()
    {
        return [
            'nome.max' => 'Informe um nome valido',
            'senha.min' => 'A senha precisa ter no minimo 8 digitos',
        ];
        
    }
}
