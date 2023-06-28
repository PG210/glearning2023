@extends('layouts.app')


@section('content')

</section>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


  <!-- Content Header (Page header) -->

      
<section class="content-header">
</section>

<!-- Main content -->
<section class="content container-fluid flex">


  @php
    $userauth_id = Auth::user()->id;
    $capitulosprocedural = DB::select("call chapterSecuence($userauth_id)");
    
    // foreach ($capitulosprocedural as $capitulo) {
    //   if ($capitulo->RETOS_CAPITULO_REQUERIDO != 0) {
    //     $id_capitulox = $capitulo->id;
    //   }
    // }
      
    
  @endphp

{{-- encontrar el ultimo que debe jugar actualmente el jugador --}}
  @foreach($capitulosprocedural as $capitulo)
    @if ($capitulo->RETOS_CAPITULO_REQUERIDO != 0)    
      @if ($loop->last)
          
        <input type="hidden" name="{{$variablex = $capitulo->id}}">
        
      @endif            
    @endif
  @endforeach
  
  @php
  // encontrar la competencia qu el pertenece al subcapitulo del capitulo actua
  $competancia = DB::table('subchapters')
                        ->where('chapter_id', $variablex)
                        ->first();

  $competence_active = DB::table('competences') 
                      ->where('id', $competancia->competence_id)
                      ->first();

                        

  @endphp

  <?php
    $userauth = Auth::user()->id;
    $chapters = DB::table('chapters')->get();
    $usersinsignia = App\User::find($userauth);

    $retos = DB::table('challenge_user')->where('user_id', $userauth)->orderBy('start', 'desc')->first();

    if ($retos == null) {
      $reto = "";
      $ultimoreto = "Finaliza tu primer Reto";
    }else{
      $ultimoretos = DB::table('challenges')->where('id',$retos->id)->get();

      if ($ultimoretos == null) {        
        foreach ($ultimoretos as $ultimo) {        
          $ultimoreto = $ultimo->name;
        }
      }else {
        $ultimoreto = "Termina un reto";
      }
    }
    

    // ====== llenar circulo porcentaje de retos
    // obtener total retos asignados al usuario
    $retospending = DB::table('challenges as i')
                    ->select('i.*')
                    ->leftJoin('subchapter_user as q', function ($join) use($userauth) {
                        $join->on('q.subchapter_id', '=', 'i.subchapter_id')
                              ->where('q.user_id', '=', $userauth);
                    })
                    ->count();
    //retos si ha sido asignado algun capitulo

    // retos que ya han sido jugados
    $retosfinish = DB::table('challenge_user')
                    ->join('challenges', 'challenge_user.challenge_id', '=', 'challenges.id')
                    ->where('challenge_user.user_id', '=', $userauth)
                    ->count();

