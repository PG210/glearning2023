@extends('layouts.admin')


@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Nuevo-Cargo</li>
    </ol>
</section>
@endsection


@section('cargosCreate')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h2>AGREGAR NUEVO CARGO</h2>
<div class="box box-default" style="margin-top: 5%;">
    <form method="POST" action="{{ route('cargos.store') }}">
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
                   <!-- selector de los tipos de jefe que puede ser el usuario -->
                    <label for="tipojefe">Pertenece al Area:</label>
                    <select class="form-control" name="area">
                        @foreach($areas as $area)
                            <option value="{{ $area->id }}"> {{ $area->name }} </option>
                        @endforeach
                    </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label for="descripcion">Descripcion</label>
                  <textarea rows="4" cols="50" value="{{ old('desc') }}" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" name="desc" id="descripcion" placeholder="Descripcion"></textarea>
                  @if ($errors->has('desc'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('desc') }}</strong>
                      </span>
                  @endif

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
                <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text"value="{{ old('name') }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" placeholder="Nombre">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif


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
