<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends ModelBase
{
    protected $table    = "solicitud_ingenieria";
    protected $primaryKey = 'id_sol';
    protected $fillable = ['id_sol','dispatch', 'os_cca', 'modelo','serie','descripcion_problema','linea_producto','comentario','ruta','informacion','id_sub_tipo','telefono','categoria','nombre_tecnico', 'id_falla'];
    public $timestamps = false;


    public static function consulta(){
        return Solicitud::leftjoin('linea_producto', 'solicitud_ingenieria.linea_producto', '=', 'linea_producto.id')
            ->leftjoin('detalle_solicitud', 'solicitud_ingenieria.id_sol', '=', 'detalle_solicitud.id_sol')
            ->leftjoin('usuarios', 'detalle_solicitud.responsable', '=', 'usuarios.username')
            ->select('solicitud_ingenieria.*', 'linea_producto.linea', 'detalle_solicitud.*','usuarios.nombre')
            ->orderBy('status', 'asc')
            ->orderBy('fecha_envio', 'desc');
    }

    public static function reporte($date_start,$date_end){
        return Solicitud::leftJoin('linea_producto', 'solicitud_ingenieria.linea_producto', '=', 'linea_producto.id')
        ->leftJoin('detalle_solicitud', 'solicitud_ingenieria.id_sol', '=', 'detalle_solicitud.id_sol')
        ->leftJoin('tipo_informacion', 'solicitud_ingenieria.informacion', '=', 'tipo_informacion.id')
        ->leftJoin('revision_ingenieria', 'solicitud_ingenieria.id_sol', '=', 'revision_ingenieria.idsol')
        ->leftJoin('usuarios', 'detalle_solicitud.usuario', '=', 'usuarios.username')
        ->leftJoin('dispatchextract', 'solicitud_ingenieria.dispatch', '=', 'dispatchextract.dispatch')
        ->leftJoin('talleres', 'dispatchextract.taller', '=', 'talleres.taller')
        ->leftJoin('zonas', 'talleres.zona', '=', 'zonas.id')
        ->leftJoin('sol_ing_csat', 'solicitud_ingenieria.id_sol', '=', 'sol_ing_csat.id_sol')
        ->leftJoin('sol_ing_sub_tipo', 'solicitud_ingenieria.id_sub_tipo', '=', 'sol_ing_sub_tipo.id')
        ->leftJoin('wpx_sol_ing_exep_disp', 'solicitud_ingenieria.dispatch', '=', 'wpx_sol_ing_exep_disp.dispatch') // Agrego para los dispatch de programa embajador.
        // ND ->leftJoin('wpx_menu_region', 'wpx_menu_region.id', '=', 'usuarios.id_region')
        ->leftJoin('wpx_menu_contry', 'wpx_menu_contry.id', '=', 'usuarios.id_contry')
        ->where('detalle_solicitud.fecha_envio', '>=', $date_start)
        ->where('detalle_solicitud.fecha_envio', '<=', $date_end)
        ->orderBy("detalle_solicitud.fecha_envio","ASC")
        ->select('solicitud_ingenieria.id_sol',
        'solicitud_ingenieria.dispatch',
        'solicitud_ingenieria.os_cca',
        'solicitud_ingenieria.modelo',
        'solicitud_ingenieria.serie',
        'solicitud_ingenieria.descripcion_problema',
        'solicitud_ingenieria.id_sub_tipo',
        'sol_ing_sub_tipo.sub_tipo',
        'linea_producto.linea',
        'detalle_solicitud.status',
        'detalle_solicitud.fecha_envio',
        'detalle_solicitud.responsable',
        'detalle_solicitud.usuario',
        \DB::raw("IF(detalle_solicitud.fecha_cerrada IS NOT NULL,
            detalle_solicitud.fecha_cerrada,
            detalle_solicitud.fecha_rechazada) AS fecha_respuesta"),
        'tipo_informacion.informacion',
        'detalle_solicitud.usuario',
        'usuarios.nombre',
        'usuarios.mail',
        // ND 'usuarios.id_region',
        'usuarios.id_contry',
        'solicitud_ingenieria.comentario',
        'revision_ingenieria.comentarios',
        'detalle_solicitud.fecha_cerrada',
        'detalle_solicitud.fecha_rechazada',
        'dispatchextract.taller',
        'talleres.estado',
        'zonas.zona',
        'sol_ing_csat.ing_q1',
        'sol_ing_csat.ing_q2',
        'sol_ing_csat.ing_q3',
        'sol_ing_csat.ing_usr_agnt',
        'sol_ing_csat.tall_q1',
        'sol_ing_csat.tall_q2',
        'sol_ing_csat.tall_usr_agnt',
        \DB::raw("IF(wpx_sol_ing_exep_disp.dispatch is not null, 1,0) as embajador"),
        // ND 'wpx_menu_region.name as regionName');
        'wpx_menu_contry.name as contryName');

    }

}
