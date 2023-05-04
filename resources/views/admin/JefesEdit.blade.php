@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <h1>EDITAR JEFE</h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{ url('/jefes') }}"> Jefes</a></li>
        <li class="active">Editar-Jefes</li>
    </ol>
</section>
@endsection

@section('cargos')
<div class="row">
    <div class="col-md-2" >
    </div>
</div>

<div class="box box-default" style="margin-top: 5%;">
    <form method="POST" action="{{ route('jefes.update', $userjefe->id) }}">
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
                   <!-- selector multiple de usuarios para convertir en jefe o subjefe -->
                  <div class="form-group">
                      
                      <h2>{{ $boostochnge->firstname }} {{ $boostochnge->lastname }}</h2>
                      {{-- <select class="form-control" name="usuario" id="usuario">            
                          <option value="{{ $userjefe->id }}"> {{ $userjefe->firstname }} </option>
                      </select> --}}
                      
                      <input type="hidden" name="usuario" id="usuario" value="{{ $boostochnge->id }}">
                  </div>
                </div>

                <?php
                  $tiposjefes = DB::table('types')->get();                  
                  $areas = DB::table('areas')->get();
                ?>

                <!-- /.form-group -->
                <div class="form-group">
                     <!-- selector multiple de areas para asignar a los usuarios elegidos -->
                    <label for="areas">Areas</label>
                    <select multiple class="form-control" name="areas[]" id="areas">
                        @foreach($areas as $area)
                            <option value="{{ $area->id }}" {{ ($area->id == $userjefe->pivot->id_areas) ? 'selected' : '' }} > {{ $area->name }} </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="row">
                    <div class="col-md-8" >
                        <div class="btn-group">
                            <button type="submit" class="btn btn-default">Actualizar</button>
                        </div>                     
                    </div>
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <div class="form-group">
                     <!-- selector de los tipos de jefe que puede ser el usuario -->
                    <label for="tipojefe">TIPO DE JEFE</label>
                    <select class="form-control" name="tipojefe" id="tipojefe">
                      @foreach($tiposjefes as $tiposjefe)     
                        <option value="{{$tiposjefe->id}}" {{ ($tiposjefe->id == $userjefe->pivot->type_id) ? 'selected' : '' }}> {{$tiposjefe->name}} </option>
                      @endforeach
                    </select>               
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </form>
</div>
@endsection
