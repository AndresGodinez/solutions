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

        // create permissions
        Permission::create(['name' => 'crear usuarios']);
        Permission::create(['name' => 'editar usuarios']);
        Permission::create(['name' => 'ver usuarios']);
        Permission::create(['name' => 'eliminar usuarios']);

        $roleAdmin = Role::create(['name' => 'admin']);
        $roleAdmin->givePermissionTo([
            'crear usuarios',
            'editar usuarios',
            'ver usuarios',
            'eliminar usuarios'
        ]);

        $usuario = Usuario::where('username', 'prueba')->first();

        $usuario->assignRole($roleAdmin);




    }
}
