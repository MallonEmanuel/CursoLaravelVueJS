<?php

use Illuminate\Database\Seeder;
use App\Persona;

class PersonaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $faker->addProvider(new Faker\Provider\es_ES\Person($faker));
        for ($i = 0; $i < 200; $i++) {
            DB::table('personas')->insert([ //,
              'nombre' => $faker->firstname,
              'apellido' => $faker->lastname,
              'email' => $faker->unique()->email,
              'created_at' => now(),
              'updated_at' => now()
            ]);
        }
    }
}
