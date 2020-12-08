<?php

use Illuminate\Database\Seeder;

class PermissionAduanalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $parent = Permission::create(['name' => 'aduanales']);

        Permission::create([
        	['name' => 'crear solicitud',
            'parent' => $parent->id,
            'order' => 0],
            ['name' => 'cargar informacion',
            'parent' => $parent->id,
            'order' => 1]
    	]);

        $role = Role::where('name', 'Admin')->first();

        $role->givePermissionTo(Permission::all());

    }
}
