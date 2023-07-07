
@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{ url('/insignias') }}"><i class="fa fa-dashboard"></i> Insignias</a></li>
    <li class="active">Actualizar</li>
    </ol>
</section>
@endsection

@section('insigniaCreate')

<h2>ACTUALIZAR INSIGNIA</h2>

<!--mensaje-->
@if(Session::has('msj'))
    <div class="alert alert-warning alert-dismissible" role="alert">
    {{Session('msj')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
@endif

        
<!--end mensaje-->
<div class="box box-default" style="margin-top: 5%;">
    <form method="POST" enctype="multipart/form-data" action="{{ route('actuignias') }}">
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
                      <input type="text" class="form-control" name="name" id="name" value="{{$bus[0]->nombre}}">
                    </div>
                    <!-- /.form-group -->                   
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-group">
                          <label for="imagen">Imagen Insignia</label>
                          <input type="file" class="form-control" name="ruta" id="ruta" accept="image/*">
                        </div>              
                    </div>
                    <!-- /.form-group -->                    
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-group">
                          <label for="imagen">Capitulo</label>
                          <input type="number" class="form-control" name="cap" id="cap" min="1" value="{{$bus[0]->capitulo}}">
                        </div>              
                    </div>
                    <!-- /.form-group -->                    
                </div>
                <!-- /.col -->                                
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="descripcion">Descripcion</label>
                      <textarea class="form-control" rows="5" name="des" id="des" value="{{$bus[0]->descripcion}}">{{$bus[0]->descripcion}}</textarea>
                    </div>
                    <!-- /.form-group -->                   
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="descripcion">Horas</label>
                      <input class="form-control" name="horas" id="horas"  value="{{$bus[0]->horas}}">
                    </div>
                    <!-- /.form-group -->                   
                </div>
                <!-- /.col -->                              
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="descripcion">Insignia</label><br>
                      <img src="/insigcap/{{$bus[0]->url}}" alt="Imagen pequeña" class="img-thumbnail" width="30%;">
                      <input name="id" value="{{$bus[0]->id}}" hidden>
                    </div>
                    <!-- /.form-group -->                   
                </div>
            </div>
            <div class="row">
                <div class="col-md-8" >
                    <div class="btn-group">
                        <button type="submit" class="btn btn-success" >Guardar</button>
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

