<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
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

        Permission::create(['name' => 'ver roles']);
        Permission::create(['name' => 'editar roles']);
        Permission::create(['name' => 'crear roles']);
        Permission::create(['name' => 'eliminar roles']);

        $roleAdmin = Role::where('name', 'admin')->first();

        $roleAdmin->givePermissionTo([
            'ver roles',
            'editar roles',
            'crear roles',
            'eliminar roles',
        ]);

    }
}
