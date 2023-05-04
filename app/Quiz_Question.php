<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz_Question extends Model
{
    public $table = "quiz_questions";
    //


    protected $fillable = [
        'id', 'question', 'dificulty', 'multianswer', 'quiz_id', 
    ];



    public function quiz()
    {
        return $this->belongsTo('App\Quiz');
    }
    public function quiz_question_answers()
    {
        return $this->hasMany('App\Quiz_Question_Answer');
    }

}
