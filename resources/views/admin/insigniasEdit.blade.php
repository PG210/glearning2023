@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{ url('/insignias') }}"><i class="fa fa-dashboard"></i> Insignias</a></li>
    <li class="active">Editar-Insignias</li>
    </ol>
</section>
@endsection


@section('insigniasEdit')

<!-- TRAER LA INFO ACTUAL PARA EDITAR -->
<h2>AGREGAR NUEVA INSIGNIA</h2>

<div class="box box-default" style="margin-top: 5%;">
        <form method="POST" enctype="multipart/form-data" action="{{ route('insignias.update', $insignias->id) }}">
            @csrf
            @method('PUT')
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
                            <input type="text" class="form-control" name="name" id="name" value="{{$insignias->name}}" placeholder="Nombre">
                        </div>
                        <!-- /.form-group -->                   
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <img src="{{ asset($insignias->imagen)}}" width="60px">
                        {{-- <div class="form-group">
                    
                            <label for="imagen">Imagen Insignia</label>
                            <input type="file" class="form-control" name="imagen" id="imagen">
                        </div>  --}}
                        <!-- /.form-group -->                    
                    </div>
                    <!-- /.col -->                                
                </div>
    
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                                <label for="spoints">PUNTAJE S</label>
                                <input type="text" class="form-control" name="spoints" value="{{$insignias->s_point}}" id="spoints" placeholder="spoints">                                             
                        </div>
                        <!-- /.form-group -->
                       
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                        <div class="form-group">                                                        
                            <label for="ipoints">Puntaje I</label>
                            <input type="text" class="form-control" name="ipoints" value="{{$insignias->i_point}}" id="ipoints" placeholder="ipoints">                                                        
                        </div>
                        <!-- /.form-group -->                    
                    </div>
                    <!-- /.col -->  
                    <div class="col-md-4">
                        <div class="form-group">                         
                            <label for="gpoints">Puntaje G</label>
                            <input type="text" class="form-control" name="gpoints" value="{{$insignias->g_point}}" id="gpoints" placeholder="gpoints">
                        </div>
                        <!-- /.form-group -->                    
                    </div>
                    <!-- /.col -->                                
                </div>
    
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <textarea class="form-control" rows="5" name="descripcion" id="descripcion">{{$insignias->description}}</textarea>
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
