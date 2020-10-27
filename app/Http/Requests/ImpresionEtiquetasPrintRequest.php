<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImpresionEtiquetasPrintRequest extends FormRequest
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
            'material-to-print' => 'required',
            'quantity' => 'required|numeric',
            'pieces' => 'required|numeric'
        ];
    }
}
