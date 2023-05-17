<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Challenge;
use App\User;
use Auth;
use DB;

class ReportcompletosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //        
        $usuarios = User::join('grupos', 'users.id_grupo', '=', 'grupos.id')
                    ->select('users.id', 'firstname', 'lastname', 'username', 'email', 'level', 's_point', 'i_point', 'g_point', 'grupos.descrip')
                    ->orderBy('firstname', 'asc')
                    ->get();
        $grupos = DB::table('grupos')->get();
        return view('admin.reportcompletos')->with('usuarios', $usuarios)->with('grup', $grupos);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        $retosuser = User::find($id);        
        return view('admin.reportcompletes')
                        ->with('retos', $retosuser->challenges)
                        ->with('usuarioreto', $id);                        
    }


    public function more(Request $request)
    {
        // recibe el ID del reto
        $idusuario = $request->usuario;
        $idreto = $request->idreto;
        $retosuser = Challenge::find($idreto);  

        //#######################################
        $infocomplete = DB::table('challenges')
        ->join('videos', 'challenges.id', '=', 'videos.id_challenge')
        ->join('challenge_user', 'challenges.id', '=', 'challenge_user.challenge_id')
        ->leftjoin('readings', 'challenges.id', '=', 'readings.id_challenge')
        ->join('users', 'videos.id_user', '=', 'users.id')
        ->leftjoin('outdoors', 'challenges.id', '=', 'outdoors.id_challenge')
        ->leftjoin('pictures', 'challenges.id', '=', 'pictures.id_challenge')
        ->where('videos.id_user', '=', $idusuario)
        ->where('videos.id_challenge', '=', $idreto)
        ->select('users.id as id_usuario', 'users.firstname as Usuario', 'users.lastname as Apellido',
                  'challenges.id as id_reto', 'challenges.name as nombre_reto',  
                  'challenges.time as tiempo', 'challenges.material', 'challenges.urlvideo as video', 
                  'challenges.description as descripcion', 'challenges.params as palabras',
                  'challenge_user.s_point as S_ganados', 'challenge_user.i_point as I_ganados',
                  'challenge_user.g_point as G_ganados',
                  'outdoors.image as imagen_Salidas', 'outdoors.evidence as Evidencia_Salidas',
                  'outdoors.image as imagen_Salidas', 'pictures.evidence as Evidencia_Fotografia',
                  'pictures.image as imagen_Fotografia', 'readings.evidence as Evidencia_Lecturas',
                  'videos.evidence as Evidencia_videos')
        ->distinct()
        ->get();

        //#######################  return outdoors
        $infoout = DB::table('challenges')
            ->join('challenge_user', 'challenges.id', '=', 'challenge_user.challenge_id')
            ->leftjoin('outdoors', 'challenges.id', '=', 'outdoors.id_challenge')
            ->join('users', 'outdoors.id_user', '=', 'users.id')
            ->where('outdoors.id_user', '=', $idusuario)
            ->where('outdoors.id_challenge', '=', $idreto)
            ->where('challenge_user.challenge_id', '=', $idreto)
            ->where('challenge_user.user_id', '=', $idusuario)
            ->select('users.id as id_usuario', 'users.firstname as Usuario', 'users.lastname as Apellido',
                    'challenges.id as id_reto', 'challenges.name as nombre_reto',  
                    'challenges.time as tiempo', 'challenges.material', 'challenges.urlvideo as video', 
                    'challenges.description as descripcion', 'challenges.params as palabras',
                    'challenge_user.s_point as S_ganados', 'challenge_user.i_point as I_ganados',
                    'challenge_user.g_point as G_ganados', 'outdoors.image as imagen_Salidas',
                    'outdoors.evidence as Evidencia_Salidas',
                    'outdoors.image as imagen_Salidas', 'outdoors.video')
            ->distinct()
            ->get();
        
        //################3 return readings
        $infolectura = DB::table('challenges')
                    ->join('challenge_user', 'challenges.id', '=', 'challenge_user.challenge_id')
                    ->leftjoin('readings', 'challenges.id', '=', 'readings.id_challenge')
                    ->join('users', 'readings.id_user', '=', 'users.id')
                    ->where('readings.id_user', '=', $idusuario)
                    ->where('readings.id_challenge', '=', $idreto)
                    ->select('users.id as id_usuario', 'users.firstname as Usuario', 'users.lastname as Apellido',
                            'challenges.id as id_reto', 'challenges.name as nombre_reto',  
                            'challenges.time as tiempo', 'challenges.material', 'challenges.urlvideo as video', 
                            'challenges.description as descripcion', 'challenges.params as palabras',
                            'challenge_user.s_point as S_ganados', 'challenge_user.i_point as I_ganados',
                            'challenge_user.g_point as G_ganados',
                            'readings.evidence as Evidencia_Lecturas')
                ->distinct()
                ->get();
        //########################## pictures
        $infopicture = DB::table('challenges')
                    ->join('challenge_user', 'challenges.id', '=', 'challenge_user.challenge_id')
                    ->leftjoin('pictures', 'challenges.id', '=', 'pictures.id_challenge')
                    ->join('users', 'pictures.id_user', '=', 'users.id')
                    ->where('pictures.id_user', '=', $idusuario)
                    ->where('pictures.id_challenge', '=', $idreto)
                    ->select('users.id as id_usuario', 'users.firstname as Usuario', 'users.lastname as Apellido',
                            'challenges.id as id_reto', 'challenges.name as nombre_reto',  
                            'challenges.time as tiempo', 'challenges.material', 'challenges.urlvideo as video', 
                            'challenges.description as descripcion', 'challenges.params as palabras',
                            'challenge_user.s_point as S_ganados', 'challenge_user.i_point as I_ganados',
                            'challenge_user.g_point as G_ganados', 
                            'pictures.evidence as Evidencia_Fotografia',
                            'pictures.image as imagen_Fotografia', 'pictures.video as pvideo')
                ->distinct()
                ->get();

        //consultar quizz
        $quizs = DB::table('quiz_participant_answers')
                 ->join('users', 'quiz_participant_answers.user_id', '=', 'users.id')
                 ->join('quiz_question_answers', 'quiz_participant_answers.quizquestionanswer_id', '=', 'quiz_question_answers.id')
                 ->join('quiz_questions', 'quiz_question_answers.quizquestion_id', '=', 'quiz_questions.id')
                 ->join('quizzes', 'quiz_questions.quiz_id', '=', 'quizzes.id')
                 ->leftjoin('challenge_quiz', 'quizzes.id', '=', 'challenge_quiz.quiz_id')
                 ->join('challenges', 'challenge_quiz.challenge_id', '=', 'challenges.id')
                 ->where('quiz_participant_answers.user_id', '=', $idusuario)
                 ->where('challenges.id', '=', $idreto)
                 ->select('users.firstname as nombre', 'users.lastname as apellido', 'quiz_question_answers.answer as respuesta', 
                           'quiz_question_answers.correct as correcto', 'quiz_questions.question as pregunta',  
                           'challenges.name as reto', 'challenges.s_point as s', 'challenges.i_point as i', 'challenges.g_point as g')
                 ->distinct()
                 ->get();
               
       // $infocomplete = DB::select("call foundcompleteChallenges($idusuario, $idreto)");
        return view('admin.reportmoreinfo')
                        ->with('retos', $retosuser)
                        ->with('idusuario', $idusuario)
                        ->with('infocomplete', $infocomplete)
                        ->with('infoout', $infoout)
                        ->with('infolectura', $infolectura)
                        ->with('infopicture', $infopicture)
                        ->with('quizs', $quizs);
                
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function crearchi(){
        //limpiar archivo  
      $exist = file_exists("informe/archivo.txt");
      if ($exist)
        {
        $borrado = unlink("informe/archivo.txt");
                  //#########################
        //evidencia videos
        $info = DB::table('videos')
                ->join('challenges', 'videos.id_challenge', '=', 'challenges.id') 
                ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')  
                ->join('users', 'videos.id_user', '=', 'users.id')
                ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
                ->select('users.id as id_usuario', 'users.firstname as Usuario', 'users.lastname as Apellido', 'grupos.descrip as grup',
                         'challenges.name as nombre_reto', 'challenges.description as descripcion',
                        'challenges.material', 'challenges.urlvideo as video', 
                        'challenges.params as palabras', 'challenges.subchapter_id as idsub', 'subchapters.chapter_id as cap',
                        'videos.evidence as Evidencia_videos')
                ->distinct()
                ->get();
    
        //respuestas de lecturas
        $info2 = DB::table('readings')
                 ->join('challenges', 'readings.id_challenge', '=', 'challenges.id')
                 ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                 ->join('users', 'readings.id_user', '=', 'users.id')
                 ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
                 ->select('users.id as id_usuario', 'users.firstname as Usuario', 'users.lastname as Apellido', 'grupos.descrip as grup',
                          'challenges.name as nombre_reto',  'challenges.description as descripcion', 'challenges.material', 'challenges.urlvideo as video', 
                         'challenges.params as palabras', 'challenges.subchapter_id as idsub', 'subchapters.chapter_id as cap',
                         'readings.evidence as Evidencia_Lecturas')
                ->distinct()
                ->get();
        //respuestas de salidas
        $info3 = DB::table('outdoors')
                ->join('challenges', 'outdoors.id_challenge', '=', 'challenges.id')
                ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                ->join('users', 'outdoors.id_user', '=', 'users.id')
                ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
                ->select('users.id as id_usuario', 'users.firstname as Usuario', 'users.lastname as Apellido', 'grupos.descrip as grup',
                        'challenges.name as nombre_reto',  'challenges.description as descripcion', 'challenges.material', 'challenges.urlvideo as video', 
                        'challenges.params as palabras', 'challenges.subchapter_id as idsub', 'subchapters.chapter_id as cap',
                        'outdoors.evidence as evioutdoor', 'outdoors.video', 'outdoors.image as img')
            ->distinct()
            ->get();
        //respuestas de pictures
        $info4 = DB::table('pictures')
                ->join('challenges', 'pictures.id_challenge', '=', 'challenges.id')
                ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                ->join('users', 'pictures.id_user', '=', 'users.id')
                ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
                ->select('users.id as id_usuario', 'users.firstname as Usuario', 'users.lastname as Apellido', 'grupos.descrip as grup',
                        'challenges.name as nombre_reto',  'challenges.description as descripcion', 'challenges.material', 'challenges.urlvideo as video', 
                        'challenges.params as palabras', 'challenges.subchapter_id as idsub', 'subchapters.chapter_id as cap',
                        'pictures.evidence as evipic', 'pictures.video', 'pictures.image as img')
            ->distinct()
            ->get();
        $ar = fopen("informe/archivo.txt", "w");
        fwrite($ar, "Usuario*Grupo*nombre_reto*descripcion_reto*palabras*Evidencia_Lecturas*Evidencia_videos*Evidencia_Salidas*Descrip_imagen*Url Video*Link imagen*Capitulo\n");
        $array_num = count($info);
        //link img outdoor
        $linkout = "https://glearning.com.co/storage/gameoutdoor/";
        $linkfoto = "https://glearning.com.co/storage/gamefoto/";
        //videos
        for($i=0; $i<$array_num; $i++){
            $des = preg_replace("/[\r\n|\n|\r]+/", " ", $info[$i]->descripcion);
            $pal = preg_replace("/[\r\n|\n|\r]+/", " ", $info[$i]->palabras);
            $vid = preg_replace("/[\r\n|\n|\r]+/", " ", $info[$i]->Evidencia_videos);
            fwrite($ar, $info[$i]->Usuario.'-'.$info[$i]->Apellido.'*'.$info[$i]->grup.'*'.$info[$i]->nombre_reto.'*'.$des.'*'.$pal.'*'.'*'.$vid.'*'.'*'.'*'.'*'.'*'.$info[$i]->cap.PHP_EOL);
            }
        //lecturas
        for($i=0; $i<count($info2); $i++){
            $des = preg_replace("/[\r\n|\n|\r]+/", " ", $info2[$i]->descripcion);
            $pal = preg_replace("/[\r\n|\n|\r]+/", " ", $info2[$i]->palabras);
            $lec = preg_replace("/[\r\n|\n|\r]+/", " ", $info2[$i]->Evidencia_Lecturas);
            //lecturas
            fwrite($ar, $info2[$i]->Usuario.'-'.$info2[$i]->Apellido.'*'.$info[$i]->grup.'*'.$info2[$i]->nombre_reto.'*'.$des.'*'.$pal.'*'.$lec.'*'.'*'.'*'.'*'.'*'.'*'.$info2[$i]->cap.PHP_EOL);
            }
        //evidencia de salidas
        for($i=0; $i<count($info3); $i++){
            $des = preg_replace("/[\r\n|\n|\r]+/", " ", $info3[$i]->descripcion);
            $pal = preg_replace("/[\r\n|\n|\r]+/", " ", $info3[$i]->palabras);
            $sal = preg_replace("/[\r\n|\n|\r]+/", " ", $info3[$i]->evioutdoor);
            $link = $linkout.$info3[$i]->img;
            //lecturas
            fwrite($ar, $info3[$i]->Usuario.'-'.$info3[$i]->Apellido.'*'.$info[$i]->grup.'*'.$info3[$i]->nombre_reto.'*'.$des.'*'.$pal.'*'.'*'.'*'.$sal.'*'.'*'.$info3[$i]->video.'*'.$link.'*'.$info3[$i]->cap.PHP_EOL);
            }
        //evidencia imagenes
        for($i=0; $i<count($info4); $i++){
            $des = preg_replace("/[\r\n|\n|\r]+/", " ", $info4[$i]->descripcion);
            $pal = preg_replace("/[\r\n|\n|\r]+/", " ", $info4[$i]->palabras);
            $ev = preg_replace("/[\r\n|\n|\r]+/", " ", $info4[$i]->evipic);
            $linkf = $linkfoto.$info4[$i]->img;
            //lecturas
            fwrite($ar, $info4[$i]->Usuario.'-'.$info4[$i]->Apellido.'*'.$info[$i]->grup.'*'.$info4[$i]->nombre_reto.'*'.$des.'*'.$pal.'*'.'*'.'*'.'*'.$ev.'*'.$info4[$i]->video.'*'.$linkf.'*'.$info4[$i]->cap.PHP_EOL);
            }
        fclose($ar);
     }  
      return back();

    }

    //buscar usuario 
    public function usuretoster($id)
    {
        //
        $retosuser = User::find($id);        
        return view('admin.reportcompletes')
                        ->with('retos', $retosuser->challenges)
                        ->with('usuarioreto', $id);                        
    }

    //buscar usuarios por grupos
    
}
