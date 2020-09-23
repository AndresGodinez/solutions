<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadTrackerProcessRequest extends FormRequest
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
            'promesa_tracker_file' => 'required|mimes:csv,txt'
        ];
    }

    public function messages()
    {
        return [
            'promesa_tracker_file.required' => 'El archivo de promesa tracker es requerido.',
            'promesa_tracker_file.mimes' => 'El archivo a procesar tiene que ser csv o txt.'
        ];
    }
}
