<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadBackorderRequest extends FormRequest
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
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'backorder_file' => 'required|mimes:csv,txt'
        ];
    }

    public function messages()
    {
        return [
            'backorder_file.required' => 'El archivo de promesa tracker es requerido.',
            'backorder_file.mimes' => 'El archivo a procesar tiene que ser csv o txt.'
        ];
    }
}
