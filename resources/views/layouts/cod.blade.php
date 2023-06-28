<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

$usuid = Auth::user()->id;
/*$tTareas = DB::table('challenges')
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
*/
?>
{{$usuid}}