<?php

namespace App\Http\Requests\Produto;

use Illuminate\Foundation\Http\FormRequest;

class StoreProdutoRequest extends FormRequest
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
            "codigo" => 'required',
            'categoria' => 'required',
            'nome' => 'required',
            'preco' => 'required|numeric',
            'composicao' => 'required',
            'tamanho' => 'required',
            'quantidade' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'codigo.required' => 'O código é um campo obrigatório',
            'categoria.required' => 'A categoria é um campo obrigatório',
            'nome.required' => 'O nome é um campo obrigatório',
            'preco.required' => 'O preço é um campo obrigatório',
            'preco.numeric' => 'Este não é um número válido',
            'composicao.required' => 'A composição é um campo obrigatório',
            'tamanho.required' => 'Por favor informe o tamanho',
            'quantidade.required' => 'Por favor informe a quantidade de produtos',
            'quantidade.integer' => 'Este não é um formato válido',
        ];
    }
}
