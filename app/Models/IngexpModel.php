<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Void_;
use Illuminate\Support\Facades\Auth;

date_default_timezone_set("America/Mexico_City");

class IngexpModel extends ModelBase
{
    public function eliminarsimbolos($string){
            
        
        return $string;
    }

    public static function get_records()
    {
        $data = [];
        $d = StocksModel::select('ing_linea.*')
            ->from('ing_linea')
            ->get();
        $data['linea'] = $d;
        
        $d = StocksModel::select('ing_tipo.*')
            ->from('ing_tipo')
            ->get();
            
        $data['tipo'] = $d;
        return $data;
    }

    public static function visor($id){
        $d = StocksModel::select('archivo_carga')
        ->from('ing_registro')
        ->whereRaw('idregistro = ' . $id)
        ->get();

        return $d;
        
    }


    public static function get_list($tipo, $linea)
    {

        if($tipo && $linea){
            $d = AlcoparModel::query()->selectRaw('
                ing_registro.idregistro, 
                ing_registro.titulo, 
                ing_registro.archivo_carga,
                ing_registro.comentarios,
                ing_linea.linea, 
                ing_registro.categoria, 
                ing_registro.modelo,
                ing_tipo.tipo,
                ing_registro.fecha')
            ->from('ing_registro')
            ->leftJoin('ing_linea', 'ing_registro.linea', '=', 'ing_linea.idlinea')
            ->leftJoin('ing_tipo', 'ing_registro.tipo', '=', 'ing_tipo.idtipo')                 
            ->whereRaw("ing_registro.linea ='$linea' AND ing_registro.tipo ='$tipo'")
            ->get();
        }
        else if($tipo){
            $d = AlcoparModel::query()->selectRaw('
                ing_registro.idregistro, 
                ing_registro.titulo, 
                ing_registro.archivo_carga,
                ing_registro.comentarios,
                ing_linea.linea, 
                ing_registro.categoria, 
                ing_registro.modelo,
                ing_tipo.tipo,
                ing_registro.fecha')
            ->from('ing_registro')
            ->leftJoin('ing_linea', 'ing_registro.linea', '=', 'ing_linea.idlinea')
            ->leftJoin('ing_tipo', 'ing_registro.tipo', '=', 'ing_tipo.idtipo')     
            ->whereRaw("ing_registro.tipo ='$tipo'")
            ->get();
        }
        else if($linea){
            $d = AlcoparModel::query()->selectRaw('
                ing_registro.idregistro, 
                ing_registro.titulo, 
                ing_registro.archivo_carga,
                ing_registro.comentarios,
                ing_linea.linea, 
                ing_registro.categoria, 
                ing_registro.modelo,
                ing_tipo.tipo,
                ing_registro.fecha')
            ->from('ing_registro')
            ->leftJoin('ing_linea', 'ing_registro.linea', '=', 'ing_linea.idlinea')
            ->leftJoin('ing_tipo', 'ing_registro.tipo', '=', 'ing_tipo.idtipo')  
            ->whereRaw("ing_registro.linea ='$linea'")  
            ->get();
        }else{
            $d = AlcoparModel::query()->selectRaw('
                ing_registro.idregistro, 
                ing_registro.titulo, 
                ing_registro.archivo_carga,
                ing_registro.comentarios,
                ing_linea.linea, 
                ing_registro.categoria, 
                ing_registro.modelo,
                ing_tipo.tipo,
                ing_registro.fecha')
            ->from('ing_registro')
            ->leftJoin('ing_linea', 'ing_registro.linea', '=', 'ing_linea.idlinea')
            ->leftJoin('ing_tipo', 'ing_registro.tipo', '=', 'ing_tipo.idtipo')     
            ->get();
        }        
        
        return $d;
    }
    public static function get_edit($id)
    {
        $d = StocksModel::select('ing_registro.*')
            ->from('ing_registro')
            ->whereRaw(' idregistro = ' . $id)
            ->get();

        return $d;
    }
    
    public static function cargar($post,$id,$file,$filelarv){

        $retorno = [];

        $titulo         = $post['titulo'];
        $linea          = $post['linea'];
        $comentarios    = $post['comentarios'];
        $categoria      = $post['categoria'];
        $palabra        = $post['palabra'];
        $modelo         = $post['modelo'];
        $tipo           = $post['tipo'];
        $mensaje = array();
        $error = "";




        DB::table('ing_registro')->insert(
            [
                'titulo' => $titulo,
                'comentarios'=>$comentarios, 
                'linea' => $linea, 
                'categoria' => $categoria, 
                'palabra' => $palabra, 
                'modelo' => $modelo, 
                'tipo' => $tipo, 
                'fecha' => 'CURDATE()', 
                'usuario' => $id, 
                'ver' => 1
            ]
        );
        
        $idreg = DB::getPdo()->lastInsertId();
        
        if($file['uploadedfile']['name'] != ''){
            $file = $file['uploadedfile'];
            
            preg_match('/(.*)\.([^\.]+)$/i',basename( $file['name']),$file_explode);
            //$name = eliminarsimbolos($file_explode[1]);

            $string = trim($file_explode[1]);    
            $string = str_replace(
                array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
                array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
                $string
            );    
            $string = str_replace(
                array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
                array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
                $string
            );    
            $string = str_replace(
                array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
                array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
                $string
            );
        
            $string = str_replace(
                array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
                array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
                $string
            );
        
            $string = str_replace(
                array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
                array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
                $string
            );
        
            $string = str_replace(
                array('ñ', 'Ñ', 'ç', 'Ç'),
                array('n', 'N', 'c', 'C',),
                $string
            );
        
            $string = str_replace(
                array("\\", "¨", "º", "-", "~",
                    "#", "@", "|", "!", "\"",
                    "·", "$", "%", "&", "/",
                    "(", ")", "?", "'", "¡",
                    "¿", "[", "^", "<code>", "]",
                    "+", "}", "{", "¨", "´",
                    ">", "< ", ";", ",", ":",
                    ".", " "),
                ' ',
                $string
            );

            $name = $string;

            $ext = strtolower($file_explode[2]);
            $filename = $name.".".$ext;


            $new_file_name = $idreg."-".$filename;
            $filenameup = 'public/doctos/convertir/'.$new_file_name;

            
            if($filelarv->storeAS('public/doctos/convertir/', $new_file_name)){
                DB::table('ing_registro')
                    ->where('idregistro', $idreg)
                    ->update(['archivo_carga' => $filenameup]);
            }
        }
        return $retorno;
            
    }

    public static function cargaredit($post,$id,$file,$filelarv){

        $retorno = [];

        $titulo         = $post['titulo'];
        $linea          = $post['linea'];
        $comentarios    = $post['comentarios'];
        $categoria      = $post['categoria'];
        $palabra        = $post['palabra'];
        $modelo         = $post['modelo'];
        $tipo           = $post['tipo'];
        $regidf           = $post['id'];
        $mensaje = array();
        $error = "";



        DB::table('ing_registro')->
        where('idregistro', $regidf)
        ->update(
            [
                'titulo' => $titulo,
                'comentarios'=>$comentarios, 
                'linea' => $linea, 
                'categoria' => $categoria, 
                'palabra' => $palabra, 
                'modelo' => $modelo, 
                'tipo' => $tipo, 
                'fecha' => 'CURDATE()', 
                'usuario' => $id, 
                'ver' => 1
            ]
        );        
        if($file['uploadedfile']['name'] != ''){
            $file = $file['uploadedfile'];
            
            preg_match('/(.*)\.([^\.]+)$/i',basename( $file['name']),$file_explode);
            //$name = eliminarsimbolos($file_explode[1]);

            $string = trim($file_explode[1]);    
            $string = str_replace(
                array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
                array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
                $string
            );    
            $string = str_replace(
                array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
                array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
                $string
            );    
            $string = str_replace(
                array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
                array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
                $string
            );
        
            $string = str_replace(
                array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
                array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
                $string
            );
        
            $string = str_replace(
                array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
                array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
                $string
            );
        
            $string = str_replace(
                array('ñ', 'Ñ', 'ç', 'Ç'),
                array('n', 'N', 'c', 'C',),
                $string
            );
        
            $string = str_replace(
                array("\\", "¨", "º", "-", "~",
                    "#", "@", "|", "!", "\"",
                    "·", "$", "%", "&", "/",
                    "(", ")", "?", "'", "¡",
                    "¿", "[", "^", "<code>", "]",
                    "+", "}", "{", "¨", "´",
                    ">", "< ", ";", ",", ":",
                    ".", " "),
                ' ',
                $string
            );

            $name = $string;

            $ext = strtolower($file_explode[2]);
            $filename = $name.".".$ext;


            $new_file_name = $regidf."-".$filename;
            $filenameup = 'doctos/convertir/'.$new_file_name;

            
            if($filelarv->storeAS('doctos/convertir/', $new_file_name)){
                DB::table('ing_registro')
                    ->where('idregistro', $regidf)
                    ->update(['archivo_carga' => $filenameup]);
            }
        }

        return $retorno;
            
    }
 
}
