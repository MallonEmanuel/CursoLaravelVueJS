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
        $this->call(PersonaTableSeeder::class);
        $this->call(ViandaTableSeeder::class);
        $this->call(PedidoTableSeeder::class);
        
    }
}
