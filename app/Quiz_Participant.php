<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz_Participant extends Model
{
    public $table = "quiz_participant_answers";
    //


    protected $fillable = [
        'id', 'timeQuestionStart', 'timeQuestionEnd', 'user_id', 'quizquestionanswer_id', 
    ];

    //
    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function Quiz_Question_Answer()
    {
        return $this->belongsTo('App\Quiz_Question_Answer');
    }
}
