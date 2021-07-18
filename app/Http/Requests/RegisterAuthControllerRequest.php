<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAuthControllerRequest extends FormRequest
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
            'nome' => 'required',
            'senha' => 'required|min:8|max:30',
            'email' => 'required|email|unique:users,email'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório',
            'senha.required' => 'O campo senha é obrigatório',
            'senha.min' => 'Sua senha deve conter no mínimo 8 caracteres',
            'senha.max' => 'O máximo de caracteres permitidos são 30',
            'email.required' => 'O campo e-mail é obrigatório',
            'email.email' => 'Este não é um formato de e-mail válido',
            'email.unique' => 'Esse e-mail já esta cadastrado'
        ];
    }
}
