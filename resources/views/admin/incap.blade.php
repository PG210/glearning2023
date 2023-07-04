@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{ url('/insignias') }}"><i class="fa fa-dashboard"></i> Insignias</a></li>
    <li class="active">Crear-Insignias</li>
    </ol>
</section>
@endsection

@section('insigniaCreate')

<h2>AGREGAR NUEVA INSIGNIA POR CAPITULO</h2>

<!--mensaje-->
@if(Session::has('msj'))
    <div class="alert alert-warning alert-dismissible" role="alert">
    {{Session('msj')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
@endif

        
<!--end mensaje-->
<div class="box box-default" style="margin-top: 5%;">
    <form method="POST" enctype="multipart/form-data" action="{{ route('insigniasguar') }}">
      @csrf
        <div class="box-header with-border">
            <div class="box-tools pull-right">
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="Nombre" required>
                    </div>
                    <!-- /.form-group -->                   
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-group">
                          <label for="imagen">Imagen Insignia</label>
                          <input type="file" class="form-control" name="ruta" id="ruta" accept="image/*" required>
                        </div>              
                    </div>
                    <!-- /.form-group -->                    
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-group">
                          <label for="imagen">Capitulo</label>
                          <input type="number" class="form-control" name="cap" id="cap" min="1" required>
                        </div>              
                    </div>
                    <!-- /.form-group -->                    
                </div>
                <!-- /.col -->                                
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="descripcion">Descripcion</label>
                      <textarea class="form-control" rows="5" name="des" id="des" required></textarea>
                    </div>
                    <!-- /.form-group -->                   
                </div>
                <!-- /.col -->                              
            </div>
          
            <div class="row">
                <div class="col-md-8" >
                    <div class="btn-group">
                        <button type="submit" class="btn btn-success" >Guardar</button>
                    </div>
                    <div class="btn-group">
                        <!--modal-->
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#vinsig">Visualizar</button>
                        <!--end modal-->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </form>
</div>

<!--complemento del modal-->
<!-- Modal -->
<div id="vinsig" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <!-- Contenido del modal -->
    <div class="modal-content" style="border-radius:20px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Listado de insignias registradas por capitulo</h4>
      </div>
      <div class="modal-body" style="overflow-y: auto;">
        <!-- Contenido con scroll vertical -->
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Capitulo</th>
                    <th>Insignia</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($info))
                @foreach($info as $in)
                <tr>
                    <td>{{$in->nombre}}</td>
                    <td>{{$in->descripcion}}</td>
                    <td>{{$in->capitulo}}</td>
                    <td>
                    <a href="/insigcap/{{$in->url}}" target="_blank">
                       <img src="/insigcap/{{$in->url}}" alt="Imagen pequeña" class="img-thumbnail" width="50px;">
                    </a>
                    </td>
                    <td>
                    <a href="{{ route('deletinscap', ['id' => $in->id]) }}" style="font-size: 24px; color: red;">
                        <i class="fa fa-trash"></i>
                    </a>
                    </td>
                </tr>
                @endforeach
                @endif
                <!-- Agrega más filas según sea necesario -->
                </tbody>
            </table>
            </div>

        <!-- Contenido con scroll vertical -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!--end fibalizar modal-->
@endsection

