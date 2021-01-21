<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSolicitudesAduanalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $parent = Permission::create(['name' => 'solicitudes aduanales']);

        Permission::create([
            'name' => 'crear solicitud aduanal',
            'parent' => $parent->id,
            'order' => 0
        ]);

        Permission::create([
            'name' => 'ver solicitudes aduanales',
            'parent' => $parent->id,
            'order' => 1
        ]);        
     

        $role = Role::where('name', 'Admin')->first();

        $role->givePermissionTo(Permission::all());

    }
}
