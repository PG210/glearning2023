<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubchapterUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subchapter_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order');
            $table->integer('chapter_id');
            
            $table->timestamps();

            $table->unsignedInteger('subchapter_id');
            $table->foreign('subchapter_id')->references('id')->on('subchapters');
            
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
        Schema::dropIfExists('subchapter_user');
    }
}
