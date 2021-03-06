<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Solicitud;
use App\Models\Region;

use Maatwebsite\Excel\Facades\Excel;

use App\Exports\SimpleExport;
use App\Utils\MyUtils;

use Session;
use DB;

class ReporteController extends Controller
{
    public function index()
	{
		$user = Session::get('username');
        $items = Menu::getMenu2($user);
        $regions = Region::all();
		return view("pages.reporte.index", ['items' => $items,'regions' => $regions]);
	}
	public function reportOrg( Request $request )
	{
        DB::connection()->enableQueryLog();
        $query  = Solicitud::reporte($request->date_start,$request->date_end);

		if( $request->region != '')
		{
			$query = $query->where("usuarios.id_region","=", $request->region);
		}
		$results = $query->get();



		$html = '<table>';
		$html .= '	<tr></tr>';
		$html .= '	<tr></tr>';
		$html .= '	<tr>';
		$html .= '		<td>Reporte Solicitudes Generadas</td>';
		$html .= '	</tr>';
		$html .= '	<tr>';
		$html .= '		<td>Del "'.$request->date_start.'" Al "'.$request->date_end.'"</td>';
		$html .= '	</tr>';
		$html .= '	<tr></tr><tr></tr><tr>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">SOLICITUD</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">DISPATCH</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">MODELO</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">SERIE</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">DESCRIPCION DEL PROBLEMA</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">LINEA</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">TIPO DE INFORMACION</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">COMENTARIOS</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">COMENTARIOS INGENIERO</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">FECHA DE CREACION</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">USUARIO</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">NOMBRE DE USUARIO</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">CORREO DE USUARIO</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">RESPONSABLE</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">STATUS</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">FECHA DE RESPUESTA </td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">DIAS</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">TALLER</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">ESTADO</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">ZONA</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">SUB-TIPO DE INFORMACION</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">RECOMENDARIA EL SERVICIO</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">EVALUA INFO SOLICITANTE</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">¿MEJORAR DOCUMENTACION?</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">CONTESTO ING</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">EVALUA INFO SOLICITANTE</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">¿MEJORAR DOCUMENTACION?</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">CONTESTO TALL</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">EMBAJADOR</td>';
		$html .= '	<td style="font:calibri;color:#000066;background-color:#288CA2;font-weight:bold; text-align: center">REGION</td>';
		$html .= '</tr>';
		$region = '';
		foreach ($results as $results)
		{
			$creacion=$results->fecha_envio;
			$cerrada=$results->fecha_cerrada;
			$rechazada=$results->fecha_rechazada;
			$status=$results->status;

			if($status=='RECHAZADA'){
				$resta=strtotime($rechazada) - strtotime($creacion);
				$dia=intval($resta/60/60/24);
			}
			elseif($status=='CERRADA'){
				$resta=strtotime($cerrada) - strtotime($creacion);
				$dia=intval($resta/60/60/24);
			}
			else{
				$resta=strtotime('now') - strtotime($creacion);
				$dia=intval($resta/60/60/24);
			}

			if(empty($dia) || !isset($dia))
			{
				$dia = 0;
			}

            $html .= '<tr>';
			$html .= '	<td><center>"'.$results->id_sol.'"</center></td>';
			$html .= '	<td><center>"'.$results->dispatch.'"</center></td>';
			$html .= '	<td><center>"'.$results->modelo.'"</center></td>';
			$html .= '	<td><center>"'.$results->serie.'"</center></td>';
			$html .= '	<td><center>"'.$results->descripcion_problema.'"</center></td>';
			$html .= '	<td><center>"'.$results->linea.'"</center></td>';
			$html .= '	<td><center>"'.$results->informacion.'"</center></td>';
			$html .= '	<td><center>"'.$results->comentario.'"</center></td>';
			$html .= '	<td><center>"'.$results->comentarios.'"</center></td>';
			$html .= '	<td><center>"'.$results->fecha_envio.'"</center></td>';
			$html .= '	<td><center>"'.$results->usuario.'"</center></td>';
			$html .= '	<td><center>"'.$results->nombre.'"</center></td>';
			$html .= '	<td><center>"'.$results->mail.'"</center></td>';
			$html .= '	<td><center>"'.$results->responsable.'"</center></td>';
			$html .= '	<td><center>"'.$results->status.'"</center></td>';
			$html .= '	<td><center>"'.$results->fecha_respuesta.'"</center></td>';
			$html .= '	<td><center>"'.$dia.'"</td>';
			$html .= '	<td><center>"'.$results->taller.'"</center></td>';
			$html .= '	<td><center>"'.$results->estado.'"</center></td>';
			$html .= '	<td><center>"'.$results->zona.'"</center></td>';
			$html .= '	<td><center>"'.$results->sub_tipo.'"</center></td>';
			$html .= '	<td><center>"'.$results->ing_q3.'"</center></td>';
			$html .= '	<td><center>"'.$results->ing_q1.'"</center></td>';
			$html .= '	<td><center>"'.$results->ing_q2.'"</center></td>';
			$html .= '	<td><center>"'.$results->ing_usr_agnt.'"</center></td>';
			$html .= '	<td><center>"'.$results->tall_q1.'"</center></td>';
			$html .= '	<td><center>"'.$results->tall_q2.'"</center></td>';
			$html .= '	<td><center>"'.$results->tall_usr_agnt.'"</center></td>';
			$html .= '	<td><center>"'.$results->embajador.'"</center></td>';
			$html .= '	<td><center>"'.$results->regionName.'"</center></td>';
			$html .= '</tr>';
		}
		return response()->json(['ok' => true,'html' => $html]);

	}

