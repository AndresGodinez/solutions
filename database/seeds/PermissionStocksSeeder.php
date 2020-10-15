<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionStocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $alcopar = Permission::create(['name' => 'Stock']);

        Permission::create([
            'name' => 'stock inicial',
            'parent' => $alcopar->id,
            'order' => 0
        ]);

        Permission::create([
            'name' => 'stock final',
            'parent' => $alcopar->id,
            'order' => 1
        ]);

        Permission::create([
            'name' => 'stock isc inicial',
            'parent' => $alcopar->id,
            'order' => 2
        ]);

        Permission::create([
            'name' => 'stock isc final',
            'parent' => $alcopar->id,
            'order' => 3
        ]);

        Permission::create([
            'name' => 'carga',
            'parent' => $alcopar->id,
            'order' => 4
        ]);

    }
}
