<?php

namespace App\Http\Controllers\Perfil;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\User;
use App\Challenge;
use Auth;
use DB;


class Administrador extends Controller
{
    public function index(){
        return view('admingrupos.adminmenu');
       }

    //=================vista principal de reportes===================

    public function resultado()
    {
        $idusu=auth()->id();
        $grupoAdmin = DB::table('grupadmin')->where('idusu', $idusu)->select('idgrupo')->get();

        /*Aqui se agrego los users */
        if(count($grupoAdmin) != 0){ //validar si hay usuarios
        foreach($grupoAdmin as $ga){
           $res[] = DB::table('users')
                  ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
                  ->where('users.id_grupo', $ga->idgrupo)
                  ->select('users.id', 'firstname', 'lastname', 'username', 'email', 'level', 's_point', 'i_point', 'g_point', 'grupos.descrip', 'estado')
                  ->orderBy('s_point', 'desc')
                  ->get();
        }
        //buscar las personas con las tareas pendientes y capitulos terminados
           
          $totTareas = DB::table('challenges')
                    ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                    ->selectRaw('subchapters.chapter_id as cap, COUNT(challenges.id) as tareas')
                    ->groupBy('subchapters.chapter_id')
                    ->get();
      
             foreach($res as $narray){
                foreach($narray as $obj){
                    $buscar[] = DB::table('challenge_user')
                          ->join('challenges', 'challenge_user.challenge_id', '=', 'challenges.id')
                          ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                          ->where('challenge_user.user_id', $obj->id)
                          ->selectRaw('COUNT(challenge_user.challenge_id) as valor, challenge_user.user_id as idusu, subchapters.chapter_id')
                          ->groupBy('challenge_user.user_id', 'subchapters.chapter_id')
                          ->get(); 
                   }
                  }
              
                //return $buscar[$i][$i]->chapter_id;
                $al = [];
                for ($i = 0; $i < count($buscar); $i++) {
                $conta = 0;
                for ($r = 0; $r < count($totTareas); $r++) {
                    if (isset($buscar[$i][$r]) && $buscar[$i][$r]->chapter_id == $totTareas[$r]->cap) {
                        $sum = $totTareas[$r]->tareas - $buscar[$i][$r]->valor;
                        $conta = $conta+1;
                        $item = [
                          'usuario' => $buscar[$i][$r]->idusu,
                          'capitulo' => $buscar[$i][$r]->chapter_id,
                          'tcom' => $buscar[$i][$r]->valor,
                          'tfaltan' => $sum,
                          'ttotal' => $totTareas[$r]->tareas,
                          'nivel' => $conta
                      ];
                      $al[] = $item;
                    }
                }
            }
          
          //#############
          $niveles = collect($al)->groupBy('usuario')->map(function ($items) {
            return count($items);
          });//este me da los niveles 
        /*finaliza */
        }else{
            $al[] = "";
            $niveles = "";
            $res[] = "";
        } //cierre del if de validacion

        $grupos = DB::table('grupadmin')
                  ->join('grupos', 'grupadmin.idgrupo', '=', 'grupos.id')
                  ->where('idusu', $idusu)
                  ->select('grupos.id', 'grupos.descrip')
                  ->get();
       
       // return $res;
        return view('admingrupos.reportegeneral')->with('resultado', $res)->with('grup', $grupos)->with('bus', $al)->with('niveles', $niveles);
    }

    //==============vistade busqueda ================
     //buscar usuario por grupos
  public function consultarter(Request $request){
            $cadena = $request->dato;
            $idusu = auth()->id();
            $grupos = DB::table('grupadmin')
                        ->join('grupos', 'grupadmin.idgrupo', '=', 'grupos.id')
                        ->where('idusu', $idusu)
                        ->select('grupos.id', 'grupos.descrip')
                        ->get();
        
                if (str_contains($cadena, "@")) {
                
                $buscar = DB::table('users')
                        ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
                        ->where('users.email', '=', $cadena)
                        ->select('users.id', 'firstname', 'lastname', 'username', 'email', 'level', 's_point', 'i_point', 'g_point', 'grupos.descrip', 'estado')
                        ->orderBy('s_point', 'desc')
                        ->get();
                } else {
                    $buscar = DB::table('users')
                            ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
                            ->where('users.firstname', 'like', '%' . $cadena . '%')
                            ->orWhere('users.lastname', 'like', '%' . $cadena . '%')
                            ->select('users.id', 'firstname', 'lastname', 'username', 'email', 'level', 's_point', 'i_point', 'g_point', 'grupos.descrip', 'estado')
                            ->orderBy('s_point', 'desc')
                            ->get();
                }
            
        
            if(count($buscar) != 0){
            $tTareas = DB::table('challenges')
                        ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                        ->selectRaw('subchapters.chapter_id as cap, COUNT(challenges.id) as tareas')
                        ->groupBy('subchapters.chapter_id')
                        ->get();
            //aqui calcula si ha hecho alguna tarea
            $tareasuser = DB::table('challenge_user')
                                ->join('challenges', 'challenge_user.challenge_id', '=', 'challenges.id')
                                ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                                ->where('challenge_user.user_id', $buscar[0]->id)
                                ->selectRaw('challenge_user.user_id as idusu, subchapters.chapter_id, COUNT(challenge_user.challenge_id) as valor')
                                ->groupBy('challenge_user.user_id', 'subchapters.chapter_id')
                                ->get(); 
            if(isset($tareasuser) && count($tareasuser) == 0){
                $buscar = [];
                $al = [];
                $niveles =[];
            }else{
                //##########################################
                foreach($tTareas as $t1){
                $conta = 0;
                foreach($tareasuser as $t2){
                    if($t1->cap == $t2->chapter_id){
                    $sum = $t1->tareas - $t2->valor;
                    $conta = $conta+1;
                    $item = [
                        'usuario' => $t2->idusu,
                        'capitulo' => $t2->chapter_id,
                        'tcom' => $t2->valor,
                        'tfaltan' => $sum,
                        'ttotal' => $t1->tareas,
                        'nivel' => $conta
                    ];
                    $al[] = $item;
                    }
                }
                }
                $niveles = collect($al)->groupBy('usuario')->map(function ($items) {
                return count($items);
                });//este me da los niveles 
                //##########################################
            }
            //########################
             
            return view('admingrupos.reportegeneral')->with('usuarios', $buscar)->with('grup', $grupos)->with('bus', $al)->with('niveles', $niveles);
            
            }else{
                $buscar = [];
                $al = [];
                $niveles =[];
            return view('admingrupos.reportegeneral')->with('usuarios', $buscar)->with('grup', $grupos)->with('bus', $al)->with('niveles', $niveles);
            }
            
        }
    //===========end vista buequeda =============
    //========== vista detalle ==========
    public function detalle($id)
    {
        
        $retosuser = User::find($id);        
        return view('admingrupos.detalle')
                        ->with('retos', $retosuser->challenges)
                        ->with('usuarioreto', $id);                        
    }
    //======================================== vista detallada de cada juego =====
    public function masdet(Request $request)
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
                                'challenge_user.i_point as I_ganados',
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
      
