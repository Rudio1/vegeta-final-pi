<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class validationRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $erros = [];
        foreach ($validator->errors()->messages() as $mensagens) {
            $erros = array_merge($erros, $mensagens);
        }

        throw new HttpResponseException(response()->json([
            'message' => [
                'erros' => $erros,
            ],
            'success' => false,
        ], 400));
    }
}
