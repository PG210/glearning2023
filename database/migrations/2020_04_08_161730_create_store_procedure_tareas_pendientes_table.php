<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateStoreProcedureTareasPendientesTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::unprepared("CREATE PROCEDURE tareasPendientes(IN paramuser INT(10)) 
        BEGIN SELECT id
        , (SELECT COUNT(*)
        FROM subchapter_user
        AS usuarios_asignados) AS usuarios_asignados

        , (SELECT COUNT(*)
        FROM type_user
        AS jefes_asignados) AS jefes_asignados

        , (SELECT COUNT(*)
        FROM quizzes
        AS quizzes_asignados) AS quizzes_asignados

        , (SELECT COUNT(*)
        FROM causas_points
        AS valores_causas) AS valores_causas
        
        FROM users
        WHERE id = paramuser;        
        END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXIST tareasPendientes");
       
    }
}
