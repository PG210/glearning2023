<?php

use Illuminate\Database\Seeder;

class ChaptersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('chapters')->insert([
            ['name' => 'TUTORIAL Capitulo 0', 'title' => 'TUTORIAL: Restauracion Basica', 'order' => '1', 'videoIntro' => 'https://www.youtube.com/embed/Q5R8lC9tgeU', 'imgintro' => 'storage/chapter01_bg.jpg', 'description' => 'Tutorial y guia básica que tenemos en nuestro sistema de restauración de datos.', 'time' => '25'],
            
        ]);
    }
}
