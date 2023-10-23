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

        /*Aqui se agrego los users */
        $res = DB::table('users')
                  ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
                  ->select('users.id', 'firstname', 'lastname', 'username', 'email', 'level', 's_point', 'i_point', 'g_point', 'grupos.descrip', 'estado')
                  ->orderBy('s_point', 'desc')
                  ->get();
          //buscar las personas con las tareas pendientes y capitulos terminados
           
          $totTareas = DB::table('challenges')
                    ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                    ->selectRaw('subchapters.chapter_id as cap, COUNT(challenges.id) as tareas')
                    ->groupBy('subchapters.chapter_id')
                    ->get();
      
             for ($x = 0; $x < count($res); $x++) {
                    $buscar[] = DB::table('challenge_user')
                          ->join('challenges', 'challenge_user.challenge_id', '=', 'challenges.id')
                          ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                          ->where('challenge_user.user_id', $res[$x]->id)
                          ->selectRaw('COUNT(challenge_user.challenge_id) as valor, challenge_user.user_id as idusu, subchapters.chapter_id')
                          ->groupBy('challenge_user.user_id', 'subchapters.chapter_id')
                          ->get(); 
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
        $grupos = DB::table('grupos')->get();

       // return $res;
        return view('admingrupos.reportegeneral')->with('usuarios', $res)->with('grup', $grupos)->with('bus', $al)->with('niveles', $niveles);
    }

    //==============vistade busqueda ================
     //buscar usuario por grupos
  public function consultarter(Request $request){
            $cadena = $request->dato;
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
            $grupos = DB::table('grupos')->get();
            return view('admingrupos.reportegeneral')->with('usuarios', $buscar)->with('grup', $grupos)->with('bus', $al)->with('niveles', $niveles);
            
            }else{
            $grupos = DB::table('grupos')->get();
            $buscar = [];
            $al = [];
            $niveles =[];
            return view('admingrupos.reportegeneral')->with('usuarios', $buscar)->with('grup', $grupos)->with('bus', $al)->with('niveles', $niveles);
            }
            
        }
    //===========end vista buequeda =============
}