<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutdoorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outdoors', function (Blueprint $table) {
            $table->increments('id');
            $table->text('evidence');
            $table->text('image');
                       
            $table->timestamps();
            $table->unsignedInteger('id_challenge');
            $table->foreign('id_challenge')->references('id')->on('challenges')->unique();        
            $table->unsignedInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users'); 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outdoors');
    }
}
