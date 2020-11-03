<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolicitudSustitutoRequest extends FormRequest
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
            'ipt_componente' => 'required|exists:materiales,part_number',
        ];
    }

    public function messages()
    {
        return [
            'ipt_componente.required' => 'El componente es requerido',
            'ipt_componente.exists' => 'El material al cuál solicita un sustituto no existe',
        ];
    }
}
