<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionConteoCiclicosSeeder::class);
        $this->call(PermissionFechaPromesasSeeder::class);
        $this->call(PermissionLX02Seeder::class);
        $this->call(PermissionRolesSeeder::class);
        $this->call(PermissionStockBasicoTecnicoSeeder::class);
        $this->call(PermissionSustitutosSeeder::class);
        $this->call(PermissionUsersSeeder::class);


        $this->call(RolesTableSeeder::class);


    }

}
