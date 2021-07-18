<?php

namespace App\Http\Requests\Produto;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProdutoRequest extends FormRequest
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
            'preco' => 'numeric',
            'quantidade' => 'integer'
        ];
    }

    public function messages()
    {
        return [
            'preco.numeric' => 'Este não é um número válido',
            'quantidade.integer' => 'Este não é um formato válido. Por favor digite um número inteiro',
        ];
    }
}
