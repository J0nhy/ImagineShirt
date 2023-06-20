<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' =>        'required',
            'colorValue' =>  'required',
            'imagem' =>      'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório',
            'colorValue.required' => 'O código da cor é obrigatório',
            'imagem.required' => 'A imagem é obrigatória'

        ];
    }
}
