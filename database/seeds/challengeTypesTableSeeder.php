<?php

use Illuminate\Database\Seeder;

class challengeTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('challenge_types')->insert([
            ['name' => 'Qüices', 'description' => 'Encuestas con preguntas multiples'],
            ['name' => 'Ahorcado', 'description' => 'juego de ahorcado 1 palabra'],
            ['name' => 'Sopa de Letras', 'description' => 'juego de varias palabras'],
            ['name' => 'Rompecabezas', 'description' => 'imagen para armar'],
            ['name' => 'Ver Video', 'description' => 'visualizar un video'],
            ['name' => 'Subir Foto', 'description' => 'subir imagenes'],
            ['name' => 'Lecturas', 'description' => 'lecturas de algun documento'],
            ['name' => 'Salir a Hacer', 'description' => 'juego para realizar fuera de la plataforma'],
        ]);
    }
}