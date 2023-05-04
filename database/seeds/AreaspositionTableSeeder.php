<?php

use Illuminate\Database\Seeder;

class AreaspositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('area_position')->insert([
            ['area_id' => '1', 'position_id' => '1'],
            ['area_id' => '2', 'position_id' => '2'],
            ['area_id' => '3', 'position_id' => '3'],               
        ]);
    }
}
