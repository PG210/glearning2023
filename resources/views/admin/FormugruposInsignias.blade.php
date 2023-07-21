@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{ url('/insignias') }}"><i class="fa fa-dashboard"></i> Insignias</a></li>
    <li class="active">Categoría-Insignias</li>
    </ol>
</section>
@endsection

@section('insigniaCreate')

<h2>CREAR CATEGORÍA</h2>

@if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif
@if(Session::has('cat'))
<br>
<div class="alert alert-warning alert-dismissible fade in" role="alert" style="border-radius:15px;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <strong>{{Session('cat')}}</strong> 
</div>
@endif
<div class="box box-default" style="margin-top: 5%;">
    <form method="POST"  action="{{ route('registrarCategoria') }}">
      @csrf
        <div class="box-header with-border">
            <div class="box-tools pull-right">
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="Nombre" required>
                    </div>
                    <!-- /.form-group -->                   
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                <div class="form-group">
                    <label for="descripcion">Elegir tipo</label>
                    <select class="form-control" id="tipo" name="tipo">
                        <option value="Default">Default</option>
                        <option value="Insignia">Insignia</option>
                    </select>
                </div>    
                    <!-- /.form-group -->                    
                </div>
                <!-- /.col -->                                
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" class="form-control" name="descrip" id="descrip" placeholder="Descripcion" required>
                      </div>
                    <!-- /.form-group -->                   
                </div>
                <!-- /.col -->                              
            </div>
            <div class="row">
                <div class="col-md-8" >
                    <div class="btn-group">
                        <button type="submit" class="btn btn-info">Guardar</button>
                    </div>
                    <div class="btn-group">
                          <!-- HTML básico -->
                          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalvisu">
                               Visualizar
                            </button>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </form>
</div>
<!--========================================-->
 <!-- Modal -->
 <div class="modal fade" id="modalvisu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius:20px;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Categorias Registradas</h4>
        </div>
        <div class="modal-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($info))
                @foreach($info as $g)
                <tr>
                    <td>{{$g->nombre}}</td>
                    <td>{{$g->tipo}}</td>
                    <td>{{$g->descrip}}</td>
                    <td>
                    <a href="{{ route('formuEditarCat', ['id' => $g->id]) }}" class="text-center" style="font-size:24px; color:blue;"><i class="fa fa-pencil"></i>&nbsp;</a>
                    </td>
                </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
    </div>

<!--end modal-->

@endsection

