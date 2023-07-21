
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

<h2>ACTUALIZAR GRUPO</h2>

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
    <form method="POST"  action="{{ route('acturec') }}">
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
                      <input type="text" class="form-control" name="name" id="name" value="{{$up[0]->nombre}}">
                    </div>
                    <!-- /.form-group -->                   
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                <div class="form-group">
                    <label for="descripcion">Elegir tipo</label>
                    <select class="form-control" id="tipo" name="tipo">
                        <option value="{{$up[0]->tipo}}"></option>
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
                        <input type="text" class="form-control" name="descrip" id="descrip" value="{{$up[0]->descrip}}">
                        <input type="text" class="form-control" name="iden" id="iden" value="{{$up[0]->id}}" style="display: none;">
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
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </form>
</div>
@endsection
