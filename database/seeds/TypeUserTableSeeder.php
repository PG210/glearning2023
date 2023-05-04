<?php

use Illuminate\Database\Seeder;

class TypeUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([            
            ['name' => 'Jefe Maestro', 'message' =>'Que tal un aplauso por todo lo que estas haciendo', 'g_point' => '1000', 'i_point' => '10000'],
            ['name' => 'Jefe N1', 'message' =>'Un desayuno se Merece', 'g_point' => '700', 'i_point' => '700'],
            ['name' => 'Jefe N2', 'message' =>'Esta Hecho un Duro, Felicitalo', 'g_point' => '500', 'i_point' => '500'],
            ['name' => 'Jefe N3', 'message' =>'Llámalo', 'g_point' => '300', 'i_point' => '300'],
            ['name' => 'Jefe N4', 'message' =>'Te Contamos', 'g_point' => '100', 'i_point' => '100'],
        ]);
    }
}
