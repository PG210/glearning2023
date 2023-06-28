<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\alertaas;

use Illuminate\Http\Request;
use App\Subchapter;
use App\Chapter;
use App\Challenge;
use App\User;
use App\Quiz;
use App\Quiz_Question;
use App\Quiz_Question_Answer;
use App\Quiz_Participant;
Use App\Insignia;
use App\Gift;
use Carbon\Carbon;
use DB;
use Auth;


class PlayerChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function challenge($id)
    {
        $var = DB::table('challenges')
               ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
               ->where('challenges.id', $id)
               ->select('chapter_id')
               ->get();
        $cap = $var[0]->chapter_id;
        //return $id;
        $retos = Challenge::where('id', $id)->first();
       //return $retos;
        $quiz = Challenge::with('quizzes')->find($retos->id);
       
        return view('player.retos')->with('retos', $retos)
                                ->with('quiz', $quiz)
                                ->with('cap', $cap);
    }

    //llega el id del quiz a desarrollar para el reto elegido
    public function startplay(Request $request, $id)
    {
        
        //$request->idreto = es el id del RETO
        //$id = es el id del QUIZ
        //$request->versu = es el flag de que es un versus (1)
    
        //reto al que pertenece el quiz
        $challengequiz = Quiz::find($id);
        foreach ($challengequiz->challenges as $challenge) {
        }
        $tiempoasignado = $challenge->time;
        
        //hora actual
        $tiempoinicio = Carbon::now();
       
        //preguntas que pertenecen al quiz elegido        
        $questions = Quiz_Question::where('quiz_id', $id)->get();
        return view('player.startchallenge')->with('questions',$questions)
                                            ->with('tiempoasignado', $tiempoasignado)
                                            ->with('tiempoinicio', $tiempoinicio)
                                            ->with('idreto', $request->idreto);
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
        $userauthid = Auth::user()->id;
        $datetime = Carbon::now();       


        //obtener los datos del jugador
        $userplayer = User::find($userauthid);

        //obtener las respuestas elegidas por el jugador
        $playerParticipant = $request->usuario;
        $quiz_selected = $request->quizactual;
        $retoactual = $request->idretoactual;
        
        // ========== calcular respuestas correctas, pasa o no pasa el puntaje para ganar (80% minimo para ganar)
        //matrices temporales
        $arrayanswers = [];
        $arraycorrectas = [];
        
        //verificar las respuestas con la bd
        $answersid = $request->idquizzes; //array multiple seleccion de respuestas 
        $answersgroup = array_unique($answersid);    
        
        $new_array = array_values($answersgroup); 


        foreach ($new_array as $answersgroid) {
            $answers = $request->$answersgroid;
            // foreach ($answers as $answer) {            
                $quizanswers = DB::table('quiz_question_answers')
                ->where('id', $answers)
                ->get();
            
                $arrayanswers[] = $quizanswers[0];      
            // }
        }
    
        //obtener y almacenar solo las respuestas correctas
        foreach ($arrayanswers as $respuesta) {
            if ($respuesta->correct == 1) {
                $arraycorrectas[] = $respuesta;
            }
        }

        //cantidad respuestas contestadas
        $cantanswers = count($arrayanswers);

        //cantidad respuestas correctas
        $cantcorrectanswers = count($arraycorrectas); 

        $porcentwin = ($cantanswers*0.8);

        // === (aqui se podrian plantear intentos x juegos perdidos, podria necesitar cambios en BD) ==== //
        // ======== validar se obtubo el 80% o mas para pasar la prueba y guardar los puntajes =======//
        if ($cantcorrectanswers >= $porcentwin) {      
            //obtener los retos quiz ligados al juego actual:
            $challenge_quiz_id = DB::table('challenge_quiz')
                                ->where('quiz_id', $quiz_selected)
                                ->get();            
            foreach ($challenge_quiz_id as $challenquiz) {                
            }            

            //obtener el reto correspondiente:
            $Challengesplayed = Challenge::find($challenquiz->challenge_id); 

            $subchapter_id = $Challengesplayed->subchapter_id;

            for ($i=0; $i < count($arraycorrectas); $i++) { 
                $id_answer = $arraycorrectas[$i];   
                
                //crear y guardar datos del array recorrido en QUIZ_PARTICIPANS_ANSWERS
                $answerarray = [
                    'quizquestionanswer_id' => $id_answer->id,
                    'user_id' => $playerParticipant,
                    'timeQuestionStart' => '2019-01-23 00:00:00',
                    'timeQuestionEnd' => '2019-01-23 00:00:00',  
                ];
                Quiz_Participant::create($answerarray);
            }


            // ======================= PUNTAJES EN RETOS JUGADOS vs SUBCAPITULOS ========================

            //cantidad puntos S en el subcapitulo
            $subchapterspoint = DB::table('subchapters')
                                ->where('id', $subchapter_id)
                                ->pluck('s_point'); 

            $subchapterpoint = $subchapterspoint[0];
            
            //cantidad de Retos en el subcapitulo actual
            $challengesin = DB::table('challenges')
                            ->where('subchapter_id', $subchapter_id)
                            ->count();

            $challenges = DB::table('challenges')
                            ->where('id', $retoactual)
                            ->get();
                                                                    
            //cantidad puntos para retos
            $retospts = $subchapterpoint / $challengesin;
            // $retospts = ceil($retospts);

            $i_point = 0;
            $g_point = 0;
            foreach ($challenges as $challenge) {
                $i_point = $challenge->i_point;
                $g_point = $challenge->g_point;
            }    

            //guardar campos en la tabla pivote CHALLENGE_USER, forzando campos que no estan en el guardado inmediato anterior
            $retos = new Challenge;
            $retos->users()->attach($playerParticipant, [
                'start' => $datetime,
                'end' => $datetime,
                'result_api' => '0',
                's_point' => $retospts,
                'i_point' => $i_point,
                'g_point' => $g_point,
                'challenge_id' => $retoactual
                ]);        
            
            //========================== TOTAL PUNTOS S, I, G DEL USUARIO - JUGADOR =======================
            $sum_spoints = 0;
            $sum_ipoints = 0;
            $sum_gpoints = 0;
            
            //puntos S de retos jugados
            $userspoints = DB::table('challenge_user')
                            ->where('user_id', $userauthid)
                            ->pluck('s_point');

            for ($i=0; $i < count($userspoints); $i++) { 
                //suma de puntos S de retos jugados por el usuario
                $sum_spoints = $sum_spoints + $userspoints[$i];          
            }

            //puntos I de retos jugados
            $userspointi = DB::table('challenge_user')
                            ->where('user_id', $userauthid)
                            ->pluck('i_point');

            for ($i=0; $i < count($userspointi); $i++) { 
                //suma de puntos I, retos jugados por el usuario
                $sum_ipoints = $sum_ipoints + $userspointi[$i];          
                //ACTUALIZAR puntaje del jugador
            }

            //puntos G de retos jugados 
            $userspointi = DB::table('challenge_user')
                            ->where('user_id', $userauthid)
                            ->pluck('g_point');

            for ($i=0; $i < count($userspointi); $i++) { 
                //suma de puntos S, retos jugados por el usuario
                $sum_gpoints = $sum_gpoints + $userspointi[$i];          
            }

        //====== DESCOMPONER puntajes ganados y puntajes actuales =====//
        
           //puntos ganados
           $winpoints = ceil($sum_spoints);
           $winpoints = number_format($winpoints,0);            
           $unidades = $winpoints % 10;            
           $aux = $winpoints - $unidades;
           $aux = $aux % 100;
           $decenas = $aux / 10;
           $auxcent = $winpoints - $decenas*10 - $unidades;
           $centenas = $auxcent / 100;
       
           //puntos actuales antes de actualizar
           $actualpoints = ceil($userplayer->s_point);
           $actualpoints = number_format($actualpoints,0);
           $unidadesdos = $actualpoints % 10;            
           $auxdos = $actualpoints - $unidadesdos;
           $auxdos = $auxdos % 100;
           $decenasdos = $auxdos / 10;
           $auxcentdos = $actualpoints - $decenasdos*10 - $unidadesdos;
           $centenasdos = $auxcentdos / 100;
            
            //activar POPUP subida de nivel
            if ($centenas > $centenasdos) {                
                //subiste de nivel
                $leveluppopup = 1; 
            }else {
                //no ha subido de nivel
                $leveluppopup = 0; 
            }

            //========== Actualizar puntos S, I, G del Usuario en tabla USERS:
            User::where('id', $userauthid)
                        ->update(['s_point' => $winpoints, 'i_point' => $sum_ipoints, 'g_point' => $sum_gpoints]);
            
            //========== Actualizar puntos S de CHALLENGES:
            challenge::where('id', $Challengesplayed->id)
                        ->update(['s_point' => $retospts]);            

            //========  Actualizar insignias del jugador  =======//
            $insignias = Insignia::all();
            $insigniauser = User::find($userauthid);

            //asignar valor en caso de no haber ninguna insignia
            $insigniapopup = 0;
            $insigniawon = '';
            $insignianamewon = '';
            $insigniadescwon = '';
                        
            //obtener y recorrer todas las insignias:
            foreach ($insignias as $insignia) {
                if ($insigniauser->i_point >= $insignia->i_point && $insigniauser->g_point >= $insignia->g_point ) {
                    //verificar existencia de insignias
                    $wininsignia = DB::table('insignia_user')
                                ->where('user_id', '=', $userauthid)
                                ->where('insignia_id', '=', $insignia->id)
                                ->get();

                    //guardar insignia en el insignia_user
                    if ($wininsignia->isEmpty()) {    
                        $insigniauser->insignias()->attach($insignia);
                        //una insignia nueva
                        $insigniapopup = 1;
                        $insigniawon = $insignia->imagen;
                        $insignianamewon = $insignia->name;
                        $insigniadescwon = $insignia->description;

                    }else{
                        $insigniapopup = 0;
                    }
                }
            }

            //========================================================================//
            //====================== Actualizar RECOMPENSAS GIFTS del jugador  ===============//
            $recompensas = Gift::all();
            $recompensauser = User::find($userauthid);
            
            //asignar valor en caso de no haber ninguna insignia
            $recompensapopup = 0;
            $recompensawon = '';
            $recompensanamewon = '';

            //obtener y recorrer todas las recompensas:
            foreach ($recompensas as $recompensa) {
                if ($recompensauser->i_point >= $recompensa->i_point && $recompensauser->g_point >= $recompensa->g_point) {
                    //verificar existencia de recompensas
                    if ($recompensauser->avatar_id == $recompensa->avatar_id) {                       
                        $wininsignia = DB::table('gift_user')->where('user_id', $userauthid)->where('gift_id', $recompensa->id)->get();
                        //guardar insignia en el gift_user
                        if ($wininsignia->isEmpty()) {                        
                            $recompensauser->gifts()->attach($recompensa);
                            //una insignia nueva
                            $recompensapopup = 1;
                            $recompensawon = $recompensa->imagen;
                            $recompensanamewon = $recompensa->name;
                        }else{
                            $recompensapopup = 0;
                        }
                    }
                }
            }
            //====================== Actualizar RECOMPENSAS del jugador  ===============//
            //========================================================================//


            //======= Enviar confirmacion via EMAIL al jefe de area del reto terminado por el usuario        
            //obtener area del usuario   
            $userareas = User::find($userauthid);        
            foreach ($userareas->areas as $userarea) {            
            }
        
            //obtener el jefe del area        
            $jefeareas = DB::table('type_user')->where('id_areas', $userarea->id)->get();  
                        
            //obtener datos del jefe para crear mensaje            
            if (!$jefeareas->isEmpty()) {                
                //obtener puntajes de jefes para cambio de mensaje , segun el area              
                foreach ($jefeareas as $jefe) {
                    $puntajejefes = User::find($jefe->user_id);
                    foreach ($puntajejefes->types as $valtype ) {                        
                        $punajejefeg = $valtype->g_point;
                        $punajejefei = $valtype->i_point;
                        $messagejefe = $valtype->message;
                        $statuson = 1;
                        $statusoff = 0;

                        $tablemessages = DB::table('messages')->where('id_user', $userauthid)->get();                      

                        if ($tablemessages->count() > 0) {
                            foreach ($tablemessages as $messagestatus) {                                
                                if ($sum_ipoints >= $punajejefei && $sum_gpoints >= $punajejefeg && $jefe->user_id != $messagestatus->id_jefe ) {
                                    
                                    //obtener datos del jefe para crear mensaje            
                                    if (!$jefeareas->isEmpty()) {
                                        foreach ($jefeareas as $jefearea) { 
        
                                            //guardar estados en la tabla messages para no repetir mails por usuario
                                            DB::table('messages')->insert([
                                                'id_jefe'     =>    $jefearea->user_id,
                                                'id_user'     =>    $userauthid,
                                                'status'      =>    $statuson,
                                            ]);
        
                                            $datajefe = User::find($jefearea->user_id);
                                            $nombrelider = $datajefe->firstname . " " . $datajefe->lastname;
                                            $nombrejugador = Auth::user()->firstname . " " . Auth::user()->lastname;
                                            $contactlist = $datajefe->email; 
                                
                                            //objeto para enviar datos a la plantilla de correo
                                            $mailobjeto = new \stdClass();            
                                            $mailobjeto->nombrejugador = $nombrejugador;
                                            $mailobjeto->nombrelider = $nombrelider;
                                            $mailobjeto->messagejefe = $messagejefe;
                                            Mail::to($contactlist)->send( new alertaas($mailobjeto) );
                                        }
                                    }                    
                                }
                            }                            
                        } else {                       
                            if ($sum_ipoints >= $punajejefei && $sum_gpoints >= $punajejefeg ) {
                                
                                //obtener datos del jefe para crear mensaje            
                                if (!$jefeareas->isEmpty()) {
                                    foreach ($jefeareas as $jefearea) { 
    
                                        //guardar estados en la tabla messages para no repetir mails por usuario
                                        DB::table('messages')->insert([
                                            'id_jefe'     =>    $jefearea->user_id,
                                            'id_user'     =>    $userauthid,
                                            'status'      =>    $statuson,
                                        ]);
    
                                        $datajefe = User::find($jefearea->user_id);
                                        $nombrelider = $datajefe->firstname . " " . $datajefe->lastname;
                                        $nombrejugador = Auth::user()->firstname . " " . Auth::user()->lastname;
                                        $contactlist = $datajefe->email; 
                            
                                        //objeto para enviar datos a la plantilla de correo
                                        $mailobjeto = new \stdClass();            
                                        $mailobjeto->nombrejugador = $nombrejugador;
                                        $mailobjeto->nombrelider = $nombrelider;
                                        $mailobjeto->messagejefe = $messagejefe;
                                        Mail::to($contactlist)->send( new alertaas($mailobjeto) );
                                    }
                                }                    
                            }
                        }
                     
                    }            
                }
                
            }           
            
            //====================POPUP al terminar ultimo reto del tema:
            //verificar si esta en el ultimo RETO del TEMA al que le pertenece
            $subcapitulo_reto = DB::table('subchapters')
            ->join('challenges', 'subchapters.id', '=', 'challenges.subchapter_id')  
            ->select('subchapter_id', DB::raw('COUNT(subchapter_id) as cantidad_retos_tema') )     
            ->where('subchapters.id', $subchapter_id) 
            ->groupBy('subchapter_id')
            ->first();
            $guar = $subcapitulo_reto->cantidad_retos_tema;
            $subcapitulo_reto = DB::table('subchapters')
            ->join('challenges', 'subchapters.id', '=', 'challenges.subchapter_id')
            ->join('challenge_user', 'challenges.id', '=', 'challenge_user.challenge_id')  
            ->select( DB::raw('COUNT(challenge_user.user_id) as cantidad_retos_terminados'))     
            ->where('subchapters.id', $subchapter_id)
            ->where('challenge_user.user_id', $userauthid) 
            ->first();

            $n = $subcapitulo_reto->cantidad_retos_terminados;

            

            if ($insigniapopup == 0 && $recompensapopup == 0 && $leveluppopup == 0 || $guar == $n) {
                $passretouppopup =  1;
            } else {
                $passretouppopup =  0;
            }


            $pt_s = $retospts;
            return view('player.finishquiz')->with('puntos_s', $pt_s)
                                            ->with('puntos_i', $i_point)
                                            ->with('puntos_g', $g_point)
                                            ->with('retos', $Challengesplayed)
                                            ->with('subcapitulo', $subchapter_id)
                                            ->with('insigniawon', $insigniawon)
                                            ->with('insignianamewon', $insignianamewon)
                                            ->with('insigniadescwon', $insigniadescwon)
                                            ->with('leveluppopup', $leveluppopup)
                                            ->with('insigniapopup', $insigniapopup)
                                            ->with('recompensapopup', $recompensapopup)
                                            ->with('passretouppopup', $passretouppopup)
                                            ->with('recompensawon', $recompensawon)
                                            ->with('recompensanamewon', $recompensanamewon); 
        }else{ 
            //validar reto
            $challenge_quiz_id_01= DB::table('challenge_quiz')
                                ->where('quiz_id', $quiz_selected)
                                ->get();            
            //obtener el reto correspondiente;
            $challengesplayed_01 = Challenge::find($challenge_quiz_id_01[0]->challenge_id); 

            $subchapter_id_01 = $challengesplayed_01->subchapter_id;
            
            return view('player.gamefailed')->with('subcapitulo', $subchapter_id_01);
        }

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
}
