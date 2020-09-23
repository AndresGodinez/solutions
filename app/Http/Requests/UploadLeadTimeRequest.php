<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadLeadTimeRequest extends FormRequest
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
            'lead_time' => 'required|mimes:csv,txt'
        ];
    }

    public function messages()
    {
        return [
            'lead_time.required' => 'El archivo de promesa tracker es requerido.',
            'lead_time.mimes' => 'El archivo a procesar tiene que ser csv o txt.'
        ];
    }
}
