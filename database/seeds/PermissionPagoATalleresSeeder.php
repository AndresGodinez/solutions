<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

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
            'name' => 'reportes',
            'parent' => $parent->id,
            'order' => 0
        ]);

        Permission::create([
            'name' => 'recepcion de facturas',
            'parent' => $parent->id,
            'order' => 1
        ]);
        
        Permission::create([
            'name' => 'facturas pendientes por aceptar',
            'parent' => $parent->id,
            'order' => 2
        ]);

        Permission::create([
            'name' => 'carga de datos',
            'parent' => $parent->id,
            'order' => 3
        ]);
    	

        $role = Role::where('name', 'Admin')->first();

        $role->givePermissionTo(Permission::all());

    }
}
