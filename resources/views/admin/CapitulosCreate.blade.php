@extends('layouts.admin')


@section('titulos')


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<section class="content-header">
      <h1>
        AGREGAR NUEVO CAPITULO        
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Nuevo Capitulos</li>        
      </ol>
    </section>
@endsection


@section('capitulosCreate')

<div class="box box-default">
    <form method="POST" action="{{ route('capitulos.store') }}">
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
                    <label for="name">Nombre del Capitulo</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nombre">
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label for="orden">Orden</label>
                    <input type="text" class="form-control" name="order" id="orden" placeholder="Orden del capitulo">           
                </div>          
                <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">Titulo</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Titulo">
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label for="tiempo">Tiempo (Minutos)</label>
                    <input type="text" class="form-control" name="time" id="tiempo" placeholder="tiempo para completar">
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-12">               
              <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <textarea class="form-control" rows="5" name="description" id="description" placeholder="Descripcion"></textarea>
              </div>
            </div>

            </div>
            <div class="row">
                <div class="col-md-8" >
                    <div class="btn-group">
                        <button type="submit" class="btn btn-default">Guardar Capitulo</button>
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
