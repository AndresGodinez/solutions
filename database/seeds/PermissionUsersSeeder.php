<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $user = Permission::create(
            ['name' => 'usuarios']
        );

        Permission::create([
            'name' => 'crear usuarios',
            'parent' => $user->id,
            'order' => 0
        ]);

        Permission::create([
            'name' => 'ver usuarios',
            'parent' => $user->id,
            'order' => 1
        ]);

        Permission::create([
            'name' => 'editar usuarios',
            'parent' => $user->id,
            'order' => 2
        ]);

        Permission::create([
            'name' => 'eliminar usuarios',
            'parent' => $user->id,
            'order' => 3
        ]);

        Permission::create([
            'name' => 'exportar usuarios',
            'parent' => $user->id,
            'order' => 4
        ]);

    }
}
