<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsuarioUpdateRequest extends FormRequest
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
            'nombre' => 'required',
            'username' => [
                Rule::unique('usuarios', 'username')->ignore($this->usuario)
            ],
            'mail' => [
                Rule::unique('usuarios', 'mail')->ignore($this->usuario)
            ]
        ];
    }
}
