<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(array(
            ['nombre' => 'admin'],
            ['nombre' => 'usuario-simple'],
        ));
        $this->command->info('Tabla rellenada correctamente');
    }
}
