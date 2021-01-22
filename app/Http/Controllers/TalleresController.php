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
        $taller_info = new TallerInfo($request->input('taller_info'));
        
        $taller_info->taller = $taller->taller;

        $taller->save();   
        $taller_info->save();   

        return redirect(route('taller.edit', $taller->id))->with(['message' => 'El taller ha sido creado']);
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
       
        $taller = Taller::find($request->input('taller')['id']);
        $taller_info = TallerInfo::find($request->input('taller_tmp'));
        
        $taller->fill($request->input('taller'));
        $taller_info->fill($request->input('taller_info'));     
        $taller_info->taller = $taller->taller;

        $taller->save();
        $taller_info->save();

        return redirect(route('taller.edit', $taller->id))->with(['message' => 'El taller ha sido actualizado']);
        
    }

   
    public function destroy($id)
    {
        $taller = Taller::find($id);
        $taller_info = TallerInfo::find($taller->taller);

        $numero = $taller->taller;
        $taller->delete();
        $taller_info->delete();

        return Redirect::route('talleres.index')->with(['message' => 'El taller '.$numero.' ha sido eliminado']);

    }

    
}