        return view('admingrupos.reportmoreinfo')
                        ->with('retos', $retosuser)
                        ->with('idusuario', $idusuario)
                        ->with('infocomplete', $infocomplete)
                        ->with('infoout', $infoout)
                        ->with('infolectura', $infolectura)
                        ->with('infopicture', $infopicture)
                        ->with('quizs', $quizs);
                
    }

    //=========================== filtros ==============
    public function filtrarFormu(Request $request){

        $idusu=auth()->id();
    
        $valselect = $request->input('idfiltro');
    
        $resultados = [];
    
        foreach ($valselect as $valor) {
          $res = DB::table('users')
                  ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
                  ->where('users.id_grupo', '=', $valor)
                  ->select('users.id', 'firstname', 'lastname', 'username', 'email', 'level', 's_point', 'i_point', 'g_point', 'grupos.descrip', 'estado')
                  ->orderBy('s_point', 'desc')
                  ->get();
          $resultados[] = $res;
        }
        //return $al[0]['capitulo'];
        //buscar las personas con las tareas pendientes y capitulos terminados
        $totTareas = DB::table('challenges')
                  ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                  ->selectRaw('subchapters.chapter_id as cap, COUNT(challenges.id) as tareas')
                  ->groupBy('subchapters.chapter_id')
                  ->get();
           if(count($resultados) != 0){
            
            $buscar = []; // Aquí almacenaremos los resultados de la consulta
           
            foreach ($resultados as $nivel1) {
              foreach ($nivel1 as $res) {
                  $user_id = $res->id;
                  // y así sucesivamente para cada propiedad que necesites utilizar
                  $resultadoConsulta = DB::table('challenge_user')
                                    ->join('challenges', 'challenge_user.challenge_id', '=', 'challenges.id')
                                    ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                                    ->where('challenge_user.user_id', $user_id) // Accedemos a la propiedad "idusu" en lugar de "id"
                                    ->selectRaw('COUNT(challenge_user.challenge_id) as valor, challenge_user.user_id as idusu, subchapters.chapter_id')
                                    ->groupBy('challenge_user.user_id', 'subchapters.chapter_id')
                                    ->get();
                  // Aquí puedes realizar las operaciones que necesites con los datos obtenidos
                  $buscar[] = $resultadoConsulta;
              }
          }
    
          //return $buscar;
              //return $buscar[$i][$i]->chapter_id;
              $al = [];
              for ($i = 0; $i < count($buscar); $i++) {
              $conta = 0;
              for ($r = 0; $r < count($totTareas); $r++) {
                  if (isset($buscar[$i][$r]) && $buscar[$i][$r]->chapter_id == $totTareas[$r]->cap) {
                      $sum = $totTareas[$r]->tareas - $buscar[$i][$r]->valor;
                      $conta = $conta+1;
                      $item = [
                        'usuario' => $buscar[$i][$r]->idusu,
                        'capitulo' => $buscar[$i][$r]->chapter_id,
                        'tcom' => $buscar[$i][$r]->valor,
                        'tfaltan' => $sum,
                        'ttotal' => $totTareas[$r]->tareas,
                        'nivel' => $conta
                    ];
                    $al[] = $item;
                  }
              }
              } 
          //return $al;
        //#############
        $niveles = collect($al)->groupBy('usuario')->map(function ($items) {
          return count($items);
        });//este me da los niveles 
        }else{
          $al = [];
          $niveles = [];
        }
    
        //return $grouped[86] ?? 0;
        $grupos = DB::table('grupadmin')
                ->join('grupos', 'grupadmin.idgrupo', '=', 'grupos.id')
                ->where('idusu', $idusu)
                ->select('grupos.id', 'grupos.descrip')
                ->get();

    
        return view('admingrupos.reportegeneral')->with('resultado', $resultados)->with('grup', $grupos)->with('bus', $al)->with('niveles', $niveles);
       }
    //========================================
}