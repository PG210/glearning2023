<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {                
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('password');
            $table->string('username')->unique();
            $table->string('sexo')->default('Desconocido');
            $table->string('email')->unique();
            $table->boolean('admin')->default(0);
            $table->integer('level')->default('0');
            $table->string('healt')->nullable();
            $table->text('description')->nullable();
            $table->decimal('s_point', 20, 14)->default('0');            
            $table->integer('i_point')->default('0');
            $table->integer('g_point')->default('0');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->unsignedInteger('avatar_id');
            $table->foreign('avatar_id')->references('id')->on('avatars');
                    
            // $table->unsignedInteger('level_id');
            // $table->foreign('level_id')->references('id')->on('levels');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
