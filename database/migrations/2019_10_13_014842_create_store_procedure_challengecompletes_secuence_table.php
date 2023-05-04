<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreProcedureChallengecompletesSecuenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE PROCEDURE foundcompleteChallenges(IN userid INT(10), IN retoid INT(10)) 
        BEGIN SELECT users.id as id_usuario,
            users.firstname as Usuario, users.lastname as Apellido,
            challenges.id as id_reto, challenges.name as nombre_reto, 
            challenges.time as tiempo, challenges.material, challenges.urlvideo as video,
            challenges.description as descripcion, challenges.params as palabras,
            challenge_user.s_point as S_ganados, challenge_user.i_point as I_ganados, 
            challenge_user.g_point as G_ganados, outdoors.evidence as Evidencia_Salidas, 
            outdoors.image as imagen_Salidas, outdoors.evidence as Evidencia_Salidas, 
            outdoors.image as imagen_Salidas, pictures.evidence as Evidencia_Fotografia, 
            pictures.image as imagen_Fotografia, readings.evidence as Evidencia_Lecturas,
            videos.evidence as Evidencia_videos
            FROM challenges
            LEFT JOIN challenge_user
            ON challenges.id = challenge_user.challenge_id
            LEFT JOIN outdoors
            ON outdoors.id_challenge = challenges.id
            LEFT JOIN pictures
            ON pictures.id_challenge = challenges.id
            LEFT JOIN readings
            ON readings.id_challenge = challenges.id
            LEFT JOIN videos
            ON videos.id_challenge = challenges.id
            LEFT JOIN users
            ON users.id = challenge_user.user_id
            WHERE challenge_user.user_id = userid
            AND challenge_user.challenge_id = retoid
            LIMIT 1;
        END");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXIST foundcompleteChallenges");
    }
}
