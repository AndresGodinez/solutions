<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\TalleresStoreRequest;
use App\Taller;
use App\TallerInfo;
use App\Zona;
use function compact;
use function redirect;
use function route;
use function ucfirst;
use function view;

class TalleresController extends Controller
{
    public function index()
    {        
        return view('Talleres.index');
    }

    public function consulta()
    {        
        return view('Talleres.consulta');
    }

    public function index_json(){
          $json = Taller::getAll();
          return $json;
    }

    public function create()
    {
        $taller = new Taller;
        $taller_info = new TallerInfo;
        return view('Talleres.form',compact('taller','taller_info'));
    }


    public function store(TalleresStoreRequest $request)
    {
        
        $taller = new Taller($request->input('taller'));
        $taller->save();
        $taller_info = new TallerInfo($request->input('taller_info'));
        $taller_info->taller = $taller->taller;
        $taller_info->save();
        
        return redirect(route('talleres.index'))->with(['message' => 'El taller ha sido creado']);
    }

    public function edit($id)
    {
        $taller = Taller::find($id);
        $taller_info = $taller->info;
        if(!$taller_info){
            $taller_info = new TallerInfo();
            $taller_info->taller = $taller->taller;
            $taller_info->save();
        }

        return view('Talleres.form',compact('taller','taller_info'));
    }

    public function update(TalleresStoreRequest $request)
    {
        $taller_request = $request->input('taller'); 
        $taller_info_request = $request->input('taller_info'); 
        

        $taller = Taller::find($taller_request['taller_tmp']);
        $taller_info = TallerInfo::find($taller_request['taller_tmp']);
        
        $taller->taller = $taller_request['taller'];
        $taller->nombre = $taller_request['nombre'];
        $taller->sbid = $taller_request['sbid'];
        $taller->vendor = $taller_request['vendor'];
        $taller->zona = $taller_request['zona'];
        $taller->tipo = $taller_request['tipo'];
        $taller->subtipo = $taller_request['subtipo'];
        $taller->subzona = $taller_request['subzona'];
        $taller->cc = $taller['cc'];
        $taller->supervisor = $taller_request['supervisor'];
        $taller->ciudad = $taller_request['ciudad'];

        $taller_info->taller = $taller_info_request['taller'];
        $taller_info->correo = $taller_info_request['correo'];
        $taller_info->direccion = $taller_info_request['direccion'];
        $taller_info->colonia = $taller_info_request['colonia'];
        $taller_info->cp = $taller_info_request['cp'];
        $taller_info->telefono = $taller_info_request['telefono'];        
        $taller_info->estado = $taller_info_request['estado'];
        $taller_info->contacto = $taller_info_request['contacto'];
        $taller_info->responsable = $taller_info_request['responsable'];

        $taller->save();
        $taller_info->save();

        //dd($taller_request,$taller,$taller_info_request,$taller_info);

        return redirect(route('talleres.index'))->with(['message' => 'El taller ha sido actualizado']);
    }

    public function destroy($id)
    {
        $taller = Taller::find($id);
        $taller_info = TallerInfo::find($id);

        $taller->delete();
        $taller_info->delete();

        return Redirect::route('talleres.index')->with(['message' => 'El taller ha sido eliminado']);

    }

    
}
