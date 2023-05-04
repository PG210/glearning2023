@extends('layouts.admin')


@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Capitulos</li>
    </ol>
</section>
@endsection


@section('cargosCreate')

<!--botones-->
<h2>Vincular capitulos al grupo <span style="color:blue;">{{$grup->descrip}}</span></h2>
<div class="container">
<div class="row box-body">
    <div class="col-12">
         <!--mensaje-->
         @if(Session::has('grup'))
            <div class="alert alert-warning alert-dismissible fade in" role="alert" style="border-radius:15px;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>{{Session('grup')}}</strong> 
            </div>
         @endif
        <!--end mensaje-->
     <!--end modal-->
    </div>
</div>
</div>
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#usuarios">
    Usuarios
  </button>
        <!-- Modal -->
        <div class="modal fade" id="usuarios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius:15px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Usuarios Vinculados al grupo: {{$grup->descrip}} </h4>
            </div>
            <div class="modal-body">
              <!--tabla imprimir los usuarios -->
              <div class="bs-example" data-example-id="striped-table">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nombre </th>
                      <th>Apellido</th>
                      <th>Usuario</th>
                      <th>Estado/Agregado</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $conta1=1;
                    ?>
                    @foreach($usu as $u)
                    <tr>
                      <th scope="row">{{$conta1++}}</th>
                      <td>{{$u->nombre}}</td>
                      <td>{{$u->apellido}}</td>
                      <td>{{$u->usuario}}</td>
                      <td>
                        @foreach($usuchap as $us)
                          @if($u->idusu == $us->idchap)
                            <h5>Si</h5>
                          @endif
                        @endforeach
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!--end tabla-->
              <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
              </div>
            </div>
            </div>
        </div>
        </div>
     <!--end modal-->
<!--end botones-->
<div class="box box-default" style="margin-top: 3%;">
   <!--table-->
   <div class="bs-example" data-example-id="striped-table">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Nombre Capitulo</th>
          <th>Descripción</th>
          <th>Acciones</th>
          <th>Estado/vinculado</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $conta=1;
        ?>
        @foreach($cap as $c)
        <tr>
          <th scope="row">{{$conta++}}</th>
          <td>{{$c->name}}</td>
          <td>{{$c->title}}</td>
          <td>
            <a href="/admin/capitulos/vin/usu/{{$c->idcap}}/{{ $grup->id }}" type="button" class="btn btn-success">Agregar</a>
            <a  href="/admin/capitulos/eliminar/usu/{{$c->idcap}}/{{ $grup->id }}" type="button" class="btn btn-warning">Retirar</a>
         </td>
          <td>
             @foreach($verif as $v)
               @if($c->idcap == $v->chapter_id)
                <h5>Si</h5>
               @endif
             @endforeach
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
   <!--end table-->
</div>

@endsection
