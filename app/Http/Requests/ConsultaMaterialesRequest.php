<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultaMaterialesRequest extends FormRequest
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
            'ipt_material' => 'required|exists:materiales,part_number'
        ];
    }

    public function messages()
    {
        return [
            'ipt_material.exists' => 'El material solicitado no existe',
        ];
    }
}
