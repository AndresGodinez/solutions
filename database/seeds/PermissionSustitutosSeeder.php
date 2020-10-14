<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSustitutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions

        $sustitutos = Permission::create(
            ['name' => 'sustitutos']
        );

        Permission::create([
            'name' => 'solicitud de sustitutos',
            'parent' => $sustitutos->id,
            'order' => 0
        ]);

        Permission::create([
            'name' => 'ver sustitutos',
            'parent' => $sustitutos->id,
            'order' => 1
        ]);

        Permission::create([
            'name' => 'carga fecha creacion piezas',
            'parent' => $sustitutos->id,
            'order' => 2
        ]);

        Permission::create([
            'name' => 'carga inventarios',
            'parent' => $sustitutos->id,
            'order' => 3
        ]);

        Permission::create([
            'name' => 'carga masiva sustitutos',
            'parent' => $sustitutos->id,
            'order' => 4
        ]);

        Permission::create([
            'name' => 'busqueda materiales',
            'parent' => $sustitutos->id,
            'order' => 5
        ]);

        Permission::create([
            'name' => 'descarga de materiales',
            'parent' => $sustitutos->id,
            'order' => 6
        ]);

        Permission::create([
            'name' => 'carga sustituto',
            'parent' => $sustitutos->id,
            'order' => 7
        ]);

        Permission::create([
            'name' => 'carga mm60',
            'parent' => $sustitutos->id,
            'order' => 8
        ]);
    }
}
