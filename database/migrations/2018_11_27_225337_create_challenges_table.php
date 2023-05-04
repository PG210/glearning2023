<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('challenges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->text('description');
            $table->integer('time');
            $table->boolean('dificult')->default('0');
            $table->string('material')->nullable();
            $table->string('urlvideo')->nullable();
            $table->text('params')->nullable();
            $table->integer('s_point')->default('0');
            $table->integer('i_point')->default('0');
            $table->integer('g_point')->default('0');
            $table->integer('gametype')->default('1');

            $table->timestamps();
 
            $table->unsignedInteger('subchapter_id');
            $table->foreign('subchapter_id')->references('id')->on('subchapters');
            
            $table->unsignedInteger('challenge_type_id');
            $table->foreign('challenge_type_id')->references('id')->on('challenge_types');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('challenges');
    }
}
