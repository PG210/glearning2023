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

        <!-- /.row -->
        <div class="box box-default" style="margin-top: 5%;">
          <div class="box-header with-border">
              <div class="box-tools pull-right">
              </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-11">
              <h2>AGREGAR NUEVA CAUSA</h2>
              <form method="POST" action="{{ route('causas.store') }}">
                  @csrf
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                      <label for="descripcion">Descripcion</label>
                      <textarea class="form-control" rows="5" name="description" id="description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default">Invitar</button>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="time">Tiempo (Minutos)</label>
                      <input type="number" class="form-control" name="time" id="time">
                    </div>
                    <?php
                      $users = DB::table('users')->get();
                    ?>
                    <div class="form-group">
                      <label for="userasignado">Asignar Usuarios a la CAUSA</label>
                      <select multiple class="form-control" name="userasignado[]" id="userasignado">
                          @foreach($users as $user)
                            <option value="{{ $user->id }}"> {{ $user->firstname }} {{ $user->lastname }} </option>
                          @endforeach
                      </select>
                    </div>
                  </div>
              </form>
            </div>
        </div>
      </div>
    </div>
    <!-- /.col -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 0.1
  </div>
  <strong>Copyright &copy; 2018 <a href="#">Evolución</a>.</strong> All rights
  reserved.
</footer>
<!-- ./wrapper -->


@endsection
