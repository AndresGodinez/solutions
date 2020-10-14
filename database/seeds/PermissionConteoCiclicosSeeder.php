<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionConteoCiclicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $cCiclicos = Permission::create(
            ['name' => 'conteo ciclicos']
        );

        Permission::create([
            'name' => 'carga materiales para hojas de conteo cilicos',
            'parent' => $cCiclicos->id,
            'order' => 0
        ]);

        Permission::create([
            'name' => 'descarga de hojas conteo ciclicos pdf',
            'parent' => $cCiclicos->id,
            'order' => 1
        ]);

        Permission::create([
            'name' => 'descarga de hojas conteo ciclicos xls',
            'parent' => $cCiclicos->id,
            'order' => 2
        ]);

        Permission::create([
            'name' => 'ver conteo cicliclos',
            'parent' => $cCiclicos->id,
            'order' => 3
        ]);

    }
}