	public function report(Request $request)
	{
       // DB::connection()->enableQueryLog();
        $query  = Solicitud::reporte($request->date_start, $request->date_end);

		if($request->region != '')
		{
			$query = $query->where("usuarios.id_contry","=", $request->region);
		}

        $results_data = $query->get();

       // dd(DB::getQueryLog());

        $results_data = array_map(function($val)
		{
			return json_decode(json_encode($val), true);
		}, $results_data->toArray());

		$head[] = array(
			'SOLICITUD',
			'DISPATCH',
			'MODELO',
			'SERIE',
			'DESCRIPCION DEL PROBLEMA',
			'LINEA',
			'TIPO DE INFORMACION',
			'COMENTARIOS',
			'COMENTARIOS INGENIERO',
			'FECHA DE CREACION',
			'USUARIO',
			'NOMBRE DE USUARIO',
			'CORREO DE USUARIO',
			'RESPONSABLE',
			'STATUS',
			'FECHA DE RESPUESTA',
			'DIAS',
			'TALLER',
			'ESTADO',
			'ZONA',
			'SUB-TIPO DE INFORMACION',
			'RECOMENDARIA EL SERVICIO',
			'EVALUA INFO SOLICITANTE',
			'¿MEJORAR DOCUMENTACION?',
			'CONTESTO ING',
			'EVALUA INFO SOLICITANTE',
			'¿MEJORAR DOCUMENTACION?',
			'CONTESTO TALL',
			'EMBAJADOR',
			'PAIS'
		);

		$data = array();
		$i = 0;
		foreach($results_data as $key => $result)
		{
			$creacion  = $result['fecha_envio'];
			$cerrada   = $result['fecha_cerrada'];
			$rechazada = $result['fecha_rechazada'];

			if($result['status'] == 'RECHAZADA')
			{
				$resta = strtotime($rechazada) - strtotime($creacion);
				$dia   = intval($resta/60/60/24);
			}
			elseif($result['status'] == 'CERRADA')
			{
				$resta = strtotime($cerrada) - strtotime($creacion);
				$dia   = intval($resta/60/60/24);
			}
			else
			{
				$resta=strtotime('now') - strtotime($creacion);
				$dia=intval($resta/60/60/24);
            }

            if(empty($dia) || !isset($dia) || is_null($dia))
			{
				$dia = 0;
			}

			$data[$i]['id_sol']					= $result['id_sol'];
			$data[$i]['dispatch']				= $result['dispatch'];
			$data[$i]['modelo']					= $result['modelo'];
			$data[$i]['serie']					= $result['serie'];
			$data[$i]['descripcion_problema']	= $result['descripcion_problema'];
			$data[$i]['linea']					= $result['linea'];
			$data[$i]['informacion']			= $result['informacion'];
			$data[$i]['comentario']				= $result['comentario'];
			$data[$i]['comentarios']			= $result['comentarios'];
			$data[$i]['fecha_envio']			= $result['fecha_envio'];
			$data[$i]['usuario']				= $result['usuario'];
			$data[$i]['nombre']					= $result['nombre'];
			$data[$i]['mail']					= $result['mail'];
			$data[$i]['responsable']			= $result['responsable'];
			$data[$i]['status']					= $result['status'];
			$data[$i]['fecha_respuesta']		= $result['fecha_respuesta'];
			$data[$i]['dia']					= "".$dia;
			$data[$i]['taller']					= $result['taller'];
			$data[$i]['estado']					= $result['estado'];
			$data[$i]['zona']					= $result['zona'];
			$data[$i]['sub_tipo']				= $result['sub_tipo'];
			$data[$i]['ing_q3']					= $result['ing_q3'];
			$data[$i]['ing_q1']					= $result['ing_q1'];
			$data[$i]['ing_q2']					= $result['ing_q2'];
			$data[$i]['ing_usr_agnt']			= $result['ing_usr_agnt'];
			$data[$i]['tall_q1']				= $result['tall_q1'];
			$data[$i]['tall_q2']				= $result['tall_q2'];
			$data[$i]['tall_usr_agnt']			= $result['tall_usr_agnt'];
			$data[$i]['embajador']				= $result['embajador'];
			$data[$i]['contryName']				= $result['contryName'];
			$i++;
        }

        $name = 'Solicitudes a Ingeniería';
        $extension = '.xlsx';

        $fileName = MyUtils::getName($name, $extension);

        return Excel::download(new SimpleExport($head, $data), $fileName);
		/*return Excel::create('Solicitud', function($excel) use ($results){
			$excel->setTitle('Solicitud');
			$excel->sheet('Solicitud', function($sheet) use ($results){
				$sheet->fromArray($results, null, 'A1', false, false);
			});
		})->download('xlsx');*/
	}
}
