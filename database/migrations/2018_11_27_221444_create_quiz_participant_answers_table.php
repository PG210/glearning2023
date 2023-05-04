<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizParticipantAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_participant_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->time('timeQuestionStart');
            $table->time('timeQuestionEnd');
            $table->integer('user_id'); 
            $table->timestamps();
            
            $table->unsignedInteger('quizquestionanswer_id');
            $table->foreign('quizquestionanswer_id')->references('id')->on('quiz_question_answers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_participant_answers');
    }
}
