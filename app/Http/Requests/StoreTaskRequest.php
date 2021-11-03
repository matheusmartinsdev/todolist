<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'text' => 'required|string|max:255',
            'status' => 'required|in:ativa,feita,cancelada',
        ];
    }

    public function messages()
    {
        return [
            'text.required' => "O campo 'text' deve ser informado",
            'text.max' => "O campo 'text' deve ter no máximo 255 caracteres",
            'status.required' => "O campo 'status' deve ser informado",
            'status.in' => "Os valores aceitos para o campo 'status' são: ativa, feita, cancelada"
        ];
    }
}