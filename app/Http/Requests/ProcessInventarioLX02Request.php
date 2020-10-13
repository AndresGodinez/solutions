<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessInventarioLX02Request extends FormRequest
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
            'inventario_lx02' => 'required|mimes:txt'
        ];
    }

    public function messages()
    {
        return [
            'inventario_lx02.required' => 'El archivo de LX02 es requerido.',
            'inventario_lx02.mimes' => 'El archivo a procesar tiene que ser txt.'
        ];
    }
}
