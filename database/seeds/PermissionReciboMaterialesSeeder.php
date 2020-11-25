<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionReciboMaterialesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $reciboMateriales = Permission::create(['name' => 'recibo materiales']);

        Permission::create([
            'name' => 'folios de recibo',
            'parent' => $reciboMateriales->id,
            'order' => 0
        ]);

        Permission::create([
            'name' => 'recepcion material',
            'parent' => $reciboMateriales->id,
            'order' => 1
        ]);

        $role = Role::where('name', 'Admin')->first();

        $role->givePermissionTo(Permission::all());
    }
}
