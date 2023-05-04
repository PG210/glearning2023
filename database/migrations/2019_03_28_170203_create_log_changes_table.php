<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_changes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('model_name');
            $table->integer('recurso_id');
            $table->integer('user_id');
            $table->string('accion_realizada');
            
            $table->timestamps();
        });
        // Columna en la cual vas a guardar el nombre del modelo de eloquent
        // Columna en la cual vas a guardar el identificador del recurso
        // El id del usuario que modifico el recurso, lo puedes obtener con auth()->user()->id
        // Columna en la cual vas a guardar la accion que realizo, ya sea create, update o delete
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_changes');
    }
}
