<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=1 ; $i <=4 ; $i++){
            DB::table('usuarios')->insert(array(
                'nombres' => $faker->firstName,
                'apellidos' => $faker->lastName,
                'correo' => $faker->email,
                'contraseña' => hash("sha256",'root1234'),
                'rol_id' => $faker->numberBetween(1,2),
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            ));
        }
        $this->command->info('Tabla rellenada correctamente');
    }
}
