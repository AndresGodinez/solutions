<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionIngExpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $ingexp = Permission::create(['name' => 'catalogo ing']);

        Permission::create([
            'name' => 'cargar al catálogo',
            'parent' => $ingexp->id,
            'order' => 0
        ]);

        Permission::create([
            'name' => 'Editar existente',
            'parent' => $ingexp->id,
            'order' => 1
        ]);
        Permission::create([
            'name' => 'buscar',
            'parent' => $ingexp->id,
            'order' => 2
        ]);
        Permission::create([
            'name' => 'solicitudes de acceso',
            'parent' => $ingexp->id,
            'order' => 3
        ]);

        $role = Role::where('name', 'Admin')->first();

        $role->givePermissionTo(Permission::all());

    }
}
