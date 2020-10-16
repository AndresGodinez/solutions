<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function compact;
use function redirect;
use function route;
use function ucfirst;
use function view;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::get();

        $nRoles = $roles->map(function ($role){
           $role->permissionsText = $role->permissions->map(function ($permission){
               $permission->text = ucfirst($permission->name);
               return $permission;
           });
           return $role;
        });

        return view('Roles.index', compact('nRoles'));
    }

    public function create()
    {
        $groupedPermissions = $this->groupedPermissions();
        return view('Roles/create',compact('groupedPermissions'));
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
        $rolePermissions = $role->getAllPermissions();

        $allPermissions = Permission::all();

        $groupedPermissions = $this->groupedPermissions();

        return view('Roles.edit', compact(
            'rolePermissions',
            'role',
            'allPermissions',
            'groupedPermissions'
        ));
    }

    public function update(Role $role, RoleUpdateRequest $request)
    {
        $role->syncPermissions();

        $role->name = $request->get('name');

        $role->save();

        $permissions = $request->get('permissions');

        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }

        return redirect(route('roles.index'))->with(['message' => 'El role ha sido actualizado']);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return Redirect::route('roles.index')->with(['message' => 'El role ha sido eliminado']);

    }

    protected function groupedPermissions()
    {
        $permissions = Permission::get();

        $parents = $permissions->where('parent', 0)->filter(function ($item){
            return $item->parent == 0;
        });

        return $parents->map(function ($item) use ($permissions){

            $item->subItems = $permissions->filter(function ($permission) use ($item){
                return $permission->parent == $item->id;
            });

            return $item;
        });
    }
}
