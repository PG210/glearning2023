@extends('layouts.admin')


@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Grupos</li>
    </ol>
</section>
@endsection


@section('cargosCreate')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!--botones-->
<h2>AGREGAR NUEVO GRUPO</h2>
<div class="container">
<div class="row box-body">
    <div class="col-12">
         <!--mensaje-->
         @if(Session::has('datreg'))
            <div class="alert alert-warning alert-dismissible fade in" role="alert" style="border-radius:15px;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>{{Session('datreg')}}</strong> 
            </div>
         @endif
        <!--end mensaje-->
     <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#nuevogrupo">
          Nuevo
        </button>
        <a href="{{route('usuariosgrupos')}}" type="button" class="btn btn-success">Vincular Usuarios</a>
        <!-- Modal -->
        <div class="modal fade" id="nuevogrupo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius:15px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Registrar nuevo grupo</h4>
            </div>
            <div class="modal-body">
             <form method="POST" action="{{route('guardargrupo')}}" >
                @csrf
                <!--campo-->
                <div class="form-group">
                  <label for="descripcion">Descripción</label>
                  <input rows="4" cols="50" name="info" id="info" class="form-control" required>
                </div>
                <!--end campo-->
              <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
            </div>
            </div>
        </div>
        </div>
     <!--end modal-->
    </div>
</div>
</div>
<!--end botones-->
<div class="box box-default" style="margin-top: 5%;">
   <!--table-->
   <div class="bs-example" data-example-id="striped-table">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Id Grupo</th>
          <th>Grupo</th>
          <th>No Usuarios</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
           $conta=1;
        ?>
        @if(isset($datos[0]))
        @foreach($datos as $d)
        <tr>
          <th scope="row">{{$conta++}}</th>
          <td>{{$d->idgro}}</td>
          <td>{{$d->descrip}}</td>
          <td>
            @foreach($tot as $t)
              @if($d->idgro == $t->id)
                {{$t->total}}
              @endif
            @endforeach
          </td>
          <td>
        <a href="{{route('vincap',  ['id' => $d->idgro])}}" type="button" class="btn btn-success">Capitulos</a>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#editar{{$d->idgro}}">
          Editar
        </button>
        <!-- Modal -->
        <div class="modal fade" id="editar{{$d->idgro}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius:15px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Actualizar</h4>
            </div>
            <div class="modal-body">
             <form method="POST" action="{{route('actualizargrupo', ['id' => $d->idgro])}}" >
                @csrf
                <!--campo-->
                <div class="form-group">
                  <label for="descripcion">Descripción</label>
                  <input rows="4" cols="50" name="infoacu" id="infoactu" class="form-control" value="{{$d->descrip}}" required>
                </div>
                <!--end campo-->
              <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
            </div>
            </div>
        </div>
        </div>
     <!--end modal-->
       <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#eliminar{{$d->idgro}}">
          Eliminar
        </button>
      <!-- Modal -->
      <div class="modal fade" id="eliminar{{$d->idgro}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius:15px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <h4 class="modal-title" id="myModalLabel">Desea eliminar este grupo?. Tenga en cuenta que los grupos con usuarios no se pueden eliminar</h4>
              <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
                <a type="button" href="{{route('gruposelim',  ['id' => $d->idgro])}}" class="btn btn-info">Eliminar</a>
              </div>
            </div>
            </div>
        </div>
        </div>
     <!--end modal-->
          </td>
        </tr>
        @endforeach
       @endif
      </tbody>
    </table>
  </div>
   <!--end table-->
</div>

@endsection
