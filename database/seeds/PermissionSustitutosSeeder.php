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
        Permission::create(['name' => 'exportar usuarios']);

        Permission::create(['name' => 'carga mm60']);
        Permission::create(['name' => 'carga fecha creacion piezas']);
        Permission::create(['name' => 'carga inventarios']);
        Permission::create(['name' => 'carga masiva sustitutos']);

        Permission::create(['name' => 'ver conteo ciclos']);
        Permission::create(['name' => 'procesar hojas conteo ciclos']);
        Permission::create(['name' => 'obtener hojas conteo ciclicos pdf']);
        Permission::create(['name' => 'obtener hojas conteo ciclicos xls']);

        Permission::create(['name' => 'consultar fecha promesa']);
        Permission::create(['name' => 'actualizar fechas promesa']);
        Permission::create(['name' => 'descarga reporte fecha promesa general']);
        Permission::create(['name' => 'descarga reporte fecha promesa detallado']);

        Permission::create(['name' => 'subir archivo promesa tracker']);
        Permission::create(['name' => 'subir archivo lead time']);
        Permission::create(['name' => 'subir archivo backorder']);

        Permission::create(['name' => 'descargar template fecha promesa tracker']);
        Permission::create(['name' => 'descargar template lead time']);
        Permission::create(['name' => 'descargar template backorder']);

        Permission::create(['name' => 'busqueda materiales']);
        Permission::create(['name' => 'descarga de materiales']);
        Permission::create(['name' => 'carga sustituto']);

        $roleAdmin = Role::where('name', 'admin')->first();

        $roleAdmin->givePermissionTo([
            'exportar usuarios',
            'carga mm60',
            'carga fecha creacion piezas',
            'carga inventarios',
            'carga masiva sustitutos',
            'ver conteo ciclos',
            'procesar hojas conteo ciclos',
            'obtener hojas conteo ciclicos pdf',
            'obtener hojas conteo ciclicos xls',
            'consultar fecha promesa',
            'actualizar fechas promesa',
            'descarga reporte fecha promesa general',
            'descarga reporte fecha promesa detallado',
            'subir archivo promesa tracker',
            'subir archivo lead time',
            'subir archivo backorder',
            'descargar template fecha promesa tracker',
            'descargar template lead time',
            'descargar template backorder',
            'busqueda materiales',
            'descarga de materiales',
            'carga sustituto'
        ]);
    }
}
