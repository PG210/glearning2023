@extends('layouts.app')

@section('content')

<style>
   @media (max-width: 767px) {
    .mobile-style {
      width: 100%;
      height: auto;
      /* Otros estilos específicos para celular */
    }
  }

   /* Estilos para pantallas grandes (escritorios) */
   @media (min-width: 768px) {
    .desktop-style {
      width: 100%;
      height: 420px;
      /* Otros estilos específicos para pantallas grandes */
    }
  }
</style>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">      
    <h1 style="font-size: 5rem; margin: 4% 0% 0% 0%;">
      Bienvenido {{ Auth::user()->firstname }} 
      {{--
      @if(isset($mensaje != 0))
         <h3 class="text-center">Capitulos terminados de manera exitosa</h3>
      @endif --}}
    </h1>
    @if(isset($tem))
    @if($tem == 0)
         <div class="alert alert-warning alert-dismissible fade in" role="alert" style="padding-top:2px; padding-bottom:2px; border-radius:15px;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h3 class="text-center"> <strong>¡Felicidades!, Capítulo terminado de manera exitosa &#128522; </strong> </h3>
            </div>
    @endif
    @if($tem == 1)
         <div class="alert alert-dismissible fade in" role="alert" style="padding-top:2px; padding-bottom:2px; border-radius:15px; background-color:#1ED5F4;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h3 class="text-center"> <strong>Tienes tareas pendientes para finalizar el capítulo, apresúrate &#128515;</strong> </h3>
            </div>
    @endif
    @endif
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Capitulo {{ $capitulos->order -1 }}</a></li>      
    </ol>
  </section>

  {{-- <popupinsignias-component></popupinsignias-component> --}}

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">

        <h2>{{ $capitulos->name }}</h2>
        <!-- <p>vista para todos los capitulos, los datos se cargan dinamicamente</p> -->
        <h3>{{ $capitulos->title }}</h3>
        <p>
          {{ $capitulos->description }}
        </p>
      </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
      <!-- About Me Box -->

      <div class="box box-primary">
        <?php
          //obtener relacion SUBCAPTULO_USER
          $users = App\User::find(Auth::user()->id);
          $userauthid = Auth::user()->id;
        ?>
        <div class="box-header with-border">
          <h3>Temas: </h3>
        </div>

        <?php
          $subcapitul = DB::select("call subchapterSecuence($capitulos->id, $userauthid)");  
          $subcapitulos = array_reverse($subcapitul);
          $lastsubcapitulo = DB::select("call lastSubchapter($capitulos->id, $userauthid)");   
          //var_dump($subcapitulos);
         // foreach($subcapitulos as $s){
            //dd($subcapitulos);
           // if ($s->RETOS_SUBCAPITULO_REQUERIDO == $s-> RETOS_CAPITULO_COMPLETADOS){
             // var_dump($s->name);
            //  var_dump($s->name);
           // }
            
         // }


       ?>
        {{-- @foreach ($lastsubcapitulo as $lastsubcap)
          <div class="form-group">                
            <a type="button" style="font-size: 1.7rem; background-color:#af129c; border-color:#6bod2e; font-weight:800;" class="btn btn-block btn-danger" href="{{ route('profile.pasarchallenge', $lastsubcap->id) }} ">
              COMENZAR: {{ $lastsubcap->name }}
            </a>
          </div>
        @endforeach --}}
        

        @foreach ($subcapitulos as $subcap)            
          <div class="box-body">

            @if ($subcap->RETOS_SUBCAPITULO_REQUERIDO == $subcap-> RETOS_CAPITULO_COMPLETADOS)
              <!-- PlayerChaptersController@pasarchallenge --> 
              <div class="form-group">                
                <a type="button" style="font-size: 15px; background-color:#868686!important; border-color:#2d2d2d!important; border-radius: 14px; padding: 12px 15px; box-shadow: 0 5px #000;" class="btn-block btn-primary" href="{{ route('profile.pasarchallenge', $subcap->id) }} ">
                    <img src="{{ asset('dist/img/checked.png') }}" style="margin: -1% 1% -3% 0%; width: 17%;">                  
                     {{ $subcap->name }} 
                </a> 
                <br>
              </div>
            @else                
              <div class="form-group">                
                <a type="button" style="font-size:15px; border-radius: 14px; padding: 12px 15px; box-shadow: 0 5px #999;" class="btn-block btn-danger" href="{{ route('profile.pasarchallenge', $subcap->id) }} ">
                  COMENZAR: {{ $subcap->name }}
                </a>
              </div>                                
            @endif
            <strong>Descripcion:</strong>
            <p style="color: #730028; font-size: 16px; font-weight: 600;">
                {{ $subcap->description }}                
            </p>                                                                                     
            <hr>
          </div>
          <!-- /.Subcapitulos del Reto -->
        @endforeach      

      </div>
    </div>
    <!-- /.row -->

    <div class="col-md-9">
      
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#activity" data-toggle="tab"><b>
            @if(isset($v))
             Actividades Tema:<p>
             {{$v}}
             </p>
             @else
             {{ $capitulos->name }}
            @endif
            </b></a></li>
          <li><a href="#tareas" data-toggle="tab" style="font-size:16px;"><b>Total de actividades</b></a></li>
        </ul>
       
        <div class="tab-content">
         <!--- item tareas -->
            <div class="tab-pane fade" id="tareas">
             <!--contenido-->
             <div style="height: 500px; overflow-y: scroll;">
             <br>
             @if(isset($tareacap) && isset($tareasusu))
             @foreach ($tareacap as $tar)
              @php
                  $found = false;
              @endphp
              @foreach ($tareasusu as $tus)
                  @if ($tus->idt == $tar->idt)
                      @php
                          $found = true;
                          break;
                      @endphp
                  @endif
              @endforeach
              @if (!$found)
                <div class="post">
                <div class="user-block">
                    <i aria-hidden="true"></i>
                      @if(isset($retp->id))
                      @if($tar->idt == $retp->id)
                       <a href="{{ route('player.challenge', $retp->id) }}">
                       <i class="fa fa-unlock blinking-lock" style="font-size:36px; margin-left:10px; color:#4b42bc;"></i>&nbsp;&nbsp;&nbsp;
                      <span style="color:black;">EL RETO:</span> <span style="color:green; font-size:15px;" >{{ $retp->name }}</span><span class="blinking-lock"> CONTINUAR !!! </span>
                      </a>
                      @else
                      <i class="fa fa-lock" style="font-size:36px; margin-left:10px;"></i>&nbsp;&nbsp;&nbsp;                    
                        EL RETO, <span style="color:red; font-size:15px;" >{{ $tar->name }}</span> FALTA COMPLETAR.
                      @endif
                      @endif
                      <!-- </span> -->
                  </div>
                </div>
              @else
              <div class="post">
               <div class="user-block">
                  <i aria-hidden="true"></i>
                    <strong>                        
                      <img src="{{ asset('dist/img/checked.png') }}" style="margin: -1% 1% -3% 0%;">
                      EL RETO, <span style="color:blue; font-size:15px;">{{ $tar->name }}</span>  YA HA SIDO COMPLETADO!!!
                    </strong>
                    <!-- </span> -->
                </div>
              </div>
              @endif
          @endforeach
             @endif
           </div>
             <!--end contenido-->
            </div>
        <!--end tareas-->
          <div class="tab-pane fade in active" id="activity">

            <?php
              if (empty($videohidden)) {
                $videodisplay = "visible";
              } else {
                $videodisplay = "hidden";
              }
            ?>            

            <div class="media">                
              <div class="media-body">
              @if (strpos($capitulos->videoIntro, 'http') !== false) 
                <iframe src="{{$capitulos->videoIntro}}" id="framevideos" class="{{ $videodisplay }}" style="width:100%; height:420px; " frameborder="0" allowfullscreen></iframe>
              @else 
              <video src="{{ asset('/storage/public/videos/' .$capitulos->videoIntro) }}" id="videoIntro" class="{{$videodisplay}}"
                     style="width:100%; height:auto; object-fit: cover; "  controls  allowfullscreen></video>
              @endif
              </div>
            </div>

            <!-- Retos -->
            @if(!empty($retosfinish))                
              @foreach ($retosfinish as $finish)                            
              <div class="post">
                <div class="user-block">
                  <i aria-hidden="true"></i>
                    <strong>                        
                      <img src="{{ asset('dist/img/checked.png') }}" style="margin: -1% 1% -3% 0%;">
                      EL RETO, <a href="">{{ $finish->name }} </a>  YA HA SIDO COMPLETADO!!!
                    </strong>
                    <!-- </span> -->
                </div>
                <!-- /.user-block -->
              </div>
              @endforeach
            @endif

            @if(!empty($retospendientes))
              <div class="post">
                <hr>
                  <div class="row" style="margin:4% 0% 0% 0%;text-align: -webkit-center;">
                      <div class="col-md-12">
                          <div class="form-group">
                              <a href="{{ route('player.challenge', $retospendientes->id) }}" type="button" style="width:45%;"  class="btn btn-block btn-primary" >
                                <span style="font-weight:900;font-size:95%;">Comenzar:</span> {{ $retospendientes->name }}
                              </a>
                          </div>
                          <span class="description"> 
                            <h4>Descripcion:</h4>
                            <p style="color: #730028; font-size: 16px; font-weight: 600;">
                              {{ $retospendientes->description }} 
                            </p>
                          </span>
                      </div>
                  </div>
                <hr>
            
              </div>                
              @endif

          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="timeline">
            <!-- The timeline -->
            <ul class="timeline timeline-inverse">

              <!-- timeline item -->
              <li>
                <i class="fa fa-envelope bg-blue"></i>

                <div class="timeline-item">
                  @if(!empty($finish))
                    <h3 class="timeline-header"><a href="#">Recurso {{ $finish->name }}</a> {{ $finish->material }}</h3>
                  @endif
                  <div class="timeline-body">
                    Bienvenido a la Evolución
                  </div>
                </div>
              </li>
              <!-- END timeline item -->

              <li>
                <i class="fa fa-check-circle bg-gray"></i>
              </li>
            </ul>
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="settings">
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
