<?php

use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('areas')->insert([
            ['name' => 'Contabilidad', 'description' => 'ayudante en las tareas de contabilidad'],
            ['name' => 'Sistemas', 'description' => 'ayudante en las tareas de contabilidad'],
            ['name' => 'Gestion de Calidad', 'description' => 'ayudante en las tareas de contabilidad'],            
        ]);
    }
}
