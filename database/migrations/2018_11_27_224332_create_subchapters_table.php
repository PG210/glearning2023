<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubchaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('subchapters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('title')->unique();
            $table->integer('order');            
            $table->text('description');
            $table->integer('s_point')->default('0');
            $table->integer('time');
            $table->timestamps();
            
            $table->unsignedInteger('chapter_id');
            $table->foreign('chapter_id')->references('id')->on('chapters');
            
            $table->unsignedInteger('competence_id');
            $table->foreign('competence_id')->references('id')->on('competences');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subchapters');
    }
}
