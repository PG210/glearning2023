<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallengeUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('challenge_user', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->integer('result_api');       
            $table->decimal('s_point', 20, 14)->default('0');
            $table->integer('i_point')->default('0');
            $table->integer('g_point')->default('0');
            $table->timestamps();
            $table->unsignedInteger('challenge_id');
            $table->foreign('challenge_id')->references('id')->on('challenges')->unique();        
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('challenge_user');
    }
}
