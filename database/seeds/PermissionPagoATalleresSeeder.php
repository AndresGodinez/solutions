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
            'name' => 'facturas recibidas de pago a talleres',
            'parent' => $parent->id,
            'order' => 0
        ]);

        Permission::create([
            'name' => 'facturas aceptadas admin de pago a talleres',
            'parent' => $parent->id,
            'order' => 1
        ]);
        
        Permission::create([
            'name' => 'facturas taller',
            'parent' => $parent->id,
            'order' => 2
        ]);

        Permission::create([
            'name' => 'reporte ts',
            'parent' => $parent->id,
            'order' => 3
        ]);

        Permission::create([
            'name' => 'carga de datos talleres',
            'parent' => $parent->id,
            'order' =>4
        ]);
    	

        $role = Role::where('name', 'Admin')->first();

        $role->givePermissionTo(Permission::all());

    }
}