if ($retospending == 0) {
  $nivelbarra = 0;
  $nivelbarraclean = 0;

}else {  
  $nivelbarra = ($retosfinish * 100)/$retospending;

  $nivelbarraclean = number_format($nivelbarra,0); 
  
  if ($nivelbarra == 0 && $retosfinish == 0) {
      $nivelbarra = 0;

  }elseif ($nivelbarra == 0) {
      $nivelbarra = 100;
  }
}

  //llamada procedimiento almacenado para competencias con respecto al subcapitulo jugado
  $chaptercompetencias = DB::select("call foundchapterCompetences($userauth)");
  

  if($chaptercompetencias){
    $chaptercom = $chaptercompetencias[0]->id;
    $competencias = DB::select("call competencesdisplay($chaptercom, $userauth)");
    
    $competencia = '';
    if (!empty($competencias)) {
      $competencia = $competencias[0]->competencia;
    }else {
      $chaptercom = $chaptercompetencias[0]->id;
      $competencias = DB::select("call competencesdisplaybyone($userauth)");
      $competencia = '';
      $competencia = $competencias[0]->competencia;      
    }
  }

  $capituloactual = DB::select("call capituloActual($userauth)"); 
  
  ?>



  <!-- | Your Page Content Here | -->

  <!-- todo el bloque de capitulos llamado dinamicamente con VUEJS -->
  <!---aqui se verifica en que capitulo esta-->
  <?php
        $userauth_id = Auth::user()->id;
        //validar para el procedure o para funcion sql
        $conta = DB::table('subchapter_user')
                ->where('user_id', '=', $userauth_id)
                ->select('chapter_id')
                ->distinct('chapter_id')
                ->count();
         if($conta != 0){
           $subc = DB::table('subchapter_user')
                ->join('chapters', 'subchapter_user.chapter_id', '=', 'chapters.id')
                ->where('user_id', '=', $userauth_id)
                ->select('chapter_id', 'subchapter_user.id', 'estado', 'chapters.name')
                ->distinct('chapter_id')
                ->orderBy('chapter_id','ASC')
                ->get();
            //contar las tareas asociadas a cada capitulo
            $tarcapitulo = DB::table('challenges')//total de tareas por cada uno de los acpitulos
                          ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                          ->join('chapters', 'subchapters.chapter_id', '=', 'chapters.id')
                          ->join('subchapter_user', 'chapters.id', '=', 'subchapter_user.chapter_id')
                          ->where('subchapter_user.user_id', $userauth_id)
                          ->selectRaw('subchapters.chapter_id as capitulo, COUNT(challenges.id) as total')
                          ->groupBy('subchapters.chapter_id')
                          ->get();
            
            $tarusuario = DB::table('challenge_user')
                          ->join('challenges', 'challenge_user.challenge_id', '=', 'challenges.id')
                          ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                          ->where('challenge_user.user_id', $userauth_id)
                          ->selectRaw('subchapters.chapter_id as capitulo, COUNT(challenge_user.challenge_id) as total')
                          ->groupBy('subchapters.chapter_id')
                          ->get();              
             foreach($tarcapitulo as $tc){
               foreach($tarusuario as $tu){
                    if($tc->capitulo == $tu->capitulo){
                      $resta = $tc->total-$tu->total;
                      if($resta != 0){
                        $item = [
                          'cap' => $tu->capitulo,
                          'tot' => $resta
                        ];
                        $captotal[] = $item;
                      }
                     
                    }else{
                          $item1 = [
                            'cap' => $tc->capitulo,
                            'tot' => $tc->total
                           ];
                           $capituloscon = $item1;
                    }
                    
               }
             }
            //obtener las tareas del capitulo
            if(isset($captotal[0]['cap'])){
            $tarcapi = DB::table('challenges')
                ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                ->where('subchapters.chapter_id', $captotal[0]['cap'])
                ->select('challenges.id')
                ->get();
            $tarea = DB::table('challenge_user')
                ->join('challenges', 'challenge_user.challenge_id', '=', 'challenges.id')
                ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                ->where('challenge_user.user_id', $userauth_id)
                ->where('subchapters.chapter_id', $captotal[0]['cap'])
                ->select('challenge_id as id')
                ->get();
            $capconsul = $captotal[0]['cap'];
            }else{
              $tarcapi = DB::table('challenges')
                      ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                      ->where('subchapters.chapter_id', $subc[0]->chapter_id)
                      ->select('challenges.id')
                      ->get();
              $tarea = DB::table('challenge_user')
                      ->join('challenges', 'challenge_user.challenge_id', '=', 'challenges.id')
                      ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                      ->where('challenge_user.user_id', $userauth_id)
                      ->where('subchapters.chapter_id', $subc[0]->chapter_id)
                      ->select('challenge_id as id')
                      ->get();
              $capconsul = $subc[0]->chapter_id;
            }
            //aqui se calcula para ver loscapitulos
            //################### validar en que parte va
           
            $tarea1 = json_decode($tarcapi);
            $tarea2 = json_decode($tarea);

           function compararIds($a, $b) {
                return $a->id - $b->id;
            }
            //contar para saber si dirije al inicio o a tareas
            $contar1 = count($tarea1);
            $contar2 = count($tarea2);
            //#####
            $diferentes = array_udiff($tarea1, $tarea2, 'compararIds');
            $vec = [];
            foreach($diferentes as $d){
              $vec[] = $d->id;
            }
            //#################
         }
      
    ?>
  <!--end verificacion-->
  @if($conta != 0)
  <div class="bg-primary hidden-xs"  style="background-image: url('storage/chapter01_bg.jpg'); position: absolute; margin: -21% 0% 0% 3%; width: 62%; border-radius: 12px;">
  <p style="padding-bottom:10rem;">
    <center>
    <ul class="navega">
    @foreach($subc as $s)  
      <li><span class="glyphicon glyphicon-record"></span>
          <a href="{{ route('capitulos.show', $s->chapter_id) }}" style="color:white;">{{$s->name}}</a>
       </li>         
    @endforeach
    </ul> 
    <br>
    <?php
      $pend = $contar1 - $contar2;
      $totalsum = 0;
      foreach($tarcapitulo as $s){
        $totalsum +=  $s->total;
      }
      $barra = ($retosfinish * 100) / $totalsum;
      $barrac = number_format($barra,0);
    ?>
      <h5>Tareas pendientes: {{$pend}} </h5>
     <br>
    </center>
    @if(empty($diferentes))
      @if(isset($capituloscon['cap']))
        <div class="text-center">
          <a href="{{ route('capitulos.show', $capituloscon['cap']) }}" class="btn btn-primary mx-auto">Comenzar</a>
        </div>
      @endif
    @else
      @if($contar2 == 0)
        <div class="text-center">
          <a href="{{ route('capitulos.show', $capconsul) }}" class="btn btn-primary mx-auto">Comenzar</a>
        </div>
      @else
        <div class="text-center">
          <a href="/challenge/{{$vec[0]}}" class="btn btn-primary mx-auto">Continuar</a>
        </div>
     @endif
   @endif
  </p>
  <br>
