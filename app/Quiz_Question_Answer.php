<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz_Question_Answer extends Model
{
    //

    public $table = "quiz_question_answers";
    //


    protected $fillable = [
        'id', 'answer', 'correct', 'quizquestion_id', 
    ];

    public function Quiz_Question()
    {
        return $this->belongsTo('App\Quiz_Question');
    }

    public function quiz_participants()
    {
        return $this->hasMany('App\Quiz_Participant');
    }
}
