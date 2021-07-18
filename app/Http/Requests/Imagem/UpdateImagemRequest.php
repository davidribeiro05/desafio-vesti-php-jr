<?php

namespace App\Http\Requests\Imagem;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImagemRequest extends FormRequest
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
            'imagem' => 'required|mimes:jpg,png,jpeg'
        ];
    }

    public function messages()
    {
        return [
            'imagem.required' => 'A imagem é obrigatória',
            'imagem.mimes' => 'Este não é um formato de imagem válido. Os formatos válidos são jpg, png, jpeg.'
        ];
    }
}
