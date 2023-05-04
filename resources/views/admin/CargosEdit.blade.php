@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{ url('/cargos') }}" style="cursor:pointer;"> Cargos</a></li>
    <li class="active">Editas-Cargos</li>
    </ol>
</section>
@endsection

@section('cargosEdit')

<!-- TRAER LA INFO ACTUAL PARA EDITAR -->
<h2>EDITAR CARGO</h2>
<div class="box box-default" style="margin-top: 5%;">
    <form method="POST" action="{{ route('cargos.update', $cargos->id) }}">
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
                    <input type="text" class="form-control" name="name" id="name" value="{{$cargos->name}}" placeholder="Nombre">           
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <!-- selector de los tipos de jefe que puede ser el usuario -->
                     <label for="tipojefe">Pertenece al Area:</label>
                     <select class="form-control" name="area">
                         @foreach($areas as $area)
                             <option value="{{ $area->id }}"> {{ $area->name }} </option>
                         @endforeach
                     </select>
                 </div>                              
                <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-12">
                <div class="form-group">
                    <label for="descripcion">Descripcion</label>
                    <textarea rows="4" cols="50" class="form-control" name="desc" id="descripcion" placeholder="Descripcion">{{$cargos->description}}</textarea>
                </div>
                <!-- /.form-group -->
           
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-8" >
                    <div class="btn-group">
                        <button type="submit" class="btn btn-default">Guardar</button>
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
