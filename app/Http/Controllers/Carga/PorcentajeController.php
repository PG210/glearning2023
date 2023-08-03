<?php

namespace App\Http\Controllers\Carga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PosUsuModel\GruposModel;
use Illuminate\Support\Facades\Session;
use DB;

class PorcentajeController extends Controller
{
    public function index()
    {
        $info = GruposModel::all();
        return view('admin.vistaporcentaje')->with('info', $info);
    }

//#######################################
public function tareas($id){
  $totTareas = DB::table('challenges')
              ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
              ->where('subchapters.chapter_id', $id)
              ->selectRaw('subchapters.chapter_id as cap, COUNT(challenges.id) as tareas')
              ->groupBy('subchapters.chapter_id')
              ->first();
    return $totTareas;
} 
//#################################3
//################################## validar diferentes capitulos por cadarango
public function tarporcap($resultadosPorRango1, $des, $ranid){

    $usuariosPorCapitulo = [];

    foreach ($resultadosPorRango1 as $item) {
        $capitulo = $item['capitulo'];
        $usuariosPorCapitulo[$capitulo] = isset($usuariosPorCapitulo[$capitulo]) ? $usuariosPorCapitulo[$capitulo] + $item['usuarios_por_capitulo'] : $item['usuarios_por_capitulo'];
    }
    //rango del 81 al 100
    $usuariosPorCapituloFormatted = [];

        foreach ($usuariosPorCapitulo as $capitulo => $total) {
            $usuariosPorCapituloFormatted[] = [
                'capitulo' => $capitulo,
                'total' => $total,
                'ranid' => $ranid,
                'rango' => $des
                
            ];
        }
  return $usuariosPorCapituloFormatted;

}
//#######################
public function eval($data){
    $conta = 0;
    $grup = '';
    $cap = '';

    foreach ($data as $r) {
        if ($r['capitulo'] >=1 && $r['capitulo'] <= 10) {
            $grup = $r['nomgrup'];
            $cap = $r['capitulo'];
            $conta = $conta + 1;
        }
    }

    $res = [
        'grupo' => $grup,
        'capitulo' => $cap,
        'conta' => $conta,
    ];

    return $res;
}
//###################################
 public function filtrar(Request $request){
    $valselect = $request->input('idfiltro');

    $resultados = [];

    //busca los usuarios asociados acada grupo
    foreach ($valselect as $valor) {
      $res = DB::table('users')
              ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
              ->where('users.id_grupo', '=', $valor)
              ->select('users.id', 'email', 'grupos.id as idgrup', 'grupos.descrip')
              ->orderBy('users.id', 'desc')
              ->get();
      $resultados[] = $res;
    }
    //busca el total de users asociados a cada grupos 
    foreach ($valselect as $valor2) {
        $res2 = DB::table('users')
                ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
                ->where('users.id_grupo', '=', $valor2)
                ->select('grupos.id as idgrupo', 'grupos.descrip', DB::raw('count(users.id) as users_count'))
                ->groupBy('grupos.id', 'grupos.descrip')
                ->orderBy('grupos.id', 'desc')
                ->get();
    
        $totalusergrup[] = $res2;
    }
    
   // return $totalusergrup;
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
                                ->join('users', 'challenge_user.user_id', '=', 'users.id')
                                ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
                                ->where('challenge_user.user_id', $user_id) // Accedemos a la propiedad "idusu" en lugar de "id"
                                ->selectRaw('COUNT(challenge_user.challenge_id) as valor, challenge_user.user_id as idusu, users.id_grupo, grupos.descrip, subchapters.chapter_id')
                                ->groupBy('challenge_user.user_id', 'subchapters.chapter_id', 'users.id_grupo', 'grupos.descrip')
                                ->get();
              // Aquí puedes realizar las operaciones que necesites con los datos obtenidos
              $buscar[] = $resultadoConsulta;
          }
      }
      
      //return $buscar;
      //return $totTareas;
          //return $buscar[$i][$i]->chapter_id;
          $al = [];

          for ($i = 0; $i < count($buscar); $i++) {
              for ($j = 0; $j < count($buscar[$i]); $j++) {
                  $conta = 0;
          
                  if (isset($buscar[$i][$j])) {
                      // Recorrer los chapter_id de 1 a 10
                      for ($chapter = 1; $chapter <= 10; $chapter++) {
                          if ($buscar[$i][$j]->chapter_id == $chapter) {
                              $evaluar = $this->tareas($chapter);
                              $sum = $evaluar->tareas - $buscar[$i][$j]->valor;
                              $t = $buscar[$i][$j]->valor;
                              $total = $evaluar->tareas;
                              $conta = $conta + 1;
          
                              $item = [
                                  'usuario' => $buscar[$i][$j]->idusu,
                                  'grupo' => $buscar[$i][$j]->id_grupo,
                                  'nomgrup' => $buscar[$i][$j]->descrip,
                                  'capitulo' => $buscar[$i][$j]->chapter_id,
                                  'tcom' => $t,
                                  'tfaltan' => $sum,
                                  'ttotal' => $total,
                                  'nivel' => $conta,
                                  'porcentaje' => floor(($t * 100) / $total)
                              ];
          
                              $al[] = $item;
                          }
                      }
                  }
              }
          }
    //#############
    }else{
      $al = [];
     
    }
      //aqui se debe validar los porcentajes por capitulos
     /* foreach($al as $re){
        return $al[0]['usuario'];
      }*/
      //####################################################
        // Inicializar un arreglo para almacenar los resultados agrupados
        $resultadosAgrupados = [];

        // Definir los rangos de porcentajes
        $rango1 = ['min' => 1, 'max' => 15];
        $rango2 = ['min' => 16, 'max' => 25];
        $rango3 = ['min' => 26, 'max' => 50];
        $rango4 = ['min' => 51, 'max' => 80];
        $rango5 = ['min' => 81, 'max' => 100];

        // Inicializar arreglos para almacenar los resultados agrupados por rango de porcentaje
        $resultadosPorRango1 = []; //rango de 1 a 15
        $resultadosPorRango2 = [];
        $resultadosPorRango3 = [];
        $resultadosPorRango4 = [];
        $resultadosPorRango5 = []; //rango de 81 a 100

        // Agrupar los datos por el rango de porcentaje correspondiente
        foreach ($al as $item) {
            $grupo = $item['grupo'];
            $nomgrup = $item['nomgrup'];
            $capitulo = $item['capitulo'];
            $porcentaje = $item['porcentaje'];
            //rango del 1 al 15
            switch (true) {
                case $porcentaje >= $rango1['min'] && $porcentaje <= $rango1['max']:
                    $resultadosPorRango1[] = [
                        'grupo' => $grupo,
                        'nomgrup' => $nomgrup,
                        'capitulo' => $capitulo,
                        'usuarios_por_capitulo' => 1,
                        'idusu' => $item['usuario'],
                        'tcom' => $item['tcom'],
                        'tfaltan' => $item['tfaltan'],
                        'ttotal' => $item['ttotal'],
                        'nivel' => $item['nivel'],
                        'porcentaje' => $porcentaje,
                    ];
                    break;
                //rango del 16 al 25
                 case $porcentaje >= $rango2['min'] && $porcentaje <= $rango2['max']:
                        $resultadosPorRango2[] = [
                            'grupo' => $grupo,
                            'nomgrup' => $nomgrup,
                            'capitulo' => $capitulo,
                            'usuarios_por_capitulo' => 1,
                            'idusu' => $item['usuario'],
                            'tcom' => $item['tcom'],
                            'tfaltan' => $item['tfaltan'],
                            'ttotal' => $item['ttotal'],
                            'nivel' => $item['nivel'],
                            'porcentaje' => $porcentaje,
                        ];
                        break;
                 //rango del 26 al 50
                 case $porcentaje >= $rango3['min'] && $porcentaje <= $rango3['max']:
                    $resultadosPorRango3[] = [
                        'grupo' => $grupo,
                        'nomgrup' => $nomgrup,
                        'capitulo' => $capitulo,
                        'usuarios_por_capitulo' => 1,
                        'idusu' => $item['usuario'],
                        'tcom' => $item['tcom'],
                        'tfaltan' => $item['tfaltan'],
                        'ttotal' => $item['ttotal'],
                        'nivel' => $item['nivel'],
                        'porcentaje' => $porcentaje,
                    ];
                    break;
                //rango del 51 al 80
                case $porcentaje >= $rango4['min'] && $porcentaje <= $rango4['max']:
                    $resultadosPorRango3[] = [
                        'grupo' => $grupo,
                        'nomgrup' => $nomgrup,
                        'capitulo' => $capitulo,
                        'usuarios_por_capitulo' => 1,
                        'idusu' => $item['usuario'],
                        'tcom' => $item['tcom'],
                        'tfaltan' => $item['tfaltan'],
                        'ttotal' => $item['ttotal'],
                        'nivel' => $item['nivel'],
                        'porcentaje' => $porcentaje,
                    ];
                    break;
               //rango del 81 al 100
                case $porcentaje >= $rango5['min'] && $porcentaje <= $rango5['max']:
                    $resultadosPorRango5[] = [
                        'grupo' => $grupo,
                        'nomgrup' => $nomgrup,
                        'capitulo' => $capitulo,
                        'usuarios_por_capitulo' => 1,
                        'idusu' => $item['usuario'],
                        'tcom' => $item['tcom'],
                        'tfaltan' => $item['tfaltan'],
                        'ttotal' => $item['ttotal'],
                        'nivel' => $item['nivel'],
                        'porcentaje' => $porcentaje,
                    ];
                    break;
            }
          
        }

        //return  $resultadosPorRango1; 
            //return  $resultadosPorRango2;
            //return $resultadosPorRango5; //rango del 81 al 100
        //return $resultadosAgrupados

        $var1 = $this->tarporcap($resultadosPorRango1, '1-15', '1');
        $var2 = $this->tarporcap($resultadosPorRango2, '16-25', '2');
        $var3 = $this->tarporcap($resultadosPorRango3, '26-50', '3');
        $var4 = $this->tarporcap($resultadosPorRango4, '51-80', '4');
        $var5 = $this->tarporcap($resultadosPorRango5, '81-100', '5');
      
       
       
       // return $var1;
        // Ahora tienes un arreglo $capitulosData reorganizado por capítulo y rangos, con la información del capítulo
        
        
        //return $capitulosData;
        // Ahora tienes un arreglo $capitulosData reorganizado por capítulo y rangos

      //###################################################
      $info = GruposModel::all();
      return view('admin.vistaporcentaje',  compact('info', 'var1', 'var2', 'var3', 'var4', 'var5'));
    }

}
