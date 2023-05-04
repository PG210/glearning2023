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
        $this->call(CompetencesTableSeeder::class);        
        $this->call(PositionsTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(AvatarsTableSeeder::class);
        $this->call(challengeTypesTableSeeder::class);
        $this->call(ChaptersTableSeeder::class);
        $this->call(SubChaptersTableSeeder::class);
        $this->call(TypeUserTableSeeder::class);
        $this->call(AreaspositionTableSeeder::class);
        $this->call(InsigniasTableSeeder::class);        
        $this->call(CompetencesAvaibleTableSeeder::class);
        $this->call(RecompensasTableSeeder::class);
    }
}
