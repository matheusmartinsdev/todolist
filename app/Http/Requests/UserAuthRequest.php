<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAuthRequest extends FormRequest
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
            'email' => 'required|string|email|max:255',
            'password' => 'required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => "Campo 'email' deve ser informado",
            'email.email' => "Campo 'email' não é um e-mail válido: usuario@email.com",
            'password.required' => "Campo 'password' deve ser informado"
        ];
    }
}