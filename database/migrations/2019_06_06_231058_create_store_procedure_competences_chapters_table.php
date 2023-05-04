<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreProcedureCompetencesChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE PROCEDURE foundchapterCompetences(IN paramuser INT(10)) 
        BEGIN  SELECT id
         , name
		 , (SELECT COUNT(*) 
		    FROM subchapters AS subcapitulos 
			     LEFT JOIN challenges AS RETOS ON subcapitulos.id = RETOS.subchapter_id
			WHERE subcapitulos.chapter_id  = CAPITULO.id 
			) AS RETOS_CAPITULO_REQUERIDO
		 , (SELECT COUNT(*) 
		    FROM subchapters AS subcapitulos 
			     LEFT JOIN challenges AS RETOS ON subcapitulos.id = RETOS.subchapter_id
		   WHERE  subcapitulos.chapter_id  = CAPITULO.id 
		         AND exists (select * from challenge_user as vistos where vistos.user_id =paramuser and  vistos.challenge_id  = RETOS.id) 
			) AS RETOS_CAPITULO_COMPLETADOS
		 ,`order` 
		 ,'CAPITULOS COMPLETADOS POR USUARIO' AS TIPO_REGISTRO
            FROM chapters as CAPITULO
            WHERE  (SELECT COUNT(*) 
		    FROM subchapters AS subcapitulos 
			     LEFT JOIN challenges AS RETOS ON subcapitulos.id = RETOS.subchapter_id
			WHERE subcapitulos.chapter_id  = CAPITULO.id 
			)  
			=
			(SELECT COUNT(*) 
		    FROM subchapters AS subcapitulos 
			     LEFT JOIN challenges AS RETOS ON subcapitulos.id = RETOS.subchapter_id
		    WHERE  subcapitulos.chapter_id  = CAPITULO.id 
		         AND exists (select * from challenge_user as vistos where vistos.user_id =paramuser and  vistos.challenge_id  = RETOS.id) 
			)

            UNION

        (SELECT id
         , name
		 , (SELECT COUNT(*) 
		    FROM subchapters AS subcapitulos 
			     LEFT JOIN challenges AS RETOS ON subcapitulos.id = RETOS.subchapter_id
			WHERE subcapitulos.chapter_id  = CAPITULO.id 
			) AS RETOS_CAPITULO_REQUERIDO
		 , (SELECT COUNT(*) 
		    FROM subchapters AS subcapitulos 
			     LEFT JOIN challenges AS RETOS ON subcapitulos.id = RETOS.subchapter_id
		   WHERE  subcapitulos.chapter_id  = CAPITULO.id 
		         AND exists (select * from challenge_user as vistos where vistos.user_id =paramuser and  vistos.challenge_id  = RETOS.id) 
			) AS RETOS_CAPITULO_COMPLETADOS
		 ,`order` 
		 ,'CAOITULLOS COMPLETADOS POR USUARIO' AS TIPO_REGISTRO
            FROM chapters as CAPITULO
            WHERE   (SELECT COUNT(*) 
		    FROM subchapters AS subcapitulos 
			     LEFT JOIN challenges AS RETOS ON subcapitulos.id = RETOS.subchapter_id
			WHERE subcapitulos.chapter_id  = CAPITULO.id 
			)  
			<>
			(SELECT COUNT(*) 
		    FROM subchapters AS subcapitulos 
			     LEFT JOIN challenges AS RETOS ON subcapitulos.id = RETOS.subchapter_id
		   WHERE  subcapitulos.chapter_id  = CAPITULO.id 
		         AND exists (select * from challenge_user as vistos where vistos.user_id = paramuser and  vistos.challenge_id  = RETOS.id) 
			)
             ORDER BY `order` LIMIT 1)
             ORDER BY `order` DESC;
        END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXIST foundchapterCompetences");
       
    }
}
