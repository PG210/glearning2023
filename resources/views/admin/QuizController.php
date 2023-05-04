<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\Quiz_Question;
use App\Quiz_Question_Answer;
use App\Log;
use DB;
use Auth;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status="";
        //abrir lista de quizzes creados enviandolos
        $quizzes = Quiz::all();        
        return view('admin.quizzes')->with('quizzes', $quizzes)
                                        ->with('status', $status);                                        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.QuizzesCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $userauthid = Auth::user()->id;

        //preguntaas y respuestas que vienen del componente VUE QuizCreationComponent.vue
        $preguntas = $request->filas;
        $datosquiz = $request->datos;   
        
        for($i = 0; $i < count($preguntas); $i++){
            if ($preguntas[$i]['response'] == null) {
                return('Debes elegir una opcion como correcta');
            }else {
                //datos basicos del reto tipo quizz
                $name = $datosquiz[0]['name'];
                $description = $datosquiz[0]['description'];
                $dificult = $datosquiz[0]['dificult'];
                
                $quiz = new Quiz;
                $quiz->name = $name;
                $quiz->description = $description; 
                $quiz->dificulty = $dificult;
                $quiz->save();

                //registro de LOGS
                Log::create([
                    'model_name' => 'App\Quiz',
                    'recurso_id' => $quiz->id,
                    'user_id' => $userauthid,
                    'accion_realizada' => 'un Quiz ha sido Creado'
                ]);
                
                //guardar datos del array de preguntas y respuestas
                for($i = 0; $i < count($preguntas); $i++){
                    $namepregunta = $preguntas[$i]['description'];
                    
                    //respuesta elegida como la correcta (esta al nivel de la pregunta)
                    $respuestaelegida = $preguntas[$i]['response'];

                    $question = $namepregunta;
                    $dificulty = 0;
                    $multianswer = 1;

                    //obtener el ultimo registro guardado
                    $qid = Quiz::all();
                    $quiz_id = $qid->last();

                    $quesions = [
                        'question'=>$question,            
                        'dificulty'=>$dificulty,
                        'multianswer'=>$multianswer,
                        'quiz_id'=> $quiz_id->id,
                    ];
                    //guardar los datos de un array mientras se recorren
                    Quiz_Question::create($quesions);
                    
                    //guardar respuestas de la pregunta anterior
                    $respuestas = $preguntas[$i]['answers'];
                    
                    for ($j=0; $j < count($respuestas); $j++) { 
                        $answer = $respuestas[$j]['description'];
                        
                        if ($answer == $respuestaelegida) {
                            $correct = "1";
                        } else {
                            $correct = "0";
                        }                

                        $qQuestionid = Quiz_Question::all();
                        $quizQuestion_id = $qQuestionid->last();

                        $quesionsanswers = [
                            'answer'=>$answer,
                            'correct'=>$correct,
                            'quizquestion_id'=> $quizQuestion_id->id,
                        ];
                        Quiz_Question_Answer::create($quesionsanswers);
                    }
                }                
            }
        }

        
        // 
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('admin.quizzesEdit')->with('idquizz', $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //      
        $userauthid = Auth::user()->id;

        //preguntaas y respuestas que vienen del componente VUE QuizCreationComponent.vue
        $preguntas = $request->preguntas;
        $respuestas = $request->respuestas; 
        $anscorrecta = $request->anscorrecta;

        // $preguntasfull = $request->preguntasfull;
        // $respuestasfull = $request->respuestasfull; 
        
        var_dump($respuestas);

        



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = Quiz::find($id);
        
        $status="";
        $count=0;
        
        $count+=count($quiz->challenges);
        
        if ($count>0) {
            $status = 'Este QUIZ ha sido asignado a un RETO, imposible Eliminar.';
        } else {
            Quiz::destroy($id);
            $status = 'QUIZZ ha sido Eliminado correctamente.';
        }
    
        //abrir lista de quizzes creados enviandolos
        $quizzes = Quiz::all();        
        return view('admin.quizzes')->with('quizzes', $quizzes)
                                    ->with('status', $status);

    }

    
    public function quizzesupdate($id)
    {        
        $quizzes = Quiz::find($id);        
        return response()->json($quizzes);        
    }


    public function quizzesquestionsupdate($id)
    {        
        $quizzesquestions = DB::table('quiz_questions')->select('question as description')->where('quiz_id', $id)->get();              
                        
        return response()->json($quizzesquestions);        
    }


    public function quizzesquestionanswerssupdate($id)
    {        
        $quizzesquestionanaswers = DB::table('quiz_question_answers')->where('quizquestion_id', $id)->get();        
        return response()->json($quizzesquestionanaswers);        
    }

}
