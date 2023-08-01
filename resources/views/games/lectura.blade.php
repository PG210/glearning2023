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
    <ol class="breadcrumb">
    </ol>
  </section>
  
  @if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif
  <!-- Main content -->
  <section class="content">

     <!-- /.row -->
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#activity" data-toggle="tab">Reto</a></li>
          {{-- <li><a href="#timeline" data-toggle="tab">Recursos</a></li> --}}
          <!-- <li><a href="#settings" data-toggle="tab">Recompensas</a></li> -->
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="activity">
            <!-- Post -->
            <div class="post">
              <div class="user-block">
            <h1>COMENZANDO EL RETO - Lectura</h1>
            <p style="color: #730028; font-size: 16px; font-weight: 600; text-align: center;">
              {{ $retos->description }}
            </p>
            <tiempos-component tiempoasignado="{{ $retos->time }}"></tiempos-component>
            
            <form method="POST" enctype="multipart/form-data" action="{{ route('gamesplay.lectura', 5) }}">
                @csrf
                <input type="hidden" name="usuario" value="{{ Auth::user()->id }}">
                <input type="hidden" name="reto" value="{{ $retos->id }}">             

                <div class="row" style="margin:4% 0% 0% 0%;text-align: -webkit-center;">
                  <div class="col-md-12">

                    <div class="panel-group">
                      <div class="panel panel-default" style="box-shadow: 0px 5px 6px 0px #670024;border-color: #ea0d5b;">
                        <div class="panel-heading" style="background-color: #ea0d5b; color: #fff;text-align: center;">
                          <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse1">Ver Material</a>
                          </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse">
                          <div class="panel-body">
                          @if(strstr($retos->material, 'http:'))
                             <embed src="{{ $retos->material }}" type="application/pdf" width="100%" height="600px" />
                            @else
                              <embed src="/storage/public/{{ $retos->material }}" type="application/pdf" width="100%" height="600px" />
                            @endif
                            
                          </div>
                        </div>
                      </div>
                    </div>

                      {{-- <div class="form-group" style="width: 36%!important;"> 
                        <a href="{{ asset($retos->material)}}" target="_blank" class="btn btn-block btn-info">
                          <i class="fa fa-download"></i>
                          Descargar Material
                        </a>                                    
                      </div> --}}

                  </div>
                </div>
                
                <div class="form-group">
                    <label for="evidence">Respuesta - Minimo 120 Caracteres</label>
                    <textarea class="form-control{{ $errors->has('evidence') ? ' is-invalid' : '' }}" rows="5" name="evidence" id="evidence" spellcheck="true" placeholder="A continuación escribe tus respuestas a las instrucciones planteadas en el Reto">{{ old('evidence') }}</textarea>                                
                                                                
                  </div>
                <button type="submit" class="btn btn-primary">Terminar</button>
            </form>

              </div>
              <!-- /.user-block -->
            </div>
            <!-- /.post -->
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="timeline">
            <!-- The timeline -->
            <ul class="timeline timeline-inverse">
              <!-- timeline item -->
              <li>
                <!-- <i class="fa fa-envelope bg-blue"></i> -->
                <div class="timeline-item">
                  <h3 class="timeline-header"><a href="#">Recurso Reto 1</a> </h3>
                  <div class="timeline-body">
                    
                    
                      <div class="panel-group">
                          <div class="panel panel-default" style="box-shadow: 0px 5px 6px 0px #670024;border-color: #ea0d5b;">
                            <div class="panel-heading" style="background-color: #ea0d5b; color: #fff;text-align: center;">
                              <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse1">Ver Material</a>
                              </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse">
                              <div class="panel-body">
                                
                                @if(strstr($retos->material, 'http:'))
                                  <embed src="{{ $retos->material }}" type="application/pdf" width="100%" height="600px" />
                                @else
                                  <embed src="/storage/public/{{ $retos->material }}" type="application/pdf" width="100%" height="600px" />
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                    
                    {{-- <div class="form-group" style="width: 36%!important;"> 
                      <a href="{{ asset($retos->material)}}" target="_blank" class="btn btn-block btn-info">
                        <i class="fa fa-download"></i>
                        Descargar Lectura
                      </a>                                    
                    </div> --}}
                    
                  </div>
                </div>
              </li>
              <!-- END timeline item -->
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
