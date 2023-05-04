<?php

use Illuminate\Database\Seeder;

class CompetencesAvaibleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('causas_points')->insert([
            ['i_point' => 0, 'g_point' => 0],
        ]);
    }
}
