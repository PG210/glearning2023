<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreProcedureLastSubchapter extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE PROCEDURE lastSubchapter(IN chapters INT(10), IN users INT(10))         
        BEGIN SELECT id
        , name
        , title
        , description
        , chapter_id
        , (SELECT COUNT(*) 
            FROM challenges AS RETOS 
            WHERE RETOS.subchapter_id  = SUBCAPITULO.id 
            ) AS RETOS_SUBCAPITULO_REQUERIDO


        , (SELECT COUNT(*) 
            FROM   challenges AS RETOS 
            WHERE RETOS.subchapter_id  = SUBCAPITULO.id 
                AND exists (select * from challenge_user as vistos where vistos.user_id = users and  vistos.challenge_id  = RETOS.id) 
            ) AS RETOS_CAPITULO_COMPLETADOS
        ,`order` 
        ,'SUBCAPITULOS COMPLETADOS POR USUARIO' AS TIPO_REGISTRO
        FROM subchapters as SUBCAPITULO
        where  chapter_id =chapters
        and (SELECT COUNT(*) 
            FROM challenges AS RETOS 
            WHERE RETOS.subchapter_id  = SUBCAPITULO.id 
            ) 
            <>
            (SELECT COUNT(*) 
            FROM   challenges AS RETOS 
            WHERE RETOS.subchapter_id  = SUBCAPITULO.id 
                AND exists (select * from challenge_user as vistos where vistos.user_id = users and  vistos.challenge_id  = RETOS.id) 
            ) 
        ORDER BY `order` LIMIT 1;
    END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXIST lastSubchapter");

    }
}
