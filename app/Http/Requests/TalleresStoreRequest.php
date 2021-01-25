<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TalleresStoreRequest extends FormRequest
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
            'taller.taller' =>  ['required', 'numeric',
                Rule::unique('talleres', 'taller')->ignore($this->input('taller_tmp'),'taller')
            ],
            'taller.nombre' => 'required',
            'taller_info.correo' => 'required|email',
            'taller_info.direccion' => 'required',             
            'taller_info.colonia' => 'required',             
            'taller_info.cp' => 'required|numeric',             
            'taller_info.telefono' => 'required',             
            'taller.ciudad' => 'required',             
            'taller_info.estado' => 'required',             
            'taller_info.contacto' => 'required',             
            'taller_info.responsable' => 'required',

            'taller.sbid' => 'required|numeric',             
            'taller.vendor' => 'required',             
            'taller.zona' => 'required',             
            'taller.status' => 'required',             
            'taller.tipo' => 'required',             
            'taller.subtipo' => 'required',             
            'taller.subzona' => 'required',             
            'taller.cc' => 'required|numeric',             
            'taller.supervisor' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'taller.taller' => 'NÚMERO TALLER',             
            'taller.nombre' => 'NOMBRE TALLER',             
            'taller_info.correo' => 'CORREO',             
            'taller_info.direccion' => 'DIRECCIÓN',             
            'taller_info.colonia' => 'COLONIA',             
            'taller_info.cp' => 'CP',             
            'taller_info.telefono' => 'TELÉFONO',             
            'taller.ciudad' => 'CIUDAD',             
            'taller_info.estado' => 'ESTADO',             
            'taller_info.contacto' => 'CONTACTO',             
            'taller_info.responsable' => 'RESPONSABLE',

            'taller.sbid' => 'SERVICE BENCH ID',             
            'taller.vendor' => 'VENDOR',             
            'taller.zona' => 'ZONA',             
            'taller.status' => 'STATUS',             
            'taller.tipo' => 'TIPO',             
            'taller.subtipo' => 'SUBTIPO',             
            'taller.subzona' => 'SUBZONA',             
            'taller.cc' => 'CC',             
            'taller.supervisor' => 'SUPERVISOR',             
           
        ];

    }

    public function messages()
    {
        return [            
            'taller.taller.unique' => 'NÚMERO TALLER "'.$this->input('taller.taller').'" ya existe',
        ];
    }


}
