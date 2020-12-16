<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class DispatchAbiertos extends ModelBase
{
    //
    protected $table    = "dispatch_abiertos";
    protected $fillable = ['dispatch','model_number','serial_number','problem_description','brand'];

    public static function validate($dispatch){

        $result = DispatchAbiertos::leftJoin('solicitud_ingenieria', 'solicitud_ingenieria.dispatch', '=', 'dispatch_abiertos.dispatch')
        ->leftJoin('detalle_solicitud',function($join){
            $join->on('detalle_solicitud.id_sol', '=', 'solicitud_ingenieria.id_sol');
            $join->where('detalle_solicitud.status', '!=', 'CERRADA');
            $join->where('detalle_solicitud.status', '!=', 'SALVADO');
        })
        ->where('dispatch_abiertos.dispatch', $dispatch)
        ->select('dispatch_abiertos.*', 'solicitud_ingenieria.id_sol' , 'detalle_solicitud.status')
        ->get();
        $valid = true;
        $validMessage = '';


        if($result->count() > 0 ){
            $firstRow = $result[0];
            if($firstRow->id_sol == null  || $firstRow->status == null)
                $valid = true;
            else {
                    $valid = false;
                    $validMessage = 'El Dispatch proporcionado tiene una solicitud creada';
            }
        }
        else
        {
            $result =Collection::make(new DispatchAbiertos);
            $valid = false;
            $validMessage = 'El Folio Proporcionado no es Correcto, Favor de Validarlo';
        }

        $result->prepend($valid,'valid');
        $result->prepend($validMessage,'validMessage');


        return $result;
    }
}
