<?php

use Illuminate\Database\Seeder;

class SubChaptersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
        DB::table('subchapters')->insert([    
            ['name'=>'Subcapitulo 0', 'title'=>'Tutorial Básico','order'=>'1','description'=>'Tutorial Básico (Al completar el tutorial subirá su nivel S0 a S1)','time'=>'15', 's_point'=>'0', 'chapter_id'=>'1', 'competence_id'=>'1'],           
        ]);
    }
}
