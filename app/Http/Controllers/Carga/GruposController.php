<?php

namespace App\Http\Controllers\Carga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use DB;
use App\PosUsuModel\GruposModel;
use App\Chapter;
use App\PosUsuModel\SubcapUser;
use Illuminate\Support\Facades\Session;

class GruposController extends Controller
{
    public function index(){
        $datos = DB::table('grupos')->select('id as idgro', 'descrip')->get();
        $tot = DB::table('users')
              ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
              ->select(DB::raw('COUNT(users.id_grupo) as total, grupos.descrip, grupos.id'))
              ->groupBy('users.id_grupo', 'grupos.descrip', 'grupos.id')
              ->get();
        return view('grupos.vista')->with('datos', $datos)->with('tot', $tot);
    }

    public function reg(Request $request){
        //validar el nombre repetido
      $val = DB::table('grupos')->where('descrip', 'like', $request->info)->count();
      if($val != 0){
        Session::flash('datreg', 'Este grupo ya se encuentra registrado!');
      }else{
        $category = new GruposModel();
        $category->descrip = $request->input('info');
        $category->save();
      }
      //consultar si ya existen grupos para eliminar
      $datos = DB::table('grupos')->select('id as idgro', 'descrip')->get();
      $tot = DB::table('users')
            ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
            ->select(DB::raw('COUNT(users.id_grupo) as total, grupos.descrip, grupos.id'))
            ->groupBy('users.id_grupo', 'grupos.descrip', 'grupos.id')
            ->get();
      return back()->with('datos', $datos)->with('tot', $tot);
    }

    //Actualizar
    public function actu(Request $request, $id){
        $act = GruposModel::FindOrfail($id);
        $act->descrip = $request->infoacu;
        $act->save();
        return back();
    }

    //eliminar
    public function eliminar($id){
        //validar que el grupo no este vinculado con usuarios
        $contar = DB::table('users')->where('users.id_grupo', '=', $id)->count();
        if($contar!=0){
            Session::flash('datreg', 'El grupo no se puede eliminar porque tiene usuarios vinculados.');
        }else{
            $elim = GruposModel::findOrfail($id);
            $elim->delete();
            Session::flash('datreg', 'Grupo eliminado de manera exitosa!');
        }
        return back();
    }

    //grupo de usuarios
    public function usuarios(){
        $usu = DB::table('users')
               ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
               ->select('users.id as iduser','firstname as nombre', 'lastname as ape', 'username', 'grupos.descrip as grupo')->get();
        //grupos
        $grupos = DB::table('grupos')->select('grupos.id as idgrup', 'descrip')->get();
        return view('grupos.listuser')->with('usu', $usu)->with('grupos', $grupos);
    }

    //vincular usuario a un grupo
    public function vingrupo(Request $request){
        $us = User::FindOrfail($request->nomusu);
        $us ->id_grupo = $request->opcion;
        $us ->save();
        return back();
        
    }

    //agregar grupos a los capitulos a un grupo
    public function vincap($id){
          $cap = DB::table('chapters')->select('id as idcap', 'name', 'title')->get();
          $grup = GruposModel::findOrfail($id);
          //verificar si el capitulo esta agregado
          $verif = SubcapUser::join('users', 'user_id', '=', 'users.id')
                   ->where('users.id_grupo', '=', $id)
                   ->select('chapter_id')
                   ->distinct()
                   ->get();
          //usuarios registrados al capitulo
          $usu = User::where('users.id_grupo', '=', $id)
                ->select('users.id as idusu', 'users.firstname as nombre', 'users.lastname as apellido', 'users.username as usuario')
                ->get();
          $usuchap = SubcapUser::join('users', 'user_id', '=', 'users.id')
                ->where('users.id_grupo', '=', $id)
                ->select('subchapter_user.user_id as idchap')
                ->distinct()
                ->get();

          return  view('grupos.vistacap')->with('cap', $cap)->with('grup', $grup)
                    ->with('verif', $verif)->with('usu', $usu)->with('usuchap', $usuchap);
    }

