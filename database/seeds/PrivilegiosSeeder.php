<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrivilegiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('privilegios')->insert(array(
            ['ruta' => 'AnuncioControlador@crear'],
            ['ruta' => 'AnuncioControlador@eliminar'],
            ['ruta' => 'AnuncioControlador@modificar'],
            ['ruta' => 'AnuncioControlador@leer'],
            ['ruta' => 'AnuncioControlador@listar'],
        ));
        $this->command->info('Tabla rellenada correctamente');
    }
}