</div>
<!--ver en pantallas pequeñas -->
<div class="visible-xs">
@if(empty($diferentes))
      @if(isset($capituloscon['cap']))
        <div class="text-center">
          <a href="{{ route('capitulos.show', $capituloscon['cap']) }}" class="btn btn-primary mx-auto">Comenzar</a>
        </div>
      @endif
    @else
      @if($contar2 == 0)
        <div class="text-center">
          <a href="{{ route('capitulos.show', $capconsul) }}" class="btn btn-primary mx-auto">Comenzar</a>
        </div>
      @else
        <div class="text-center">
          <a href="/challenge/{{$vec[0]}}" class="btn btn-primary mx-auto">Continuar</a>
        </div>
     @endif
   @endif
    </div>
<!--end pantallas pequeñas-->
  @else
   <div class="flex hidden-xs" id="app">
    <playerchapters-component></playerchapters-component>
  </div>
  @endif
   
  <div class="flex cuadro">
   <!--hacer cards en boostrap 3.5-->
   <div class="container" style="color:white; font-family: nexa_bold;">
        <div class="row">
            <div class="col-md-4" >
                <div class="card" style="background-color:#1C0C53; border-radius:15px;">
                <br><br>
                    <div class="card-body" style="padding-left:2rem; padding-right:1rem;">
                        <h3 class="card-title">Competencia a trabajar:</h3>
                        <br>
                        <h4 class="card-text">{{$competence_active->name}}</h4>
                        <p>{{$competence_active->description}}</p>
                    </div>
                    <br><br>
                </div>
            </div>
            <p class="visible-xs"></p>
            <div class="col-md-4">
                <div class="card" style="background-color:#521B6E; border-radius:15px;">
                <br><br>
                    <div class="card-body" style="padding-left:2rem; padding-right:1rem;">
                        <h3 class="card-title text-center">Retos</h3>
                        <div class="card-text">
                          <!--contenido de la tarjeta dos-->
                          @if($conta != 0)
                          <div class="row">
                           <div class="col-md-12 hidden-xs">
                              <div class="ruedita" style="display: block; margin-left: auto; margin-right: auto;">
                                 <h3 class="text-center">{{$retosfinish}} /{{$totalsum}}</h3>
                              </div>
                           </div>
                           <!--pantallas peques-->
                            <div class="col-md-12 visible-xs">
                                 <h4 class="text-center">{{$retosfinish}} /{{$totalsum}} </h4>
                           </div>
                           <!--end pantallas-->
                          </div>
                          <div class="row">
                          <div class="col-md-2"></div>
                          <div class="col-md-8">
                            <div class="progress" style="border-radius:15px;">
                              <div role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-aqua" style="width: {{$barrac}}%; background-color: rgb(255, 57, 127);">
                                <span>{{$barrac}}%</span>
                              </div>
                            </div> 
                          </div>
                          <div class="col-md-2"></div>
                        </div>
                          @else
                           <div class="row">
                           <div class="col-md-12 hidden-xs">
                              <div class="ruedita" style="display: block; margin-left: auto; margin-right: auto;">
                                 <h3 class="text-center">{{$retosfinish}} /{{$retospending}}</h3>
                              </div>
                           </div>
                           <!--pantallas peques-->
                            <div class="col-md-12 visible-xs">
                                 <h4 class="text-center">{{$retosfinish}} /{{$retospending}}</h4>
                           </div>
                           <!--end pantallas-->
                          </div>
                          <div class="row">
                          <div class="col-md-2"></div>
                          <div class="col-md-8">
                            <div class="progress" style="border-radius:15px;">
                              <div role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-aqua" style="width: {{$nivelbarraclean}}%; background-color: rgb(255, 57, 127);">
                                <span>{{ $nivelbarraclean }}%</span>
                              </div>
                            </div> 
                          </div>
                          <div class="col-md-2"></div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                                @foreach ($capituloactual as $item)  
                                <?php
                                  $lastsubcapitulo = DB::select("call lastSubchapter($item->id, $userauth)");                
                                ?>

                                <div class="col-md-12" style="text-align: center;">
                                  @foreach ($lastsubcapitulo as $lastsub)
                                    <a href="{{ route('profile.pasarchallenge', $lastsub->id) }}" class="btnMisiones" style="border: solid 2px #d7d9e2!important;">
                                      Jugar Reto 
                                      <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                    </a>
                                  @endforeach
                                </div>
                              @endforeach
                           </div>
                         </div>
                          @endif
                          <!--end contenido-->
                        </div>
                    </div>
                    <br>
                </div>
            </div>
            <p class="visible-xs"></p>
            <div class="col-md-4">
                <div class="card" style="background-color:#5D4E90; border-radius:15px;">
                <br><br>
                    <div class="card-body" style="padding-left:2rem; padding-right:2rem;">
                        <h3 class="card-title text-center">Insignias</h3>
                        <div class="card-text" style="padding-top:5px;">
                        <!--acordeon-->
                        <div class="panel-group" id="accordion">
                          <div class="panel panel-default">
                              <div class="panel-heading" style="background-color:#5D4E90;">
                                  <h4 class="panel-title">
                                      <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="color:white;">Obtenidas <i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                                  </h4>
                              </div>
                              <div id="collapse1" class="panel-collapse collapse">
                                  <div class="panel-body" style="background-color:#5D4E90;">
                                     <!--mostrar insignias-->
                                     @foreach($usersinsignia->insignias->take(-4) as $insignia)
                                     <div class="row">
                                        <div class="col-md-4" style="text-align: center;">
                                          <img src="{{ asset($insignia->imagen)}}" alt="{{$insignia->name}}" class="img-responsive">            
                                        </div>
                                        <div class="col-md-8">
                                           <h6 class="text-center">{{$insignia->name}}</h6>           
                                        </div>
                                      </div>
                                      @endforeach
                                     <!--end inignias-->
                                  </div>
                              </div>
                          </div>
                         </div>
                        <!--end acordion-->
                          <div class="text-center">
                            <a href="{{ url('/recompensas') }}" class="btn btn-info" style="color:#ffffff!important;">Ver Insignias <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                          </div>
                    </div>
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
   <!--end cards  --->
  </div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Main Footer -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.1.2
  </div>
  <strong>Copyright &copy; 2018 <a href="#">Evolución</a>.</strong> All rights
  reserved.
</footer>
<style>
  ul.navega li {
  display: inline;
  padding-right: 0.5em;
}

</style>
@endsection
