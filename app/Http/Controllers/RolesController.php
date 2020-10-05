<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function compact;
use function redirect;
use function route;
use function view;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::get();

        return view('Roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::get();

        return view('Roles.create', compact('permissions'));
    }

    public function store(RoleStoreRequest $request)
    {
        $nRole = Role::create(['name' => $request->get('name')]);

        $permissions = $request->get('permissions');

        foreach ($permissions as $permission) {
            $nRole->givePermissionTo($permission);
        }

        return redirect(route('roles.index'))->with(['message' => 'El role ha sigo creado']);
    }

    public function edit(Role $role)
    {
        $permissions = Permission::get();

        return view('Roles.edit', compact('permissions', 'role'));
    }

    public function update(Role $role, RoleUpdateRequest $request)
    {
        $role->syncPermissions();

        $permissions = $request->get('permissions');

        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }

        return redirect(route('roles.index'))->with(['message' => 'El role ha sido actualizado']);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect(route('roles.index'))->with(['message' => 'El role ha sido eliminado']);

    }
}
