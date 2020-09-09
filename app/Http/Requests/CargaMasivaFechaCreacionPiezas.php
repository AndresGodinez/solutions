<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CargaMasivaFechaCreacionPiezas extends FormRequest
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
            'file_c_date_pzas' => 'required|mimes:csv,txt'
        ];
    }
}
