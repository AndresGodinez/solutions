<?php

namespace App\Http\Controllers;

use App\Country;
use App\Departamento;
use App\Http\Requests\ChangePasswordUserRequest;
use App\Http\Requests\UsuarioStoreRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\Access\Authorizable;
use function compact;
use function redirect;
use function response;
use function route;
use function sha1;
use function view;

class UsuariosController extends Controller
{
    public function index(Request $request)
    {
        return view('Usuarios.index', compact(null));
    }

    public function datoinicial(Request $request)
    {
        return datatables()->of(Usuario::query()->selectRaw('
        usuarios.username,
        usuarios.nombre,
        usuarios.mail,
        usuarios.id,
        roles.name as role
        ')
            ->from('usuarios')
            ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'usuarios.id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->get())->toJson();
    }

    public function download()
    {
        set_time_limit(0);
        ini_set('memory_limit', '1000M');
        header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
        header('Content-Disposition: attachment; filename=Reporte de usuario.xls');

        $usuarios = Usuario::query()
            ->selectRaw('
            usuarios.id,
            usuarios.username,
            usuarios.nombre,
            usuarios.mail,
            wpx_menu_contry.name as cname,
            wpx_menu_region.name as rname
            ')
            ->from('usuarios')
            ->leftJoin('wpx_menu_contry', 'wpx_menu_contry.id', '=', 'usuarios.id_contry')
            ->leftJoin('wpx_menu_region', 'wpx_menu_region.id', '=', 'usuarios.id_region')
            ->get();

        return view('Usuarios.export', compact('usuarios'));
    }

    public function edit(Usuario $usuario)
    {
        $departamentos = Departamento::all();
        $countries = Country::get();

        $roles = Role::get();

        return view('Usuarios/edit',
            compact('usuario', 'departamentos', 'countries', 'roles'));
    }

    public function store(UsuarioStoreRequest $request)
    {
        $depto = Departamento::find($request->get('depto'));

        $usuario = Usuario::create([
            'nombre' => $request->get('nombre'),
            'username' => $request->get('username'),
            'mail' => $request->get('mail'),
            'password' => Hash::make($request->get('username')),
            'depto' => $depto->departamento ?? '',
            'planta' => $request->get('planta'),
            'id_contry' => $request->get('country_id'),
            'id_region' => $request->get('region_id'),
            'cliente' => $request->get('cliente')
        ]);

        $usuario->syncRoles([$request->get('role')]);

        return redirect(route('usuarios.index'));
    }

    public function update(UsuarioUpdateRequest $request, Usuario $usuario)
    {
        $depto = Departamento::find($request->get('depto'));

        $usuario->update([
            'nombre' => $request->get('nombre'),
            'username' => $request->get('username'),
            'mail' => $request->get('mail'),
            'depto' => $depto->departamento ?? '',
            'planta' => $request->get('planta'),
            'id_contry' => $request->get('country_id'),
            'id_region' => $request->get('region_id'),
            'cliente' => $request->get('cliente')
        ]);

        $usuario->syncRoles([$request->get('role')]);

        return redirect(route('usuarios.index'));
    }

    public function create()
    {
        $departamentos = Departamento::all();
        $countries = Country::get();

        $roles = Role::get();

        return view('Usuarios.create', compact(
            'departamentos',
            'countries',
            'roles'
        ));
    }

    public function changeOldPassword(Request $request)
    {
        return view('Usuarios.oldPassword');
    }

    public function updateOldPassword(Request $request)
    {
        $usuario = Usuario::where('username', $request->get('username'))->first();

        if($usuario->password == sha1($request->get('old_password'))){
            if ($request->get('new_password') === $request->get('new_password_confirm')){
                $nPassword = Hash::make($request->get('new_password'));
                $usuario->password = $nPassword;
                $usuario->save();
                return  redirect(route('login'));
            }
        }

        return redirect(route('change.oldpassword'))->with([
            'message' => 'Las contraseñas no coinciden'
        ]);
    }

    public function editPassword($usuario_id = null)
    {

        $currUser = Auth::user();
        $permiso = $currUser->can('editar usuarios');
      
        $request_old_password = true;
        if(!$usuario_id || !$permiso){
            $usuario = Auth::user();           
        }elseif($permiso){
            $usuario = Usuario::find($usuario_id);
            $request_old_password = false;
        }

        
        return view('Usuarios.editPassword')->with(['usuario'=>$usuario, 'request_old_password' => $request_old_password]);
        
    }

    public function updatePassword(ChangePasswordUserRequest $request)
    {

        
        $currUser = Auth::user();
        $permiso = $currUser->can('editar usuarios');
        $usuario = Usuario::find($request->input('id'));
        $message = "";
        
        $change = false;
        if($permiso){
            $change = true;            
        }else{
            if(Hash::check($request->get('old_password'), $usuario->password)){                
                $change = true;                              
            }else{
                $message = 'Las contraseñas no coinciden'; 
            }            
        }


        if($change){           
            $nPassword = Hash::make($request->get('new_password'));
            $usuario->password = $nPassword;
            $usuario->save();
            if($permiso){
                return  redirect(route('usuarios.index'))->with(['message' => 'Password actualizado']);                
            }else{
                return  redirect(route('home'))->with(['message' => 'Password actualizado']);            
            }
            
        }

        return redirect(route('usuario.editPassword'))->with([
            'message' => $message
        ]);
    }

    public function destroy(Request $request)
    {
        $usuario = Usuario::find($request->get('user_id'));
        $usuario->delete();
        return response()->json(['message' => 'usuario eliminado']);
    }

    public function clone(Usuario $usuario)
    {
        $departamentos = Departamento::all();
        $countries = Country::get();

        $roles = Role::get();
        return view('Usuarios.clone', compact('usuario', 'departamentos', 'countries', 'roles'));
    }
}
