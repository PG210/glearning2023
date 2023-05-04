<?php

use Illuminate\Database\Seeder;

class AvatarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('avatars')->insert([
            ['name' => 'Memorex', 'sexo' => 'Masculino', 'img' => 'dist/img/avatars/SELECMEMOREXH.jpg', 'created_at' => date('Y-m-d H:i:s'), 'description' => 'Los Memorex eran esencialmente programas para ingenieros, tecnólogos, científicos o médicos, personas que se infunden en el conocimiento principalmente o la investigación, poseen una gran memoria para la basta información que requieren almacenar, además manejan un gran sistema de seguridad, encriptando la información y obteniendo grandes espacios de memoria de almacenamiento.'],
            ['name' => 'Linguo', 'sexo' => 'Masculino', 'img' => 'dist/img/avatars/SELECLINGUOH.jpg', 'created_at' => date('Y-m-d H:i:s'), 'description' => 'Los Linguo son programas que empezaron para profesores, psicólogos o exploradores, personas que tienen una facilidad en la interacción con las demás personas y su entorno, el manejo del diálogo se les facilita mucho más ya que toman la información esencial en una conversación, aparte de manejar una basta base de datos en temas varios para facilitar su diálogo con cualquier tipo de persona, también su manejo de ver y entender su entorno, tomar y capturar información a simple vista, tomar información del ambiente o la naturaleza fácilmente.'],
            ['name' => 'Maker', 'sexo' => 'Masculino', 'img' => 'dist/img/avatars/SELECMAKERH.jpg', 'created_at' => date('Y-m-d H:i:s'), 'description' => 'Los Maker son programas que fueron inicialmente obreros, personas enfocadas en el hacer y construir, aquellos que saben bien cómo hacer las cosas y seguir instrucciones, su manejo en conjunto es supremamente eficiente, fácilmente adaptable al trabajo en comunidad o de gran cantidad, no solo son grandes trabajadores sino que también son grandes líderes, capaces de sacar adelante cualquier cosa en equipo.'],
            ['name' => 'Sabius', 'sexo' => 'Masculino', 'img' => 'dist/img/avatars/SELECSABIUSH.jpg', 'created_at' => date('Y-m-d H:i:s'), 'description' => 'Los Sabius son los programas con más historia en la creación cyborg, fue el primer programa en ser lanzado y son considerados los semi cyborgs, cualquiera podía acceder a este programa, ya que eran pequeños implantes que facilitaban el funcionamiento biológico de algunas partes del cuerpo y la memoria, ya que maneja una base de datos de almacenamiento autónomo con una facilidad de manejo, puede repartir esta información, enseñarla, guiarla y llevarla a cabo, es usada principalmente por consejeros y personas que ya vivieron su vida pero la muerte no es parte de ella, y quieren compartir y guiar a futuras generación con sus enseñanzas y su consejo.'],
            ['name' => 'Memorex', 'sexo' => 'Femenino', 'img' => 'dist/img/avatars/SELECMEMOREXM.jpg', 'created_at' => date('Y-m-d H:i:s'), 'description' => ''],
            ['name' => 'Linguo', 'sexo' => 'Femenino', 'img' => 'dist/img/avatars/SELECLINGUOM.jpg', 'created_at' => date('Y-m-d H:i:s'), 'description' => ''],
            ['name' => 'Maker', 'sexo' => 'Femenino', 'img' => 'dist/img/avatars/SELECMAKERM.jpg', 'created_at' => date('Y-m-d H:i:s'), 'description' => ''],
            ['name' => 'Sabius', 'sexo' => 'Femenino', 'img' => 'dist/img/avatars/SELECSABIUSM.jpg', 'created_at' => date('Y-m-d H:i:s'), 'description' => ''],
        ]);
    }
}
