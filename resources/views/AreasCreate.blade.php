@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Crear-Area</li>
    </ol>
</section>
@endsection


@section('areasCreate')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h2>AGREGAR NUEVA ÁREA</h2>
<div class="box box-default" style="margin-top: 5%;">
    <form method="POST" action="{{ route('areas.store') }}">
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
                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" name="name" id="name" placeholder="Nombre">
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
            <div class="col-md-12">
                <div class="form-group">
                    <label for="descripcion">Descripcion</label>
                    <textarea class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="5" name="desc" value="{{ old('desc') }}" id="descripcion" placeholder="Descripcion"></textarea>            
                    @if ($errors->has('desc'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('desc') }}</strong>
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
