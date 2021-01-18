<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionTalleresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $taller = Permission::create(
            ['name' => 'talleres']
        );

        Permission::create([
            'name' => 'consulta talleres',
            'parent' => $taller->id,
            'order' => 0
        ]);

        Permission::create([
            'name' => 'administrar talleres',
            'parent' => $taller->id,
            'order' => 1
        ]);

        Permission::create([
            'name' => 'crear talleres',
            'parent' => $taller->id,
            'order' => 0
        ]);       

        Permission::create([
            'name' => 'editar talleres',
            'parent' => $taller->id,
            'order' => 2
        ]);

        Permission::create([
            'name' => 'eliminar talleres',
            'parent' => $taller->id,
            'order' => 3
        ]);

        $role = Role::where('name', 'Admin')->first();

        $role->givePermissionTo(Permission::all());

    }
}
