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
                  <h1>CAUSAS</h1>
                  <div class="row">
                      <div class="col-md-2" >
                          <a href="{{ route('causas.create') }}" class="btn btn-block btn-primary btn-md">Nueva Causa</a>
                      </div>
                  </div>
                  <table class="table table-hover">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Nombre</th>
                              <th>Descripcion</th>
                              <th>Opciones</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($causas as $causa)
                              <tr>
                                  <th scope="row">{{ $causa->id }}</th>
                                  <td>{{ $causa->name }} </td>
                                  <td>{{ $causa->description }} </td>
                                  <td>
                                      {{-- <button type="button" class="btn btn-default" aria-label="Left Align">
                                        <a href="{{ route('causas.create') }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                      </button> --}}
                                      <form action="{{ route('causas.destroy', $causa->id ) }} " method="POST" style="display: inline-block;">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-default" aria-label="Left Align">
                                              <span class="fa fa-fw fa-trash-o" aria-hidden="true"></span>
                                          </button>
                                      </form>
                                  </td>
                              </tr>
                          @endforeach

                      </tbody>
                  </table>
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
