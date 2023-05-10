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
         }
       
        //#################
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
    </center>
    <br>
   <center>
     <a href="{{ route('capitulos.show', $subc[0]->chapter_id) }}" class="btn btn-primary">Comenzar</a>
   </center>
  </p>
  <br>
</div>
  @else
   <div class="flex hidden-xs" id="app">
    <playerchapters-component></playerchapters-component>
  </div>
  @endif
  <div class="flex cuadro">
    
  <!--<img src="storage/chapter01_bg.jpg" style="position: absolute; margin: -21% 0% 0% 3%; width: 62%; border-radius: 12px;">-->
  {{-- ------------------------   COMPETENCIA  ---------------------- --}}
    
    <div class="flex cuadrito misionActual" style="background-color: #1c0c53; color: #fff;">
      <p>Competencia a trabajar:</p>
      <div class="flex">
      <h2 style="text-align: center;">{{$competence_active->name}}</h2>
      </div>
    </div>

    
    <div class="flex cuadrito retoActual" style="background-color: #521b6e; color: #fff;">
      <p>Retos gg</p>
      <div class="flex ruedita">
        <h3>{{$retosfinish}} /{{$retospending}} </h3>
      </div>
      {{-- barra de progreso --}}
      <div class="col-md-8">
        <div class="progress xs">
          <div role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-aqua" style="width: {{ $nivelbarraclean }}%; background-color: rgb(255, 57, 127);">
            <span class="sr-only">{{ $nivelbarraclean }}%</span>
          </div>
        </div> 
      </div>    
      
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

    <div class="flex cuadrito insigniaDestacada" style="background-color: #5d4e90; color: #fff;">
      <div class="container-fluid">
        <div class="row">           
          <div class="col-md-12" style="text-align: center;">
            <p>Insignias</p>
          </div>
          @foreach($usersinsignia->insignias->take(-4) as $insignia)
          <div class="col-md-6" style="text-align: center;">
            <img src="{{ asset($insignia->imagen)}}" alt="{{$insignia->name}}" style="width:60%;">            
          </div>
          @endforeach
          <div class="col-md-12" style="text-align: center;">
            <a href="{{ url('/recompensas') }}" class="btnMisiones" style="color:#ffffff!important;">Ver Insignias <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
          </div>
        </div>
      </div>
      </div>
    </div>
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
