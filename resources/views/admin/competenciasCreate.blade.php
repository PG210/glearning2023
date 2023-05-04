@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{ url('/competencias') }}"><i class="fa fa-dashboard"></i> Competencias</a></li>
    <li class="active">Crear-Competencias</li>
    </ol>
</section>
@endsection


@section('competencias')

<h2>AGREGAR NUEVA COMPETENCIA</h2>

<div class="box box-default" style="margin-top: 5%;">
    <form method="POST" enctype="multipart/form-data" action="{{ route('competencias.store') }}">
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
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nombre">
                          </div>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <textarea class="form-control" rows="5" name="descripcion" id="descripcion"></textarea>
                          </div>
                    </div>                               
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                                    
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->                                
            </div>
          
            <div class="row">
                <div class="col-md-8" >
                    <div class="btn-group">
                        <button type="submit" class="btn btn-default">Guardar</button>
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