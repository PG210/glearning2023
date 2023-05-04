<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsigniasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('insignias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('imagen')->default('default.png');
            $table->integer('s_point')->default('0');
            $table->integer('i_point')->default('0');
            $table->integer('g_point')->default('0');
            $table->text('description');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insignias');
    }
}
