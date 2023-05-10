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
          <h3>Temas:</h3>
        </div>

        <?php
          $subcapitul = DB::select("call subchapterSecuence($capitulos->id, $userauthid)");  
          $subcapitulos = array_reverse($subcapitul);
          $lastsubcapitulo = DB::select("call lastSubchapter($capitulos->id, $userauthid)");   
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

            @if ($loop->last && count($subcapitulos) > 1)
              <!-- PlayerChaptersController@pasarchallenge --> 
              <div class="form-group">                
                <a type="button" style="font-size: 1.7rem; background-color:#868686!important; border-color:#2d2d2d!important;" class="btn btn-block btn-primary" href="{{ route('profile.pasarchallenge', $subcap->id) }} ">
                    <img src="{{ asset('dist/img/checked.png') }}" style="margin: -1% 1% -3% 0%; width: 17%;">                  
                  {{ $subcap->name }}
                </a>
              </div>
            @else                
              <div class="form-group">                
                <a type="button" style="font-size:95%;" class="btn btn-block btn-danger" href="{{ route('profile.pasarchallenge', $subcap->id) }} ">
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
          <li class="active"><a href="#activity" data-toggle="tab">{{ $capitulos->name }}</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="activity">

            <?php
              if (empty($videohidden)) {
                $videodisplay = "visible";
              } else {
                $videodisplay = "hidden";
              }
            ?>            

            <div class="media">                
              <div class="media-body">
              <iframe src="{{ $capitulos->videoIntro }}" id="framevideos" class="{{ $videodisplay }}" frameborder="0" style="width:100%; height:420px;" allowfullscreen></iframe>
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
