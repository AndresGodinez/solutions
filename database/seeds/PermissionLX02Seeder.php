<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
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

        $lx02 = Permission::create(
            ['name' => 'LX02']
        );

        Permission::create([
            'name' => 'subir archivo LX02',
            'parent' => $lx02->id,
            'order' => 0
        ]);

        Permission::create([
            'name' => 'carga inventario a nivel bin',
            'parent' => $lx02->id,
            'order' => 1
        ]);

        Permission::create([
            'name' => 'carga inventario recibo bins',
            'parent' => $lx02->id,
            'order' => 2
        ]);

    }
}
