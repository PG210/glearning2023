<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreProcedureChaptersSecuenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE PROCEDURE chapterSecuence(IN param INT(10)) 
        BEGIN SELECT id
		 , name
		 , title
		 , description
         , imgintro
		 , (SELECT COUNT(*) 
		    FROM subchapters AS subcapitulos 
			     LEFT JOIN challenges AS RETOS ON subcapitulos.id = RETOS.subchapter_id
			WHERE subcapitulos.chapter_id  = CAPITULO.id 
			) AS RETOS_CAPITULO_REQUERIDO
		 , (SELECT COUNT(*) 
		    FROM subchapters AS subcapitulos 
			     LEFT JOIN challenges AS RETOS ON subcapitulos.id = RETOS.subchapter_id
		   WHERE  subcapitulos.chapter_id  = CAPITULO.id 
		         AND exists (select * from challenge_user as vistos where vistos.user_id =param and  vistos.challenge_id  = RETOS.id) 
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
		         AND exists (select * from challenge_user as vistos where vistos.user_id =param and  vistos.challenge_id  = RETOS.id) 
			)

            UNION

        (SELECT id
         , name
		 , title
		 , description
         , imgintro
		 , (SELECT COUNT(*) 
		    FROM subchapters AS subcapitulos 
			     LEFT JOIN challenges AS RETOS ON subcapitulos.id = RETOS.subchapter_id
			WHERE subcapitulos.chapter_id  = CAPITULO.id 
			) AS RETOS_CAPITULO_REQUERIDO
		 , (SELECT COUNT(*) 
		    FROM subchapters AS subcapitulos 
			     LEFT JOIN challenges AS RETOS ON subcapitulos.id = RETOS.subchapter_id
		   WHERE  subcapitulos.chapter_id  = CAPITULO.id 
		         AND exists (select * from challenge_user as vistos where vistos.user_id =param and  vistos.challenge_id  = RETOS.id) 
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
		         AND exists (select * from challenge_user as vistos where vistos.user_id = param and  vistos.challenge_id  = RETOS.id) 
			)
             ORDER BY `order` ASC LIMIT 1);
        END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXIST chapterSecuence");
    }
}
