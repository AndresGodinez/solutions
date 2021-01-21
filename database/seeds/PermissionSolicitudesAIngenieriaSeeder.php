<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSolicitudesAIngenieriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $solicitudes_a_ingenieria = Permission::create(
            ['name' => 'solicitudes a ingeniería']
        );

        Permission::create([
            'name' => 'crear solicitudes ing',
            'parent' => $solicitudes_a_ingenieria->id,
            'order' => 0
        ]);

        Permission::create([
            'name' => 'solicitudes ing canceladas y rechazadas',
            'parent' => $solicitudes_a_ingenieria->id,
            'order' => 1
        ]);

        Permission::create([
            'name' => 'solicitudes ing abiertas y revisión',
            'parent' => $solicitudes_a_ingenieria->id,
            'order' => 2
        ]);       

        Permission::create([
            'name' => 'modo de falla ing',
            'parent' => $solicitudes_a_ingenieria->id,
            'order' => 3
        ]);

        Permission::create([
            'name' => 'reporte solicitudes ing',
            'parent' => $solicitudes_a_ingenieria->id,
            'order' => 4
        ]);

        $role = Role::where('name', 'Admin')->first();

        $role->givePermissionTo(Permission::all());

    }
}
