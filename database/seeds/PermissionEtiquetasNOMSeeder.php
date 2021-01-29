<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionEtiquetasNOMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $parent = Permission::create(['name' => 'etiquetas nom']);

        Permission::create([
            'name' => 'consulta de informacion nom',
            'parent' => $parent->id,
            'order' => 0
        ]);

        Permission::create([
            'name' => 'carga de informacion nom',
            'parent' => $parent->id,
            'order' => 1
        ]);

        
        $role = Role::where('name', 'Admin')->first();

        $role->givePermissionTo(Permission::all());

    }
}
