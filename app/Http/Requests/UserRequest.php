<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' =>       'required',
            'password' =>    'required',
            'tipo' =>        'required',
            'file_photo' =>         'sometimes|image|max:4096'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório',
            'email.required' => 'O email é obrigatório',
            'password.required' => 'A password é obrigatória',
            'tipo.required' => 'O tipo é obrigatório',
            'file_photo.image' => 'O ficheiro tem de ser uma imagem',

        ];
    }
}
