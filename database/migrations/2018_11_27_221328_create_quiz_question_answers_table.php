<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_question_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('answer')->unique();
            $table->text('correct');            
            $table->timestamps();

            $table->unsignedInteger('quizquestion_id');
            $table->foreign('quizquestion_id')->references('id')->on('quiz_questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_question_answers');
    }
}
