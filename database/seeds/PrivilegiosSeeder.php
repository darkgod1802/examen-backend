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
            ['ruta' => 'AnunciosControlador@crear'],
            ['ruta' => 'AnunciosControlador@eliminar'],
            ['ruta' => 'AnunciosControlador@modificar'],
            ['ruta' => 'AnunciosControlador@leer'],
            ['ruta' => 'AnunciosControlador@listar'],
        ));
        $this->command->info('Tabla rellenada correctamente');
    }
}
