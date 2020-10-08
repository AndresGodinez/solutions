<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionLX02Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'subir archivo LX02']);
        Permission::create(['name' => 'carga inventario a nivel bin']);
        Permission::create(['name' => 'carga inventario recibo bins']);

        $roleAdmin = Role::where('name', 'admin')->first();

        $roleAdmin->givePermissionTo([
            'subir archivo LX02',
            'carga inventario a nivel bin',
            'carga inventario recibo bins',
        ]);

    }
}
