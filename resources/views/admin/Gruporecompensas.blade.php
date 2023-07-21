@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>    
    <li><a href="{{ url('/reconocimientos') }}"><i class="fa fa-dashboard"></i>Reconocimiento</a></li>    
    <li class="active">Grupo Reconocimiento</li>
    </ol>
</section>
@endsection

@section('awardCreate')

<h2>AGREGAR NUEVO GRUPO</h2>

@if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif

@if(Session::has('gr'))
<br>
<div class="alert alert-warning alert-dismissible fade in" role="alert" style="border-radius:15px;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <strong>{{Session('gr')}}</strong> 
</div>
@endif

<div class="box box-default" style="margin-top: 5%;">
    <form method="POST"  action="{{ route('gruporeconocimiento.store') }}">
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
                        <option value="1">Insignia</option>
                        <option value="2">Recompensa</option>
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
                      <!--modal-->
                            <!-- HTML básico -->
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalvis">
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
   <!-- Modal -->
   <div class="modal fade" id="modalvis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius:20px;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Grupos registrados</h4>
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
                @foreach($info as $g)
                <tr>
                    <td>{{$g->nombre}}</td>
                    @if($g->tipo == 1)
                    <td>Insignias</td>
                    @else
                    <td>Recomensas</td>
                    @endif
                    <td>{{$g->descrip}}</td>
                    <td>
                    <a href="{{ route('gruporeconocimiento.destroy', ['id' => $g->id]) }}" class="text-center" style="font-size:24px; color:blue;"><i class="fa fa-pencil"></i>&nbsp;</a>
                    </td>
                </tr>
                @endforeach
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
