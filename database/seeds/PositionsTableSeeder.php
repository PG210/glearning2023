<?php

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
            ['name' => 'Auxiliar Contabilidad', 'description' => 'ayudante en las tareas de contabilidad'],
            ['name' => 'Coordinador TI', 'description' => 'ayudante en las tareas de contabilidad'],
            ['name' => 'Analista Calidad', 'description' => 'ayudante en las tareas de contabilidad'],            
        ]);
    }
}
