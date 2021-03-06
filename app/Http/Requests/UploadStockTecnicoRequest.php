<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadStockTecnicoRequest extends FormRequest
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
            'file_bin' => 'required|mimes:csv,txt'
        ];
    }

    public function messages()
    {
        return [
            'file_bin.mimes' => 'El archivo a procesar tiene que ser csv o txt'
        ];
    }
}
