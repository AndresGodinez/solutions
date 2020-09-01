<?php

namespace App\Http\Controllers;

use App\Exports\SimpleExport;
use App\Usuario;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UsersExportController extends Controller
{

    public function __invoke(Request $request)
    {
        $name = 'users.xlsx';

        $head = [
            'Admin',
            'Departamento',
            'Username',
            'Nombre',
            'Email',
            'Pais',
            'Region',
        ];

        $usuarios = Usuario::all()->take(30);

        $data = $this->getDataUsuarios($usuarios);

        return Excel::download(new SimpleExport($head, $data), $name);
    }

    private function getDataUsuarios(Collection $usuarios)
    {
        $data = [];

        foreach ($usuarios as $usuario) {
            $data[] = $this->getSingleUser($usuario);
        }
        return $data;
    }

    private function getSingleUser(Usuario $usuario)
    {
        return [
            $usuario->admin == 0 ? 'Si' : 'No',
            $usuario->depto,
            $usuario->username,
            $usuario->nombre,
            $usuario->mail,
            $usuario->country->short_name ?? 'no configurado',
            $usuario->region->short_name ?? 'no configurado',
        ];
    }
}
