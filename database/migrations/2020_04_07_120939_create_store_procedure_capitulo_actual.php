<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreProcedureCapituloActual extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE PROCEDURE capituloActual(IN user INT(10)) 
        BEGIN SELECT chapters.id, chapters.name, chapters.title
        FROM challenge_user 
        INNER JOIN challenges ON challenge_user.challenge_id = challenges.id
        INNER JOIN subchapters ON challenges.subchapter_id = subchapters.id
        INNER JOIN chapters ON subchapters.chapter_id = chapters.id
        where user_id = user
        and challenge_id = (SELECT max(challenge_id) FROM challenge_user);
        END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXIST capituloActual");
       
    }
}
