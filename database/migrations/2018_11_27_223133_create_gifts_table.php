<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gifts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('imagen')->default('default.png');
            $table->string('avatarchange')->default('default.png')->nullable();
            $table->integer('s_point')->default('0');
            $table->integer('i_point')->default('0');
            $table->integer('g_point')->default('0');
            $table->text('description');
            $table->integer('avatar_id');                        
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
        Schema::dropIfExists('gifts');
    }
}
