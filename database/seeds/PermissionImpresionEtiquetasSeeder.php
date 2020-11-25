<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionImpresionEtiquetasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $impresionEtiquetas = Permission::create(['name' => 'impresion etiquetas']);

        Permission::create([
            'name' => 'imprimir etiquetas',
            'parent' => $impresionEtiquetas->id,
            'order' => 0
        ]);

        $role = Role::where('name', 'Admin')->first();

        $role->givePermissionTo(Permission::all());

    }
}
