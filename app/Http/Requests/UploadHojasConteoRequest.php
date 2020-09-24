<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadHojasConteoRequest extends FormRequest
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
            'hoja_conteo_ciclos_file' => 'required|mimes:csv,txt'
        ];
    }

    public function messages()
    {
        return [
            'hoja_conteo_ciclos_file.required' => 'El archivo de hojas conteo es requerido.',
            'hoja_conteo_ciclos_file.mimes' => 'El archivo a procesar tiene que ser csv o txt.'
        ];
    }
}
