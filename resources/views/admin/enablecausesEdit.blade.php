@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{ url('/causasadmin') }}"><i class="fa fa-dashboard"></i> Causas</a></li>
    <li class="active">Editar-Causas</li>
    </ol>
</section>
@endsection

@section('areasEdit')

<!-- TRAER LA INFO ACTUAL PARA EDITAR -->
<h2>PUNTAJES PARA HABILITAR CAUSAS - EDITAR</h2>
<div class="box box-default" style="margin-top: 5%;">
    <form method="POST" action="{{ route('causasadmin.update', $avaiblecausas->id) }}">
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
                    <label for="name">Puntos I</label>
                    <input type="text" class="form-control" name="puntos_i" id="puntos_i" value="{{$avaiblecausas->i_point}}" placeholder="Nombre">
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label for="name">Puntos G</label>
                    <input type="text" class="form-control" name="puntos_g" id="puntos_g" value="{{$avaiblecausas->g_point}}" placeholder="Nombre">
                </div>                              
                <!-- /.form-group -->
            </div>
            <!-- /.col -->            
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-8" >
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                    <div class="btn-group">
                    </div>
                </div>
            </div>


        </div>
        <!-- /.box-body -->
    </form>
</div>
@endsection
