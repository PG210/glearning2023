<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreProcedureChallengesSecuenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE PROCEDURE challengeSecuence(IN paramsubchapter INT(10), IN paramuser INT(10)) 
        BEGIN SELECT  id, name, subchapter_id , 'LOGRADO' AS TIPO_REGISTRO
            FROM challenges as RETOS
            WHERE subchapter_id  = paramsubchapter
            and exists (select * from challenge_user as vistos where vistos.user_id = paramuser and  vistos.challenge_id  = RETOS.id) 

            UNION

            (SELECT id, name, subchapter_id , 'EL QUE SIGUE' AS TIPO_REGISTRO
            FROM challenges as RETOS
            WHERE subchapter_id  = paramsubchapter
            and not exists (select * from challenge_user as vistos where vistos.user_id = paramuser and  vistos.challenge_id  = RETOS.id)
            LIMIT 1);
        END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXIST challengeSecuence");
    }
}
