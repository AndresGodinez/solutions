<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionFechaPromesasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $promise = Permission::create(
            ['name' => 'fechas promesas']
        );

        Permission::create([
            'name' => 'consulta de fechas promesas',
            'parent' => $promise->id,
            'order' => 0
        ]);

        Permission::create([
            'name' => 'desgargar fecha promesa general',
            'parent' => $promise->id,
            'order' => 1
        ]);

        Permission::create([
            'name' => 'descargar fecha promesa detalles',
            'parent' => $promise->id,
            'order' => 2
        ]);

        Permission::create([
            'name' => 'actualizar fechas promesas',
            'parent' => $promise->id,
            'order' => 3
        ]);

        Permission::create([
            'name' => 'carga archivo fechas promesas tracker',
            'parent' => $promise->id,
            'order' => 4
        ]);

        Permission::create([
            'name' => 'carga archivo fechas promesas backorder',
            'parent' => $promise->id,
            'order' => 5
        ]);

    }
}
