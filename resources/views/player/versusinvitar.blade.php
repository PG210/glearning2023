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

        <h2>VERSUS</h2>
        <!-- <p>vista para todos los capitulos, los datos se cargan dinamicamente</p> -->

        <h3>Batallas contra usuarios</h3>
        <p>
          Aqui podras retar a otros usuarios de tu empresa para realizar variedad de retos individuales o grupales
        </p>

      </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
      <!-- About Me Box -->
      <!-- <div class="box box-primary">
        <h2>Acciones de Versus</h2>
      </div> -->
    </div>
    <!-- /.row -->

    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#activity" data-toggle="tab">Invitacion</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="activity">
            <!-- Post -->
            <div class="post">

             <h2>Invitar Compañero</h2>
                <div class="user-block">
                    {{-- va para:  VersusController@invitaciones --}}
                    <form method="POST" enctype="multipart/form-data" action="{{ route('versus.invitaciones') }}">
                        @csrf
                        <div class="form-group">
                            <label for="userasignado">Elegir Compañero Versus</label>
                            <select class="form-control" name="userinvitado" id="userasignado">
                                @foreach ($asignados as $user)
                                    <option value="{{ $user->id }}"> {{ $user->firstname }} {{ $user->lastname }} </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="idreto" value="{{$idreto}}">
                        </div>
                        <div class="form-group">
                          <label for="descripcion">Mensaje Invitacion</label>
                          <textarea class="form-control" rows="5" name="messageinvitado" id="descripcion" placeholder="Enviale un mensaje a tu compañero de juego"></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger">Enviar Invitacion</button>
                    </form>
                </div>
            </div>
            <!-- /.post -->
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
