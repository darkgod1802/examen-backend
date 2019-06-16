<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnunciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=1 ; $i <= 10 ; $i++){
            DB::table('anuncios')->insert(array(
                'titulo' => $faker->companySuffix,
                'descripcion' => $faker->sentence(20),
                'fecha'=> date($format = 'Y-m-d'),
                'hora'=> $faker->time($format = 'H:i:s'),
                'usuario_id' => $faker->numberBetween(1,4),
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s'),
            ));
        }
        $this->command->info('Tabla rellenada correctamente');
    }
}
