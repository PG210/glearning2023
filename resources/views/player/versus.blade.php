@extends('layouts.app')

@section('content')
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Bienvenido {{ Auth::user()->firstname }}
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">

        <h2>VERSUS</h2>
        <h3>Batallas contra usuarios</h3>
        <p>
            Otra forma de ganar puntos para tu CYBORG es retando a tus compañeros para que realicen los retos: escoge tu compañero, selecciona el reto y le llegará un mensaje para que lo juegue. Si lo logra, él obtendrá los puntos del reto, si no, los obtendrás tú.
        </p>
      </div>
        <!-- /.nav-tabs-custom -->
      </div>
    </div>
    <!-- /.row -->
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#activity" data-toggle="tab">Versus</a></li>
          <li><a href="#timeline" data-toggle="tab">Pendientes Por Jugar</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="activity">
            <!-- Post -->
            <div class="post">
              
              @foreach ($versus as $ver)                
                <?php
                  //versus para enviar invitaciones
                  $playversus = DB::table('challenges')->where('subchapter_id', $ver->subchapter_id)
                                                  ->where('gametype', 0)->get();                               
                ?>                  

                @foreach ($playversus as $versu)                                       
                    <div class="user-block">
                      <i class="fa fa-circle-o" aria-hidden="true"></i>
                      <a href="{{ route('versus.pasarversus', $versu->id) }} ">
                        {{ $versu->name }} 
                      </a>
                      <span class="description"> {{ $versu->description }} </span>
                    </div>                    
                @endforeach                  
              @endforeach

            </div>
            <!-- /.post -->
          </div>
          <!-- /.tab-pane -->

          <?php
            //usuario
            $userid = Auth::user()->id;

            // 1 paso - obtener duelos asignados
            $dueloslist = DB::table('duels')->get();
            
            // 2 paso - obtener los versus jugados
            $jugados = DB::table('challenge_user')->get();                        

            $retosyduels = DB::table('challenges')
                                ->join('duels', 'challenges.id', '=', 'duels.challenge_id')
                                ->join('challenge_quiz', 'challenges.id', '=', 'challenge_quiz.challenge_id')
                                ->where('duels.player1', $userid)
                                ->orWhere('duels.player2', $userid)
                                ->get();
                                
            //3 paso obtener la lista de duelos jugados por el usuario
            $jugadosuser = DB::table('duels')
                                ->join('challenge_user', 'duels.challenge_id', '=', 'challenge_user.challenge_id')
                                ->join('challenges', 'duels.challenge_id', '=', 'challenges.id')
                                ->where('duels.player1', $userid)
                                ->orWhere('duels.player2', $userid)
                                ->get();
            
            //4 paso obtener la lista de duelos que no se han jugado
            // $pendientesuser = DB::table('duels') 
            //                     ->join('challenges', 'duels.challenge_id', '=', 'challenges.id')
            //                     ->join('challenge_quiz', 'duels.challenge_id', '=', 'challenge_quiz.challenge_id')                  
            //                     ->whereNotExists(function ($query) {
            //                             $query->selectRaw(1)
            //                                   ->from('challenge_user')
            //                                   ->whereRaw('challenge_user.challenge_id = duels.challenge_id');
            //                     })
            //                     ->where('duels.player1', $userid)
            //                     ->orWhere('duels.player2', $userid)                                                                 
            //                     ->get();  
                
                              
            $pendientesuser = DB::table('duels as i')       
                  ->select('i.*', 'c.*')
                  ->join('challenges as c', 'i.challenge_id', '=', 'c.id')                  
                  ->leftJoin('challenge_user as q', function ($join) {
                    $join->on('q.challenge_id', '=', 'i.challenge_id');
                  })
                  ->whereNull('q.challenge_id')
                  ->where('i.player1', $userid)
                  ->orWhere('i.player2', $userid) 
                  ->get(); 
          ?>

      <div class="tab-pane" id="timeline">
        <!-- Post -->
        <div class="post"> 
          @if(!$jugados->isEmpty())           
            {{-- RETOS JUGADOS --}}
            @foreach ($jugadosuser as $jugado)
              <?php
                $retos = DB::table('challenges')->where('id', $jugado->challenge_id)->first();
              ?>

              <div class="user-block">
                  <i class="fa fa-circle-o" aria-hidden="true" style="color: #f50000;"></i>
                  <b>
                    RETO TERMINADO!:
                    <a>
                      {{ $retos->name }}
                    </a>
                  </b>
                  <br>         
                <span class="description">{{ $jugado->description }}.</span>
              </div>
            @endforeach

            {{-- RETOS PENDIENTES POR JUGAR --}}
            @foreach ($pendientesuser as $duelo)

              <?php
                $quiz = DB::table('challenge_quiz')->where('challenge_id', $duelo->challenge_id)->first();                
              ?>              
              <div class="user-block">
                <i class="fa fa-circle-o" aria-hidden="true" style="color: #26e600;"></i>
                @switch($duelo->challenge_type_id)
                  @case(1)
                        PRESIONA CLICK PARA EMPEZAR EL VERSUS:
                        <!-- lo lleva para PlayerChallengeController@startplay -->
                        <a href="{{ route('player.startchallenge', ['id' => $quiz->quiz_id, 'idreto' => $duelo->challenge_id, 'versus' => 1 ]) }}">
                          {{ $duelo->name }}
                        </a>
                      <span class="description">{{ $duelo->description }}.</span>
                      @break
                  @case(2)
                      PRESIONA CLICK PARA EMPEZAR EL VERSUS:
                      <a href="{{ route('games.ahorcado', $duelo->challenge_id) }}">{{ $duelo->name }}</a>
                      @break
                      
                  @case(3)
                      PRESIONA CLICK PARA EMPEZAR EL VERSUS:
                      <a href="{{ route('games.sopaletras', $duelo->challenge_id) }}">{{ $duelo->name }}</a>
                      @break

                  @case(4)
                      PRESIONA CLICK PARA EMPEZAR EL VERSUS:
                      <a href="{{ route('games.rompecabezas', $duelo->challenge_id) }}">{{ $duelo->name }}</a>
                      @break

                  @case(5)
                      PRESIONA CLICK PARA EMPEZAR EL VERSUS:
                      <a href="{{ route('games.seevideos', $duelo->challenge_id) }}">{{ $duelo->name }}</a>
                      @break

                  @case(6)
                      PRESIONA CLICK PARA EMPEZAR EL VERSUS:
                      <a href="{{ route('games.upfotos', $duelo->challenge_id) }}">{{ $duelo->name }}</a>
                      @break

                  @case(7)
                      PRESIONA CLICK PARA EMPEZAR EL VERSUS:
                      <a href="{{ route('games.lectura', $duelo->challenge_id) }}">{{ $duelo->name }}</a>
                      @break

                  @case(8)
                      PRESIONA CLICK PARA EMPEZAR EL VERSUS:
                      <a href="{{ route('games.outdoor',  $duelo->challenge_id) }}">{{ $duelo->name }}</a>
                      @break

                  @default
                      Default case...
                @endswitch
              </div>
            @endforeach
      
          @else

            @foreach ($retosyduels as $duelo)                       
            
                @switch($duelo->challenge_type_id)
                  @case(1)
                        PRESIONA CLICK PARA EMPEZAR EL VERSUS:
                        <!-- lo lleva para PlayerChallengeController@startplay -->
                        <a href="{{ route('player.startchallenge', ['id' => $duelo->quiz_id, 'idreto' => $duelo->challenge_id]) }}">
                          {{ $duelo->name }}
                        </a>
                        <br>
                        <!-- <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a> -->
                      <!-- </span> -->
                      <span class="description">{{ $duelo->description }}.</span>
                      <br><br><br>
                      @break
                  @case(2)
                      PRESIONA CLICK PARA EMPEZAR EL VERSUS:
                      <a href="{{ route('games.ahorcado', $duelo->challenge_id) }}">{{ $duelo->name }}</a>
                      @break
                      
                  @case(3)
                      PRESIONA CLICK PARA EMPEZAR EL VERSUS:
                      <a href="{{ route('games.sopaletras', $duelo->challenge_id) }}">{{ $duelo->name }}</a>
                      @break

                  @case(4)
                      PRESIONA CLICK PARA EMPEZAR EL VERSUS:
                      <a href="{{ route('games.rompecabezas', $duelo->challenge_id) }}">{{ $duelo->name }}</a>
                      @break

                  @case(5)
                      PRESIONA CLICK PARA EMPEZAR EL VERSUS:
                      <a href="{{ route('games.seevideos', $duelo->challenge_id) }}">{{ $duelo->name }}</a>
                      @break

                  @case(6)
                      PRESIONA CLICK PARA EMPEZAR EL VERSUS:
                      <a href="{{ route('games.upfotos', $duelo->challenge_id) }}">{{ $duelo->name }}</a>
                      @break

                  @case(7)
                      PRESIONA CLICK PARA EMPEZAR EL VERSUS:
                      <a href="{{ route('games.lectura', $duelo->challenge_id) }}">{{ $duelo->name }}</a>
                      @break

                  @case(8)
                      PRESIONA CLICK PARA EMPEZAR EL VERSUS:
                      <a href="{{ route('games.outdoor',  $duelo->challenge_id) }}">{{ $duelo->name }}</a>
                      @break

                  @default
                      Default case...
                @endswitch

            @endforeach
          @endif

           
            </div>
            <!-- /.post -->
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="activity">
            <!-- RECOMPENSAS -->
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.1.2
  </div>
  <strong>Copyright &copy; 2018 <a href="#">Evolución</a>.</strong> All rights
  reserved.
</footer>


<!-- ./wrapper -->

@endsection
