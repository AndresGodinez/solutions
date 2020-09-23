<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultaFechaPromesaRequest extends FormRequest
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
            'no_pedido' => 'required|exists:logistica.fecha_promesa,pedido'
        ];
    }

    public function messages()
    {
        return [
            'no_pedido.required' => 'El Número de pedido es requerido',
            'no_pedido.exists' => 'El número de pedido no existe'
        ];
    }
}
