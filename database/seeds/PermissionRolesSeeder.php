<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role = Permission::create(
            ['name' => 'roles']
        );

        Permission::create([
            'name' => 'crear roles',
            'parent' => $role->id,
            'order' => 0
        ]);

        Permission::create([
            'name' => 'ver roles',
            'parent' => $role->id,
            'order' => 1
        ]);

        Permission::create([
            'name' => 'editar roles',
            'parent' => $role->id,
            'order' => 2
        ]);

        Permission::create([
            'name' => 'eliminar roles',
            'parent' => $role->id,
            'order' => 3
        ]);
    }
}
