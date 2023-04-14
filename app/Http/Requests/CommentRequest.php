<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommentRequest extends FormRequest
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
            'comment' => 'required|string|max:255',
            'assessment' => 'required',
            'email_user' => 'required|email', Rule::exists('users', 'email'),
            'product_name' => 'required|string', Rule::exists('products', 'name'),
        ];
    }
    public function messages()
    {
        return [
            'comment.required' => 'Informe o comentario',
            'assessment.required' => 'Informe a avaliação',
            'email_user.required' => 'informe o email',
            'product_name' => 'Informe o nome do produto'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
