<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImpreseionEtiquetasConsultaRequest extends FormRequest
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
//            'material' => 'required|exists:logistica.materiales_abc,material'
        ];
    }

    public function messages()
    {
        return [
//            'material.exists' => 'El material No existe'
        ];
    }
}
