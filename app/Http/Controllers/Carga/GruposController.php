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
        //buscar grupos
        $ngrupo = DB::table('subchapter_user')
                ->join('users', 'subchapter_user.user_id', '=', 'users.id')
                ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
                ->select('grupos.id as idgrup', 'grupos.descrip')
                ->addSelect(DB::raw('GROUP_CONCAT(DISTINCT subchapter_user.chapter_id) as chapter_ids'))
                ->groupBy('grupos.id', 'grupos.descrip')
                ->get();
        //return $ngrupo;
        // Procesar los resultados para obtener los chapter_id únicos por grupo
      
        return view('grupos.vista')->with('datos', $datos)->with('tot', $tot)->with('ngrupo', $ngrupo);
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
        $gr = $request->opcion;
        $us = User::FindOrfail($request->nomusu);
        //##############################
        if ($us->id_grupo == $gr){
            $us->id_grupo = $gr;
        }else{
          $id = $us->id;
          SubcapUser::where('user_id', $id)->delete();
          //validar que el grupo nuevo ya tenga capitulos asignados
          $capitulos = DB::table('subchapter_user')
                      ->join('users', 'subchapter_user.user_id', '=', 'users.id')
                      ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
                      ->select('grupos.id as idgrup', 'grupos.descrip', 'subchapter_user.chapter_id')
                      ->where('grupos.id', $gr)
                      ->distinct('chapter_id')
                      ->get();
          if(!empty($capitulos)){
              foreach($capitulos as $c){
                      $AddCap = new SubcapUser();
                      $AddCap->order = $c->chapter_id; // este es el capitulo
                      $AddCap->chapter_id = $c->chapter_id;
                      $AddCap->subchapter_id = 1;
                      $AddCap->user_id = $id;
                      $AddCap->estado = 0;
                      $AddCap ->save();
                }
              }
              $us->id_grupo = $gr;
          
         }
        //############################
        $us ->save();
        //##############################################

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
       $info =  DB::table('users')
                ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
                ->select('users.id', 'firstname', 'lastname', 
                'username', 'email', 'level', 's_point', 'i_point', 'g_point',
                 'grupos.descrip', 'users.created_at', 'users.estado')
                ->where('users.email', '=', $request->dato)
                ->orderBy('s_point', 'desc')
                ->get();
     /*$totTareas = DB::table('challenges')
                ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                ->selectRaw('subchapters.chapter_id as cap, COUNT(challenges.id) as tareas')
                ->groupBy('subchapters.chapter_id')
                ->get();
      
      $buscar = DB::table('challenge_user')
                ->join('challenges', 'challenge_user.challenge_id', '=', 'challenges.id')
                ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                ->where('challenge_user.user_id', $info[0]->id)
                ->selectRaw('COUNT(challenge_user.challenge_id) as valor, challenge_user.user_id as idusu, subchapters.chapter_id')
                ->groupBy('challenge_user.user_id', 'subchapters.chapter_id')
                ->get(); */

       /*
          $conta = 0;
          for ($r = 0; $r < count($totTareas); $r++) {
              if (isset($buscar[$r]) && $buscar[$r]->chapter_id == $totTareas[$r]->cap) {
                  $sum = $totTareas[$r]->tareas - $buscar[$r]->valor;
                  $conta = $conta+1;
                  $item = [
                    'usuario' => $buscar[$r]->idusu,
                    'capitulo' => $buscar[$r]->chapter_id,
                    'tcom' => $buscar[$r]->valor,
                    'tfaltan' => $sum,
                    'ttotal' => $totTareas[$r]->tareas,
                    'nivel' => $conta
                ];
                $al= $item;
              }
          }*/
           

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
    $grupos = DB::table('grupos')->get();

    return view('admin.reportcompletos')->with('resultado', $resultados)->with('grup', $grupos)->with('bus', $al)->with('niveles', $niveles);
   }

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
      return view('admin.reportcompletos')->with('usuarios', $buscar)->with('grup', $grupos)->with('bus', $al)->with('niveles', $niveles);
    
    }else{
      $grupos = DB::table('grupos')->get();
      $buscar = [];
      $al = [];
      $niveles =[];
      return view('admin.reportcompletos')->with('usuarios', $buscar)->with('grup', $grupos)->with('bus', $al)->with('niveles', $niveles);
    }
    
  }

  //buscar usuario
  public function buscarcor(Request $request){
    $contar = DB::table('users')->where('users.email', $request->correo)->count();
    if($contar != 0){
      
      $usu = DB::table('users')
            ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
            ->where('users.email', $request->correo)
            ->select('users.id as iduser','firstname as nombre', 'lastname as ape', 'username',
                      'grupos.descrip as grupo')
            ->get();
        Session::flash('datreg', 'Usuario encontrado!');
    }else{
      $usu = DB::table('users')
            ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
            ->select('users.id as iduser','firstname as nombre', 'lastname as ape', 'username',
                      'grupos.descrip as grupo')
            ->get();
       Session::flash('datreg', 'El usuario no se encuentra registrado!');
    }
    
    //grupos
    $grupos = DB::table('grupos')->select('grupos.id as idgrup', 'descrip')->get();
    return view('grupos.listuser')->with('usu', $usu)->with('grupos', $grupos);
  }
  //end buscar
  //#################################### desactivarel grupo
   public function activargrupo($id){
      $grup = GruposModel::findOrfail($id);
      if($grup->estado_grup == 1){
       $grup->estado_grup = 0;
        $usu = User::where('id_grupo', $id)->get();
          foreach ($usu as $user) {
            $user->estado = 0;
            $user->save();
        }
        Session::flash('grup', 'El grupo ha sido desactivado');
      }else{
        $grup->estado_grup = 1;
        $usu = User::where('id_grupo', $id)->get();
        foreach ($usu as $user) {
          $user->estado = 1;
          $user->save();
      }
        Session::flash('grup', 'Grupo activado exitosamente!');
      }
        $grup->save();
        return back();
   }
  //##################
}
