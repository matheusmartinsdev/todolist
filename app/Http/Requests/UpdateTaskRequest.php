<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'text' => 'max:255',
            'status' => 'in:ativa,feita,cancelada'
        ];
    }

    public function messages()
    {
        return [
            'text.max' => "O campo 'text' deve ter no máximo 255 caracteres",
            'status.in' => "Os valores aceitos para o campo 'status' são: ativa, feita, cancelada"
        ];
    }
}