    //vincular capitulos a los usuarios
    public function vinculocap($id, $id1){
      //$id es el capitulo
      //$id1 es el grupo
      $usuarios = DB::table('users')
                   ->where('id_grupo', '=', $id1)
                   ->select('id as iduser', 'firstname as nombre')
                   ->get();
      $conta = Count($usuarios);
      //capitulos
      $val = DB::table('subchapters')->join('chapters', 'subchapters.chapter_id', '=', 'chapters.id')
             ->where('subchapters.chapter_id', '=', $id)
             ->count();
      //si es mayor a cero agregar capitulos al grupo
      if($val != 0){
          $or = DB::table('chapters')->where('id',$id)->select('order')->get();
          for($i=0; $i<$conta; $i++){
            $ver = SubcapUser::where('chapter_id', $id)->where('user_id', $usuarios[$i]->iduser)->count();
            if($ver != 0){
               Session::flash('grup', 'Este capítulo ya ha sido agregado!');
            }else{
              $category = new SubcapUser();
              $category->order = $or[0]->order; // este debe validarse
              $category->chapter_id = $id;
              $category->subchapter_id = 1;
              $category->user_id = $usuarios[$i]->iduser;
              $category->estado = 0;
              $category->save();
              Session::flash('grup', 'El capítulo se agregó correctamente!');

            }
            
        }
      }else{
          Session::flash('grup', 'El capítulo no tiene subcapitulos!');
      }    
      //falta recorrer el anterior vector y agregarlo a usuarios
      return back();
    }

    //eliminar vinculo de grupo
    public function eliminarvincap($id, $id1){
       //$id es el capitulo
      //$id1 es el grupo
      $usuarios = $ver = SubcapUser::join('users', 'user_id', '=', 'users.id')
                   ->where('users.id_grupo', '=', $id1)
                   ->where('chapter_id', '=', $id)
                   ->select('user_id', 'subchapter_user.id')
                   ->distinct()
                   ->get();
      //eliminarlos
       for($i=0; $i<Count($usuarios); $i++){
           SubcapUser::findOrFail($usuarios[$i]->id)->delete();
       }
       return back();
      
    }
    //buscar usuarios
    public function buscarusu(Request $request){
       $info = DB::table('users')->where('users.email', '=', $request->dato)->get();
       return  response(json_decode($info),200)->header('content-type', 'text/plain');
    }
    //#####################################
    //#####################################
    //buscar usuarios por grupos
    public function  buscargrupo($id){
      
      $val = DB::table('grupos')->where('id', $id)->count();
      if($val != 0){
        $res = DB::table('users')
                ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
                ->where('users.id_grupo', '=', $id)
                ->select('users.id', 'firstname', 'lastname', 'username', 'email', 'level', 's_point', 'i_point', 'g_point', 'grupos.descrip')
                ->orderBy('s_point', 'desc')
                ->get();
      //return $al[0]['capitulo'];  
      }else{
        $res = DB::table('users')
              ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
              ->select('users.id', 'firstname', 'lastname', 'username', 'email', 'level', 's_point', 'i_point', 'g_point', 'grupos.descrip')
              ->orderBy('s_point', 'desc')
              ->get();
      }
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
            for ($r = 0; $r < count($totTareas); $r++) {
                if (isset($buscar[$i][$r]) && $buscar[$i][$r]->chapter_id == $totTareas[$r]->cap) {
                    $sum = $totTareas[$r]->tareas - $buscar[$i][$r]->valor;
                    $item = [
                      'capitulo' => $buscar[$i][$r]->chapter_id,
                      'usuario' => $buscar[$i][$r]->idusu,
                      'tfaltan' => $sum,
                      'ttotal' => $totTareas[$r]->tareas
                  ];
                  $al[] = $item;
                }
            }
            } 
      //#############
      $resultado =[
        'res' => $res,
        'buscar' => $al
      ];
      
      return response()->json($resultado, 200)->header('content-type', 'text/plain');
     // return  response(json_decode($resultado),200)->header('content-type', 'text/plain');
   }
   
   //validar formulario metodo post

   public function valFormu(Request $request){

    $val = DB::table('grupos')->where('id', $request->idfiltro)->count();
    if($val != 0){
      $res = DB::table('users')
              ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
              ->where('users.id_grupo', '=', $request->idfiltro)
              ->select('users.id', 'firstname', 'lastname', 'username', 'email', 'level', 's_point', 'i_point', 'g_point', 'grupos.descrip')
              ->orderBy('s_point', 'desc')
              ->get();
    //return $al[0]['capitulo'];  
    }else{
      $res = DB::table('users')
            ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
            ->select('users.id', 'firstname', 'lastname', 'username', 'email', 'level', 's_point', 'i_point', 'g_point', 'grupos.descrip')
            ->orderBy('s_point', 'desc')
            ->get();
    }
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
    
    //return $grouped[86] ?? 0;
    $grupos = DB::table('grupos')->get();

    return view('admin.reportenuevo')->with('usuarios', $res)->with('grup', $grupos)->with('bus', $al)->with('niveles', $niveles);
   }

}
