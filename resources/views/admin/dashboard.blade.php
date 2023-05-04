@extends('layouts.admin')

@section('titulos')
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>   
  </ol>
</section>
@endsection

@section('dashboard')

  <!-- Main content -->
  <section class="content">

      <?php
        $countusers = App\User::count();       
      ?>
      
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                <h3>{{$countusers}}</h3>
        
                <p>Usuarios Registrados</p>
                </div>
                <div class="icon">
                <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ url('usuario') }}" class="small-box-footer">
                Mas Informacion <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>


    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">
            <!-- <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture"> -->

            <h3 class="profile-username text-center">Admin Evolucion</h3>
            <!-- <p class="text-muted text-center">Tipo de Personaje (Personaje Seleccionado en Registro)</p> -->

            <?php
              $chapters = App\Chapter::count();
              $subchapters = App\Subchapter::count();
              $challenges = App\Challenge::count();
              $insignia = App\Insignia::count();
              $wards = App\Gift::count();
              
            ?>

            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>Capitulos</b> <a class="pull-right">{{ $chapters }}</a>
              </li>
              <li class="list-group-item">
                <b>Misiones</b> <a class="pull-right">{{ $subchapters }}</a>
              </li>
              <li class="list-group-item">
                <b>Retos</b> <a class="pull-right">{{ $challenges }}</a>
              </li>
              <li class="list-group-item">
                <b>Insignias</b> <a class="pull-right">{{ $insignia }}</a>
              </li>
              <li class="list-group-item">
                <b>Reconocimientos</b> <a class="pull-right">{{ $wards }}</a>
              </li>
              {{-- <li class="list-group-item">
                <b>Causas</b> <a class="pull-right">----</a>
              </li> --}}
            </ul>

            <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>

      <!-- /.col -->
      <div class="col-md-9">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab">Actividad</a></li>
            <li><a href="#timeline" data-toggle="tab">Linea de Tiempo</a></li>
            <!-- <li><a href="#settings" data-toggle="tab">Configuración</a></li> -->
          </ul>
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              
              <?php 
                $actividades = DB::table('log_changes')->get();
                setlocale(LC_TIME, 'es_ES');
                Carbon\Carbon::setLocale('es');
              ?>

              <!-- Post actividad-->
              @foreach ($actividades as $actividad)                  
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" style="border:none; width: 75px;" src="{{ asset('dist/img/evolucion-2018.png')}}" alt="user image">
                    <span class="username">
                      <a href="#">Admin Evolucion</a>
                      <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                    </span>
                  <span class="description">{{ $actividad->accion_realizada }} - {{ Carbon\Carbon::parse($actividad->created_at)->diffForHumans() }}</span>
                  </div>
                  <!-- /.user-block -->
                  <?php 
                    $relacivity = $actividad->model_name::find($actividad->recurso_id);  
                    if ($relacivity==null) {
                      echo "Sin Actividad";
                      $nameacty = "Sin Actividad";
                      $descacty = "Sin Actividad";
                    }else {
                      $nameacty = $relacivity->name;
                      $descacty = $relacivity->description;
                    }
                  ?>
                  <p>
                      {{ $actividad->accion_realizada }} : {{ $nameacty }}
                  </p>
                  <p class="text-muted">{{ $descacty }}</p>
                </div>
              @endforeach
              <!-- /.post -->

            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="timeline">
              <!-- The timeline -->
              <ul class="timeline timeline-inverse">
                <!-- timeline time label -->
                <li class="time-label">
                      <span class="bg-red">
                        
                          {{ date('Y-m-d H:i:s') }}
                      </span>
                </li>
                <!-- /.timeline-label -->

                <!-- timeline item -->
                @foreach ($actividades as $actividad) 
                <li>
                  <i class="fa fa-user bg-aqua"></i>

                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> {{ Carbon\Carbon::parse($actividad->created_at)->diffForHumans() }}</span>

                    <h3 class="timeline-header"> {{ $actividad->accion_realizada }} </h3>
                   
                    <div class="timeline-body">
                        {{ $nameacty }}
                        {{ $descacty }}
                    </div>
                  </div>
                </li>
                @endforeach
                <!-- END timeline item -->
                
                <!-- timeline item -->        
                <li>
                  <i class="fa fa-clock-o bg-gray"></i>
                </li>
              </ul>
            </div>
            <!-- /.tab-pane -->

            <!-- <div class="tab-pane" id="settings">
              <form class="form-horizontal">
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">Nombre de Usuario</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputName" placeholder="Nombre">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputExperience" class="col-sm-2 control-label">Información</label>

                  <div class="col-sm-10">
                    <textarea class="form-control" id="inputExperience" placeholder="Información"></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Enviar</button>
                  </div>
                </div>
              </form>
            </div> -->
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->




    <!-- popup de actividades pendientes -->
    <?php 
      $user_id = Auth::user()->id;
      $admintasktodo = DB::select("call tareasPendientes($user_id)");
    ?>
  
  @foreach ($admintasktodo as $task)      
    @if ($task->usuarios_asignados == 0 || $task->jefes_asignados == 0 || $task->quizzes_asignados == 0 || $task->valores_causas == 0 )
      
    <div class="modal modal-info fade in" id="popuptareas" style="display: block; padding-right: 15px;">
        <div class="modal-dialog" style="border-radius: 27px; width: 69%;">
          <div class="modal-content" style="text-align: center; border-radius: 21px; background-color: #ec007d!important;">
            <div class="modal-header" style="border-radius: 16px; background-color: #ec007d!important;">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
              <h4 class="modal-title">TIENES ACTIVIDADES PENDIENTES {{ Auth::user()->firstname }}</h4>
            </div>
            <div class="modal-body" style="height: 60%; background-color: #4b0056!important; text-align: left!important;">
    
              <div class="row">
                <div class="col-md-12">  
                  <h3>Tines las Siguientes actividades de administracion pendientes:</h3>
                  <ul>
                    @if ($task->usuarios_asignados == 0)
                      <li>Usuarios asignados <img src="storage/minus.png" alt=""> </li>                        
                    @else
                      <li>Usuarios asignados <img src="storage/correct.png" alt=""> </li>                        
                    @endif

                    @if ($task->jefes_asignados == 0)
                      <li>Jefes asignados <img src="storage/minus.png" alt=""> </li>                        
                    @else
                      <li>Jefes asignados <img src="storage/correct.png" alt=""> </li>                        
                    @endif

                    @if ($task->quizzes_asignados == 0)
                      <li>Quizzes asignados <img src="storage/minus.png" alt=""> </li>                        
                    @else
                      <li>Quizzes asignados <img src="storage/correct.png" alt=""> </li>                        
                    @endif

                    @if ($task->valores_causas == 0)
                      <li>Valores causas <img src="storage/minus.png" alt=""> </li>                        
                    @else
                      <li>Valores causas <img src="storage/correct.png" alt=""> </li>                        
                    @endif
                   
                  </ul>         

                </div>              
              </div>
            
            </div>
            <div class="modal-footer" style="border-radius: 14px; background-color: #ec007d!important;">
              <button type="button" class="btn btn-danger btn-lg pull-left" onclick="cerrarpopup()" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    @endif
  @endforeach
  <!-- popup de actividades pendientes -->



<script>
function cerrarpopup() {
  $('#popuptareas').hide();
}
</script>




  </section>
  <!-- /.content -->


@endsection
