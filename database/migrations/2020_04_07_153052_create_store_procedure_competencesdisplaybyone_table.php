<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreProcedureCompetencesdisplaybyoneTable extends Migration
{
    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE PROCEDURE competencesdisplaybyone(IN paramuser INT(10)) 
        BEGIN 
        (SELECT SUBCAPITULO.id
            , SUBCAPITULO.name
            , SUBCAPITULO.title
            , SUBCAPITULO.description
            , SUBCAPITULO.chapter_id
            , SUBCAPITULO.competence_id
            , (SELECT COUNT(*) 
                FROM challenges AS RETOS 
                WHERE RETOS.subchapter_id  = SUBCAPITULO.id 
                ) AS RETOS_SUBCAPITULO_REQUERIDO

            , (SELECT COUNT(*) 
                FROM   challenges AS RETOS 
                WHERE RETOS.subchapter_id  = SUBCAPITULO.id 
                    AND exists (select * from challenge_user as vistos where vistos.user_id = paramuser and  vistos.challenge_id  = RETOS.id) 
                ) AS RETOS_CAPITULO_COMPLETADOS
            ,SUBCAPITULO.order
            ,'SUBCAPITULOS COMPLETADOS POR USUARIO' AS TIPO_REGISTRO
            ,competences.name as competencia
            FROM subchapters as SUBCAPITULO
            left join competences as competences on competences.id = SUBCAPITULO.competence_id);            
            END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXIST competencesdisplaybyone");
       
    }
}
