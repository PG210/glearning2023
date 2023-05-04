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
      <!-- <li><a href="#"><i class="fa fa-dashboard"></i> Retos</a></li> -->
      <!-- <li><a href="#">Mision 1</a></li>
      <li class="active">Reto 1</li> -->
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">

        <h2>GRUPOS</h2>
        <!-- <p>vista para todos los capitulos, los datos se cargan dinamicamente</p> -->

        <h3>Grupos a los que Pertenece</h3>
        <p>
          Aqui encontraras todos los grupos de los cuales haces parte.
        </p>

          <span>(grupos traidos desde la BD)</span>

      </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
      <!-- About Me Box -->
      <!-- <div class="box box-primary">
        <h2>Acciones de Grupo</h2>
      </div> -->
    </div>
    <!-- /.row -->

    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#activity" data-toggle="tab">Retos de Grupo</a></li>
          <li><a href="#timeline" data-toggle="tab">Recursos de Grupo</a></li>
          <li><a href="#settings" data-toggle="tab">Recompensas de Grupo</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="activity">
            <!-- Post -->
            <div class="post">
              <div class="user-block">
                <!-- <img class="img-circle img-bordered-sm" src="{{ asset('dist/img/char_img.png')}}" alt="user image"> -->
                <!-- <i class="fa fa-circle-o" aria-hidden="true"></i> -->
                    <!-- <span class="username"> -->
                      <!-- <a href="#"> Conociendo la Interfaz</a> -->
                      <!-- <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a> -->
                    <!-- </span> -->
                <!-- <span class="description">Guia de navegacion de la interfaz de usuario - Conoceras la interfaz de usuario y sabras donde encontrar lo necesario para el desarrollo de -->
                <!-- las misiones y retos que te encontraras en el desarrollo de la historia.</span> -->
              </div>
              <!-- /.user-block -->
              <ul class="list-inline">
                <li>
                  <!-- <a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Hacer Reto</a> -->
                </li>
                <li class="pull-right">
              </ul>

            </div>
            <!-- /.post -->
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="activity">
            <!-- The timeline -->
            <ul class="timeline timeline-inverse">
              <!-- timeline time label -->
              <!-- <li class="time-label">
                    <span class="bg-red">
                      12 Dic. 2018 (Fecha actual desde el servidor)
                    </span>
              </li> -->
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <li>
                <i class="fa fa-envelope bg-blue"></i>

                <div class="timeline-item">
                  <!-- <span class="time"><i class="fa fa-clock-o"></i> 12:05 (Hora PC)</span> -->

                  <!-- <h3 class="timeline-header"><a href="#">Recurso Reto 1</a> (Descripcion recurso)</h3> -->

                  <!-- <div class="timeline-body">
                    Bienvenido a la Evolución
                  </div> -->
                </div>
              </li>
              <!-- END timeline item -->

              <li>
                <i class="fa fa-check-circle bg-gray"></i>
              </li>
            </ul>
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
