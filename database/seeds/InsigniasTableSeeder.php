<?php

use Illuminate\Database\Seeder;

class InsigniasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('insignias')->insert([
            ['name' => 'CREATIVIDAD BRONCE.', 'imagen' => 'storage/CREATIVIDAD_BRONCE.PNG', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion'],
            ['name' => 'CREATIVIDAD ORO.', 'imagen' => 'storage/CREATIVIDAD_ORO.PNG', 's_point' => '40', 'i_point' => '40', 'g_point' => '40', 'description' => 'edite la descripcion'],
            ['name' => 'CREATIVIDAD PLATA.', 'imagen' => 'storage/CREATIVIDAD_PLATA.PNG', 's_point' => '60', 'i_point' => '60', 'g_point' => '60', 'description' => 'edite la descripcion'],
            ['name' => 'DESARROLLO DE PERSONA BRONCE.', 'imagen' => 'storage/DESARROLLO_DE_PERSONA_BRONCE.PNG', 's_point' => '100', 'i_point' => '100', 'g_point' => '100', 'description' => 'edite la descripcion'],
            ['name' => 'DESARROLLO DE PERSONA ORO.', 'imagen' => 'storage/DESARROLLO_DE_PERSONA_ORO.PNG', 's_point' => '160', 'i_point' => '160', 'g_point' => '160', 'description' => 'edite la descripcion'],
            ['name' => 'DESARROLLO DE PERSONA PLATA.', 'imagen' => 'storage/DESARROLLO_DE_PERSONA_PLATA.PNG', 's_point' => '180', 'i_point' => '180', 'g_point' => '180', 'description' => 'edite la descripcion'],
            ['name' => 'LIDERAZGO BRONCE.', 'imagen' => 'storage/LIDERAZGO_BRONCE.PNG', 's_point' => '220', 'i_point' => '220', 'g_point' => '220', 'description' => 'edite la descripcion'],
            ['name' => 'LIDERAZGO ORO.', 'imagen' => 'storage/LIDERAZGO_ORO.PNG', 's_point' => '250', 'i_point' => '250', 'g_point' => '250', 'description' => 'edite la descripcion'],
            ['name' => 'LIDERAZGO PLATA.', 'imagen' => 'storage/LIDERAZGO_PLATA.PNG', 's_point' => '350', 'i_point' => '350', 'g_point' => '350', 'description' => 'edite la descripcion'],
            ['name' => 'PLANEACION ESTRATEGICA BRONCE.', 'imagen' => 'storage/PLANEACION_ESTRATEGICA_BRONCE.PNG', 's_point' => '415', 'i_point' => '415', 'g_point' => '415', 'description' => 'edite la descripcion'],
            ['name' => 'PLANEACION ESTRATEGICA ORO.', 'imagen' => 'storage/PLANEACION_ESTRATEGICA_ORO.PNG', 's_point' => '425', 'i_point' => '425', 'g_point' => '425', 'description' => 'edite la descripcion'],
            ['name' => 'PLANEACION ESTRATEGICA PLATA.', 'imagen' => 'storage/PLANEACION_ESTRATEGICA_PLATA.PNG', 's_point' => '550', 'i_point' => '550', 'g_point' => '550', 'description' => 'edite la descripcion'],
            ['name' => 'TRABAJO EN EQUIPO BRONCE.', 'imagen' => 'storage/TRABAJO_EN_EQUIPO_BRONCE.PNG', 's_point' => '565', 'i_point' => '565', 'g_point' => '565', 'description' => 'edite la descripcion'],
            ['name' => 'TRABAJO EN EQUIPO ORO.', 'imagen' => 'storage/TRABAJO_EN_EQUIPO_ORO.PNG', 's_point' => '590', 'i_point' => '590', 'g_point' => '590', 'description' => 'edite la descripcion'],            
            ['name' => 'TRABAJO EN EQUIPO PLATA.', 'imagen' => 'storage/TRABAJO_EN_EQUIPO_PLATA.PNG', 's_point' => '600', 'i_point' => '600', 'g_point' => '600', 'description' => 'edite la descripcion'],
            ['name' => 'CONSTRUCCION DE RELACIONES BRONCE.', 'imagen' => 'storage/CONSTRUCCION_DE_RELACIONES_BRONCE.png', 's_point' => '700', 'i_point' => '700', 'g_point' => '700', 'description' => 'edite la descripcion'],
            ['name' => 'CONSTRUCCION DE RELACIONES ORO.', 'imagen' => 'storage/CONSTRUCCION_DE_RELACIONES_ORO.png', 's_point' => '760', 'i_point' => '760', 'g_point' => '760', 'description' => 'edite la descripcion'],            
            ['name' => 'CONSTRUCCION DE RELACIONES PLATA.', 'imagen' => 'storage/CONSTRUCCION_DE_RELACIONES_PLATA.png', 's_point' => '1200', 'i_point' => '1200', 'g_point' => '1200', 'description' => 'edite la descripcion'],            
            ['name' => 'IMPACTO E INFLUENCIA BRONCE.', 'imagen' => 'storage/IMPACTO_E_INFLUENCIA_BRONCE.png', 's_point' => '1500', 'i_point' => '1500', 'g_point' => '1500', 'description' => 'edite la descripcion'],            
            ['name' => 'IMPACTO E INFLUENCIA ORO.', 'imagen' => 'storage/IMPACTO_E_INFLUENCIA_ORO.png', 's_point' => '1600', 'i_point' => '1600', 'g_point' => '1600', 'description' => 'edite la descripcion'],            
            ['name' => 'IMPACTO E INFLUENCIA PLATA.', 'imagen' => 'storage/IMPACTO_E_INFLUENCIA_PLATA.png', 's_point' => '1700', 'i_point' => '1700', 'g_point' => '1700', 'description' => 'edite la descripcion'],            
            ['name' => 'INTELIGENCIA EMOCIONAL BRONCE.', 'imagen' => 'storage/INTELIGENCIA_EMOCIONAL_BRONCE.png', 's_point' => '1850', 'i_point' => '1850', 'g_point' => '1850', 'description' => 'edite la descripcion'],            
            ['name' => 'INTELIGENCIA EMOCIONAL ORO.', 'imagen' => 'storage/INTELIGENCIA_EMOCIONAL_ORO.png', 's_point' => '2350', 'i_point' => '2350', 'g_point' => '2350', 'description' => 'edite la descripcion'],            
            ['name' => 'INTELIGENCIA EMOCIONAL PLATA.', 'imagen' => 'storage/INTELIGENCIA_EMOCIONAL_PLATA.png', 's_point' => '120', 'i_point' => '120', 'g_point' => '120', 'description' => 'edite la descripcion'],            
            ['name' => 'ORIENTACION AL LOGRO BRONCE.', 'imagen' => 'storage/ORIENTACION_AL_LOGRO_BRONCE.png', 's_point' => '55', 'i_point' => '55', 'g_point' => '55', 'description' => 'edite la descripcion'],            
            ['name' => 'ORIENTACION AL LOGRO ORO.', 'imagen' => 'storage/ORIENTACION_AL_LOGRO_ORO.png', 's_point' => '3000', 'i_point' => '3000', 'g_point' => '3000', 'description' => 'edite la descripcion'],        
            ['name' => 'ORIENTACION AL LOGRO PLATA.', 'imagen' => 'storage/ORIENTACION_AL_LOGRO_PLATA.png', 's_point' => '640', 'i_point' => '640', 'g_point' => '640', 'description' => 'edite la descripcion'],            
        ]);
    }
}
