<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\modelProduct;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'price' => ['required', 'float'],
            'model_id' => ['required', 'integer', Rule::in(array_column(modelProduct::all()->toArray(), 'id'))],
            'description' => ['required', 'string'],
        ];
    }

    public function messages()
    {

    }
}
