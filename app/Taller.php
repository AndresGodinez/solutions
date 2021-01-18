<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Taller extends Model
{
    protected $table = 'talleres';
    protected $primaryKey  = 'taller';
    public $timestamps = false;
    protected $fillable = ['taller'];


    public static function getAll(){
    	return datatables()->of(Taller::query()->selectRaw("
                CONCAT('id_',talleres.taller) AS taller_id,
                talleres.taller,
                talleres.nombre,
                CONCAT(talleres.taller, ' - ', talleres.nombre) AS numero_nombre_taller,               
                talleres.ciudad,
                talleres.vendor,
                talleres.supervisor,
                talleres.subzona,
                talleres.tipo,
                talleres.subtipo,
                talleres.status,
                IFNULL(talleres_info.direccion, '') AS direccion,
                IFNULL(talleres_info.colonia, '') AS colonia,
                IFNULL(talleres_info.estado, '') AS estado,
                IFNULL(talleres_info.cp, '') AS cp,
                IFNULL(talleres_info.contacto, '') AS contacto,
                IFNULL(talleres_info.responsable, '') AS responsable,
                IFNULL(talleres_info.telefono, '') AS telefono,
                IFNULL(talleres_info.cabecera, '') AS cabecera,                
                IFNULL(talleres_info.correo, '') AS correo,
                IFNULL(talleres_info.fecha_centralizado, '') AS fecha_centralizado 
            ")
            ->from('talleres') 
            ->leftJoin('talleres_info','talleres.taller', '=', 'talleres_info.taller')           
            ->get())->toJson();
    }

    public function info()
    {
        return $this->hasOne('App\TallerInfo','taller','taller');
    }

    static function getEstados(){
    	$ret = self::select('estado')->where('estado','<>','')->distinct()->get()->pluck('estado');    	
    	return $ret;
    }

    static function getZonas(){
    	$ret = Zona::select('id','zona')->get()->pluck('zona', 'id');   	
    	return $ret;
    }

    static function getTipos(){
    	$ret = self::select('tipo')->where('tipo','<>','')->distinct()->get()->pluck('tipo');    	
    	return $ret;
    }

    static function getSubTipos(){
    	$ret = self::select('subtipo')->where('subtipo','<>','')->distinct()->get()->pluck('subtipo');    	
    	return $ret;
    }

    static function getSubZonas(){
    	$ret = self::select('subzona')->where('subzona','<>','')->distinct()->get()->pluck('subzona');    	
    	return $ret;
    }

    static function getSupervisores(){
    	$ret = self::select('supervisor')->where('supervisor','<>','')->distinct()->get()->pluck('supervisor');	
    	return $ret;
    }

    static function getVendors(){
    	$ret = self::select('supervisor')->where('supervisor','<>','')->distinct()->get()->pluck('supervisor');	
    	return $ret;
    }

    static function getGerentes(){
    	$ret = Zona::select('usuarios.username','usuarios.nombre')
    		->join('usuarios','zonas.responsable', '=', 'usuarios.username')
    		->get()->pluck('nombre', 'username');   	
    	return $ret;
    }


}
