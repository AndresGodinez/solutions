<?php

use App\Usuario;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $roleAdmin = Role::create(['name' => 'admin']);
        $roleAdmin->givePermissionTo(
            Permission::all()
        );

        $usuario = Usuario::where('username', 'prueba')->first();

        $usuario->assignRole($roleAdmin);
    }
}
