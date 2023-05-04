@extends('layouts.admin')

@section('cargos')

<!-- TRAER LA INFO ACTUAL PARA EDITAR -->
<h2>EDITAR TIPO DE JEFE</h2>
<div class="box box-default" style="margin-top: 5%;">
    <form method="POST" action="{{ route('jefestipos.update', $jefestipos->id) }}">
        @csrf
        @method('PUT')
        <div class="box-header with-border">
            <div class="box-tools pull-right"></div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Tipo Jefe</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$jefestipos->name}}" placeholder="Nombre">
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="ipoints">Puntaje I</label>
                        <input type="text" class="form-control" name="i_point" id="ipoints" value="{{$jefestipos->i_point}}" placeholder="i points">
                    </div>                    
                    <!-- /.form-group -->          
                </div>
                <!-- /.col -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="gpoints">Puntaje G</label>
                        <input type="text" class="form-control" name="g_point" id="gpoints" value="{{$jefestipos->g_point}}" placeholder="g points">           
                    </div>
                    <!-- /.form-group -->          
                </div>
                <!-- /.col -->                                
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="descripcion">Mensaje</label>
                        <textarea rows="4" cols="50" class="form-control" name="message" id="descripcion" placeholder="Descripcion">{{$jefestipos->message}}</textarea>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->                                    
            </div>
          
            <div class="row">
                <div class="col-md-8" >
                    <div class="btn-group">
                        <button type="submit" class="btn btn-default">Actualizar Tipo</button>
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
