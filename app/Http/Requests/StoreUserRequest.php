<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "O campo 'name' é necessário",
            'name.max' => "O campo 'name' deve ter no máximo 255 caracteres",
            'email.required' => "O campo 'email' é necessário",
            'email.email' => "O email informado não segue o padrão de email: usuario@email.com",
            'email.max' => "O email informado é muito longo (mais do que 255 caracteres)",
            'email.unique' => "O email informado já está em uso",
            'password.required' => "O campo 'password' é necessário",
            'password.confirmed' => "O campo 'password_confirmation' não corresponde com 'password' ou não foi preenchido"
        ];
    }
}