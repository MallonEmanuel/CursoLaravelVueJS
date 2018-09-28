<?php

use Illuminate\Database\Seeder;

class ViandaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();

        for ($i = 0; $i < 30; $i++) {
            DB::table('viandas')->insert([ //,
              'nombre' => 'vianda_'.$i,
              'descripcion' => 'descripcion_'.$i,
              'precio' => $faker->numberBetween(10,100),
              'vegetariana' => $faker->boolean(),
              'created_at' => now(),
              'updated_at' => now()
            ]);
        }
    }
}
