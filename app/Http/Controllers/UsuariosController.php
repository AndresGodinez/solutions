<?php

namespace App\Http\Controllers;

use App\Country;
use App\Departamento;
use App\Http\Requests\UsuarioStoreRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        username,
        nombre,
        mail,
        id
        ')
            ->from('usuarios')
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

    public function show(Usuario $usuario)
    {
        dd('usuario show', $usuario);
    }

    public function edit(Usuario $usuario)
    {
        $departamentos = Departamento::all();
        $countries = Country::get();

        $permissions = DB::table('wpx_menu_users_access')
            ->select(
                'wpx_menu_modulos.id_cat',
                'wpx_menu_modulos.id_modulo',
                'wpx_menu_cat.name',
                'wpx_menu_cat.active as active_cat',
                'wpx_menu_modulos.name as name_mod',
                'wpx_menu_modulos.link as link_mod',
                'wpx_menu_modulos.rw',
                'wpx_menu_modulos.active as active_mod'
            )->leftJoin('wpx_menu_cat', 'wpx_menu_users_access.id_cat', '=', 'wpx_menu_cat.id')
            ->leftJoin('wpx_menu_modulos', 'wpx_menu_users_access.id_modulo', '=', 'wpx_menu_modulos.id_modulo')
            ->where('wpx_menu_users_access.id_user', '=', 'consiss1')
            ->where('wpx_menu_modulos.active', '=', 1)
            ->where('wpx_menu_cat.active', '=', 1)
            ->orderBy('wpx_menu_cat.id')
            ->get();

        return view('Usuarios/edit',
            compact('usuario', 'departamentos', 'countries'));
    }

    public function store(UsuarioStoreRequest $request)
    {
        $depto = Departamento::find($request->get('depto'));

        Usuario::create([
            'nombre' => $request->get('nombre'),
            'username' => $request->get('username'),
            'mail' => $request->get('mail'),
            'password' => Hash::make($request->get('username')),
            'depto' => $depto->departamento ?? '',
            'planta' => $request->get('planta'),
            'id_contry' => $request->get('country'),
            'id_region' => $request->get('region'),
            'cliente' => $request->get('cliente')
        ]);

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
            'id_contry' => $request->get('country'),
            'id_region' => $request->get('region'),
            'cliente' => $request->get('cliente')
        ]);

        return redirect(route('usuarios.index'));
    }

    public function create()
    {
        $departamentos = Departamento::all();
        $countries = Country::get();

        return view('Usuarios.create', compact('departamentos', 'countries'));
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
        return redirect(route('usuario.updateOldPassword'))->with([
            'message' => 'Las contraseñas no coinciden'
        ]);
    }

    public function editPassword()
    {
        return view('Usuarios.editPassword');
    }

    public function updatePassword(Request $request)
    {
        $usuario = Auth::user();

        if(Hash::check($request->get('old_password'), $usuario->password)){
            if ($request->get('new_password') === $request->get('new_password_confirm')){
                $nPassword = Hash::make($request->get('new_password'));
                $usuario->password = $nPassword;
                $usuario->save();
                return  redirect(route('home'))->with(['message' => 'password actualizado']);
            }
        }

        return redirect(route('usuario.editPassword'))->with([
            'message' => 'Las contraseñas no coinciden'
        ]);
    }

    public function destroy(Request $request)
    {
        $usuario = Usuario::find($request->get('user_id'));
        $usuario->delete();
        return response()->json(['message' => 'usuario eliminado']);
    }
}
