<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionStockBasicoTecnicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $stock = Permission::create(['name' => 'stock basico tecnico']);

        Permission::create([
            'name' => 'carga archivo general de stock basico tecnico',
            'parent' => $stock->id,
            'order' => 0
        ]);

        Permission::create([
            'name' => 'descargar reporte general stock basico tecnicos',
            'parent' => $stock->id,
            'order' => 1
        ]);

        Permission::create([
            'name' => 'ver stock basico tecnicos',
            'parent' => $stock->id,
            'order' => 2
        ]);

        Permission::create([
            'name' => 'agregar material a bin',
            'parent' => $stock->id,
            'order' => 3
        ]);

        Permission::create([
            'name' => 'ver detalle de bin',
            'parent' => $stock->id,
            'order' => 4
        ]);

        Permission::create([
            'name' => 'eliminar material de bin',
            'parent' => $stock->id,
            'order' => 5
        ]);

        Permission::create([
            'name' => 'cargar archivo bin',
            'parent' => $stock->id,
            'order' => 6
        ]);
    }
}
