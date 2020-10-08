<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessReciboBinsRequest extends FormRequest
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
            'recibo_bins' => 'required|mimes:csv,txt'
        ];
    }

    public function messages()
    {
        return [
            'recibo_bins.required' => 'El archivo de Recibo Bins es requerido.',
            'recibo_bins.mimes' => 'El archivo a procesar tiene que ser csv o txt.'
        ];
    }
}
