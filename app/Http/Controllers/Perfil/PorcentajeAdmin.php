<?php

namespace App\Http\Controllers\Perfil;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PosUsuModel\GruposModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;//se agrego para correo
use App\Mail\CorreoRecordar;//se agrego email
use DB;

class PorcentajeAdmin extends Controller
{
  
//##########################################
public function totcap($buscar, $tot){
    $num = $tot;
    $chapterCounts = array_fill(1, 10, 0); // Inicializar el array con 10 posiciones desde 1 hasta 10

    foreach ($buscar as $subArray) {
      foreach ($subArray as $item) {
          if (isset($item->chapter_id) && $item->chapter_id >= 1 && $item->chapter_id <= 10) {
              $chapterCounts[$item->chapter_id]++;
          }
      }
    }
      $uniqueChapterIds = [];

          foreach ($buscar as $subArray) {
              foreach ($subArray as $item) {
                  if (isset($item->chapter_id) && !in_array($item->chapter_id, $uniqueChapterIds)) {
                      $uniqueChapterIds[] = $item->chapter_id;
                  }
              }
          }
    
      $result = [];

      foreach ($uniqueChapterIds as $chapterId) {
          if (isset($chapterCounts[$chapterId]) && $chapterId >= 1 && $chapterId <= 10) {
              $result[$chapterId] = $num - $chapterCounts[$chapterId];
          }
      }

      // Ordenar el resultado por clave (capitulo)
        ksort($result);

        // Crear el resultado final con índices "capitulo" y "total"
        $finalResult = [];
        foreach ($result as $capitulo => $total) {
            $finalResult[] = [
                "capitulo" => $capitulo,
                "ceros" => $total,
                'total' => $num
            ];
        }

      return  $finalResult;
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
public function tarporcap($resultadosPorRango1, $des, $ranid, $cantidad){

    $usuariosPorCapitulo = [];

    foreach ($resultadosPorRango1 as $item) {
        $capitulo = $item['capitulo'];
        $usuariosPorCapitulo[$capitulo] = isset($usuariosPorCapitulo[$capitulo]) ? $usuariosPorCapitulo[$capitulo] + $item['usuarios_por_capitulo'] : $item['usuarios_por_capitulo'];
    }
    //rango del 81 al 100
    $usuariosPorCapituloFormatted = [];

        foreach ($usuariosPorCapitulo as $capitulo => $total) {
            $cero = $cantidad - $total;
            $usuariosPorCapituloFormatted[] = [
                'capitulo' => $capitulo,
                'total' => $total,
                'cero'  => $cero,
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
//=================buscar usuarios  ==============
public function usuariosbus($data, $rango){
    $grouped_data = [];
    foreach ($data as $item) {
     $capitulo = $item["capitulo"];
     $idusu = $item["idusu"];
     
     if (!array_key_exists($capitulo, $grouped_data)) {
         $grouped_data[$capitulo] = [];
     }
     
     $grouped_data[$capitulo][] = $idusu;
     }
    
     //buscarlos usuarios que necesita
         $userst = DB::table('users')->get();
            $bloque = [];
            foreach ($grouped_data as $capitulo => $usuarios) {
            foreach ($userst as $user) {
                if (in_array($user->id, $usuarios)) {
                    $bloque[] = [
                        "capitulo" => $capitulo,
                        "usuario" => $user->id,
                        "nombre" => $user->firstname,
                        "apellido" => $user->lastname,
                        "correo" => $user->email,
                        "rango" => $rango
                    ];
                }
            }
        }
     //ordenar la lista de usuarios
   usort($bloque, function($a, $b) {
        return strcmp($a["nombre"], $b["nombre"]);
    });

    return $bloque;
}
//============================================= validar arrays separados
public function valarray($array, $resultados, $c){
    $consul = [];
    $dator = [];
    if(!empty($array)){
        $data1id = array_column($array, 'usuario');
        $resultados_array = json_decode(json_encode($resultados), true);
        $data2id = array_column($resultados_array, 'id');

        $diff = array_diff($data2id, $data1id);
        //reorrer
       
        foreach ($diff as $value) {
           $consul[] = DB::table('users')
                      ->where('id', $value)
                      ->select('id', 'firstname as nom', 'lastname as ape', 'email')
                      ->get();
        }
       //##############################
       $cap = $c; 
       //###Agregar un campo capitulo a la data convertir en array manejable
        $dator = $consul;
        // Convertir objetos a arrays asociativos
        $dator = array_map(function($item) {
            return (array) $item[0];
        }, $dator);

        // Agregar el campo "capitulo" a cada conjunto de datos
        foreach ($dator as &$datoq) {
            $datoq["capitulo"] = $cap;
        }
        unset($datoq); // Liberar la referencia al último elemento
       
       //###########################
    }else{
        $diff = '';
    }
   //ordenar la lista de usuarios
   usort($dator, function($a, $b) {
        return strcmp($a["nom"], $b["nom"]);
    });

   return $dator;
}
//###################################
//============= Unir las variables paramandaruna sola
public function unirvar($u1, $u2, $u3, $u4, $u5, $u6){ // se agrego la variable $u6
    $datosunidos = [];
    foreach([$u1, $u2, $u3, $u4, $u5, $u6] as $datos) {
     foreach ($datos as $item) {
         $cap = $item['capitulo'];
             $datosunidos[] = [
                 'capitulo' => $cap,
                 'usuario' => $item['usuario'],
                 'nombre' =>  $item['nombre'],
                 'apellido' => $item['apellido'],
                 'correo' => $item['correo'],
                 'rango' => $item['rango'],
             ];
         
     }
 }
return $datosunidos;
}
//==================================
 public function filtrar(Request $request){
    $idusu=auth()->id();
    $info = DB::table('grupadmin')
              ->join('grupos', 'grupadmin.idgrupo', '=', 'grupos.id')
              ->where('idusu', $idusu)
              ->select('grupos.id', 'grupos.descrip')
              ->get();
   
    if(count($info) != 0){ //valiar que tenga datos

        if(is_null($request->input('idfiltro'))){
          
            $valselect = $info[0]->id;

        }else{
            $valselect = $request->input('idfiltro');       
        }

     $nomgrupo = GruposModel::findOrFail($valselect);
    //busca los usuarios asociados acada grupo
   
      $res = DB::table('users')
              ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
              ->where('users.id_grupo', '=', $valselect)
              ->where('users.estado', '=', 1)
              ->select('users.id', 'email', 'grupos.id as idgrup', 'grupos.descrip')
              ->orderBy('users.id', 'desc')
              ->get();
      $resultados = $res;
      //return $resultados;
      //#############################3
     //return $resultados;
      //Obtiene el nombre del grupo
      // $nomgrupo = GruposModel::findOrFail($valselect);
      $contar = count($res);
      //return $contar;
    //busca el total de users asociados a cada grupos 
    //foreach ($valselect as $valor2) {
        $res2 = DB::table('users')
                ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
                ->where('users.id_grupo', '=', $valselect)
                ->where('users.estado', '=', 1)
                ->select('grupos.id as idgrupo', 'grupos.descrip', DB::raw('count(users.id) as users_count'))
                ->groupBy('grupos.id', 'grupos.descrip')
                ->orderBy('grupos.id', 'desc')
                ->get();
    
        $totalusergrup = $res2;
   // }
    //return $totalusergrup;
    //buscar las personas con las tareas pendientes y capitulos terminados
    $totTareas = DB::table('challenges')
              ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
              ->selectRaw('subchapters.chapter_id as cap, COUNT(challenges.id) as tareas')
              ->groupBy('subchapters.chapter_id')
              ->get();
    
       if(count($resultados) != 0){
        
        $buscar = []; // Aquí almacenaremos los resultados de la consulta
       
        foreach ($resultados as $res) {
       //   foreach ($nivel1 as $res) {
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
         // }
      }
     
     $totPorCap = $this->totcap($buscar, $contar);

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
        $rango5 = ['min' => 81, 'max' => 99];

        // Inicializar arreglos para almacenar los resultados agrupados por rango de porcentaje
        $resultadosPorRango1 = []; //rango de 1 a 15
        $resultadosPorRango2 = [];
        $resultadosPorRango3 = [];
        $resultadosPorRango4 = [];
        $resultadosPorRango5 = []; //rango de 81 a 100
        $resultadosPorRango6 = []; //si estos valen 100 exactos o mas  

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
               //rango del 81 al 99
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

                //rango mayor al 100 %
                //se agrego este caso 28/08/23
                case $porcentaje >= '100':
                    $resultadosPorRango6[] = [
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

        // return $resultadosPorRango1;
        $var1 = $this->tarporcap($resultadosPorRango1, '1-15', '1', $contar);
        $var2 = $this->tarporcap($resultadosPorRango2, '16-25', '2', $contar);
        $var3 = $this->tarporcap($resultadosPorRango3, '26-50', '3', $contar);
        $var4 = $this->tarporcap($resultadosPorRango4, '51-80', '4', $contar);
        $var5 = $this->tarporcap($resultadosPorRango5, '81-99', '5', $contar);
        $var6 = $this->tarporcap($resultadosPorRango6, '100', '6', $contar);  //se agrego este caso 28/08/23
       //return $var1;
       
        //================consultar los usuarios asociados ==============
        $u1 =  $this->usuariosbus($resultadosPorRango1, 1);
        $u2 =  $this->usuariosbus($resultadosPorRango2, 2);
        $u3 =  $this->usuariosbus($resultadosPorRango3, 3);
        $u4 =  $this->usuariosbus($resultadosPorRango4, 4);
        $u5 =  $this->usuariosbus($resultadosPorRango5, 5);
        $u6 =  $this->usuariosbus($resultadosPorRango6, 6);   //se agrego este caso 28/08/23
      
       //##############################################
      
       $reporusu = $this->unirvar($u1, $u2, $u3, $u4, $u5, $u6);  //se agrego este caso 28/08/23

        //return $reporusu;
       // return $groupedData;
      // return $resultados;
       $groupedData1 = [];
       $groupedData2 = [];
       $groupedData3 = [];
       $groupedData4 = [];
       $groupedData5 = [];
       $groupedData6 = [];

            foreach ($reporusu as $entry) {
                $capitulo = $entry['capitulo'];
               
                switch (true) {
                    case $capitulo === 1:
                        $groupedData1[] = $entry;
                        break;

                    case $capitulo === 2:
                        $groupedData2[] = $entry;
                        break;

                    case $capitulo === 3:
                        $groupedData3[] = $entry;
                        break;
                    
                    case $capitulo === 4:
                         $groupedData4[] = $entry;
                        break;

                    case $capitulo === 5:
                        $groupedData5[] = $entry;
                        break;

                    case $capitulo == 6:
                        $groupedData6[] = $entry;
                        break;
                }
                
            }
        
        //#############################
        $c1 =  $this->valarray($groupedData1, $resultados, 1);
        $c2 =  $this->valarray($groupedData2, $resultados, 2);
        $c3 =  $this->valarray($groupedData3, $resultados, 3);
        $c4 =  $this->valarray($groupedData4, $resultados, 4);
        $c5 =  $this->valarray($groupedData5, $resultados, 5);
        $c6 =  $this->valarray($groupedData6, $resultados, 6);
        
       // return $c2;

       // Unir todos los arreglos en uno solo, estees para saber las personas que no han comenzado su curso
       $datacompleta = array_merge($c1, $c2, $c3, $c4, $c5, $c6);
      //###################################################
        }else{
            $var1 = $var2 = $var3 = $var4 = $var5 = $var6 = "";
            $nomgrupo = $totPorCap = $contar = $reporusu = $resultados = $datacompleta = "";
        }
     //  return $datacompleta;
      return view('admingrupos.vistaporcentaje',  compact('info', 'var1', 'var2', 'var3', 'var4', 'var5', 'var6', 'nomgrupo', 'totPorCap', 'contar', 'reporusu', 'resultados', 'datacompleta'));
    }

    //###################################################
    public function correos(Request $request, $rango){
        $correos = $request->input('correos'); // Obtener el array de correos desde la solicitud POST
       
        //############# validar el rango
       foreach($correos as $vc){
        switch ($vc['rango']) {
            case 1:
                 $ran = "1-15%";
                break;
            case 2:
                $ran = "16-25%";
                break;
            case 3:
                $ran = "26-50%";
                break;
            case 4:
                $ran = "51-80%";
                break;
            case 5:
                $ran = "81-99%";
                break;
            case 6:
                $ran = "100%";
                break;
            case 7:
                $ran = "0%";
                break;
            default:
                $ran = " ";
        }     
     }   

       foreach ($correos as $correo) {
       
        Mail::to($correo['email'])->send(new CorreoRecordar($correo['nom'], $ran, $correo['cap']));
       }

       // Mail::to($correos['email'])->send(new CorreoRecordar($correos['nom']));
            // Lógica para enviar correos usando el array de correos
            return response()->json(['message' => 'Correos enviados correctamente.']);
    }

    //============ index inicial =============
      
    public function porcentaje()
    {
        $idusu = auth()->id();
        $info = DB::table('grupadmin')
                  ->join('grupos', 'grupadmin.idgrupo', '=', 'grupos.id')
                  ->where('idusu', $idusu)
                  ->select('grupos.id', 'grupos.descrip')
                  ->get();
        $request = new Request();
        $parametro = "";
        //return $info;
        $consulta = $this->filtrar($request, $parametro);
        return $consulta;
        //return view('admingrupos.vistaporcentaje')->with('info', $info);
    }

    //============ end index ============

}
