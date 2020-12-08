<?php

use Illuminate\Database\Seeder;

class PermissionPagoATalleresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $parent = Permission::create(['name' => 'pago a talleres']);

        Permission::create([
        	['name' => 'reportes',
            'parent' => $parent->id,
            'order' => 0],
            ['name' => 'recepcion de facturas',
            'parent' => $parent->id,
            'order' => 1],
            ['name' => 'facturas pendientes por aceptar',
            'parent' => $parent->id,
            'order' => 2],
            ['name' => 'carga de informacion',
            'parent' => $parent->id,
            'order' => 3]
    	]);

        $role = Role::where('name', 'Admin')->first();

        $role->givePermissionTo(Permission::all());

    }
}
