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
        $this->call(RolesSeeder::class);
        $this->call(UsuariosSeeder::class);
        $this->call(PrivilegiosSeeder::class);
        $this->call(RolesPrivilegiosSeeder::class);
        $this->call(AnunciosSeeder::class);
    }
}
