@extends('layouts.app')

@section('content')

<?php
  $users = App\User::find(Auth::user()->id);
?>
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

        <h2>RECOMPENSAS</h2>
        <!-- <p>vista para todos los capitulos, los datos se cargan dinamicamente</p> -->
        <h3>Recompensas de Evolución</h3>
        <p>
          Aqui encontraras todas las recompensas que te han sido otorgadas en tu desarrollo de historia
        </p>
        <p>
          <b>Accesorios:</b>
          <br>
          Los retos otorgan puntos, a ciertas cantidades de puntos el juego te recompensará con los accesorios para tu CYBORG 
        </p>
        <p>
          <b>Insignias:</b>
          <br>
           En la medida que avances de niveles, el juego te reconocerá con insignias especiales para tu CYBORG.
        </p>
      </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
      <!-- About Me Box -->
      <!-- <div class="box box-primary">
        <h2>Acciones de Recompensas</h2>


      </div> -->
    </div>
    <!-- /.row -->

    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#insignias" data-toggle="tab">Insignias y Recompensas</a></li>
          {{-- <li><a href="#premios" data-toggle="tab">Accesorios</a></li> --}}
          <!-- <li><a href="#settings" data-toggle="tab">Causas</a></li> -->
        </ul>
        <div class="tab-content">
          <!-- INSIGNIAS -->
          <div class="active tab-pane" id="insignias">
            <!-- ACCESORIOS -->
            <div class="post">
              <h3>Insignias</h3>
              @foreach($users->insignias as $insignia)
                <div class="user-block">
                  <img class="img-circle img-responsive img-bordered-sm" src="{{ asset($insignia->imagen) }}" width="100px" alt="{{($insignia->name) }}">
                  <i aria-hidden="true"></i>
                      <span class="username">
                        <a href="#"> {{($insignia->name) }}</a>
                        <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                      </span>
                  <span class="description">{{($insignia->description) }}</span>
                </div>
              @endforeach
              <!-- /.user-block -->
            </div>
            <!-- /.post -->

            <!-- RECOMPENSAS -->
            <div class="post">
              <h3>Recompensas</h3>
              @foreach($users->gifts as $gift)
                <div class="user-block">
                  <img class="img-circle img-responsive img-bordered-sm" src="{{ asset($gift->imagen) }}" width="100px" alt="{{($gift->name) }}">
                  <i aria-hidden="true"></i>
                      <span class="username">
                        <a href="#"> {{($gift->name) }}</a>
                        <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                      </span>
                  <span class="description">{{($gift->description) }}</span>
                </div>
              @endforeach
              <!-- /.user-block -->
            </div>

            
          </div>
          <!-- /.tab-pane -->


          {{-- <div class="tab-pane" id="premios">
            
          </div> --}}
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
