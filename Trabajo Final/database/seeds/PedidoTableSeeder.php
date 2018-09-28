<?php

use Illuminate\Database\Seeder;
use App\Persona;
use App\Vianda;

class PedidoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $personas = Persona::all()->pluck('id')->toArray();
        $viandas = Vianda::all()->pluck('id')->toArray();

        for($i= 0; $i < 30; $i++){
          DB::table('pedidos')->insert([ //,
            'persona_id' => $faker->randomElement($personas),
            'vianda_id' => $faker->randomElement($viandas),
            'fecha_solicitud' => now(),
            'fecha_entrega' => null,
            'created_at' => now(),
            'updated_at' => now()

          ]);

        }

    }
}
