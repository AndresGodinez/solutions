<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionAlcoparSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $alcopar = Permission::create(['name' => 'alta de partes']);

        Permission::create([
            'name' => 'solicitud de alta',
            'parent' => $alcopar->id,
            'order' => 0
        ]);

        Permission::create([
            'name' => 'rev ingenieria/alta sap',
            'parent' => $alcopar->id,
            'order' => 1
        ]);

        Permission::create([
            'name' => 'rev materiales/alta costo',
            'parent' => $alcopar->id,
            'order' => 2
        ]);
       
        Permission::create([
            'name' => 'clasioficacion sat',
            'parent' => $alcopar->id,
            'order' => 3
        ]);

        Permission::create([
            'name' => 'alta precio',
            'parent' => $alcopar->id,
            'order' => 4
        ]);

        Permission::create([
            'name' => 'alta oow',
            'parent' => $alcopar->id,
            'order' => 5
        ]);
        
        // Permission::create([
        //     'name' => 'reporte alta parte',
        //     'parent' => $alcopar->id,
        //     'order' => 6
        // ]);
    }
}
