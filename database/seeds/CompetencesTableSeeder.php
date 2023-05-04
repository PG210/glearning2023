<?php

use Illuminate\Database\Seeder;

class CompetencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('competences')->insert([
            ['name' => 'Liderazgo', 'description' => 'competencia para desarrollo de liderazgo'],
            ['name' => 'Inteligencia Emocional', 'description' => 'competencias para desarrollo de Inteligencia Emocional '],
            ['name' => 'Trabajo en Equipo', 'description' => 'competencias para desarrollo de Trabajo en Equipo '],
            ['name' => 'Planeación Estratégica', 'description' => 'competencias para desarrollo de Planeación Estratégica '],
            ['name' => 'Desarrollo de Persona', 'description' => 'competencias para desarrollo de Desarrollo de Persona '],
            ['name' => 'Creatividad', 'description' => 'competencias para desarrollo de Creatividad '],
            ['name' => 'Impacto e Influencia', 'description' => 'competencias para desarrollo de Impacto e Influencia '],
            ['name' => 'Construcción de Relaciones', 'description' => 'competencias para desarrollo de Construcción de Relaciones '],
            ['name' => 'Orientación al Logro', 'description' => 'competencias para desarrollo de Orientación al Logro '],
        ]);
    }
}
