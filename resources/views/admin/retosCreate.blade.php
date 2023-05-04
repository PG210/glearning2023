@extends('layouts.admin')

@section('titulos')
<section class="content-header">
      <h1> NUEVO RETO </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{ url('/capitulos') }}"> Capitulos</a></li>
        <li><a onclick="window.history.go(-1); return false;" style=" cursor:pointer; "> Temas</a></li>
        <li class="active">Crear Reto</li>
      </ol>
    </section>
@endsection

@section('createretos')

<h2>Estas en el Tema: {{ $subcapitulo }}</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box box-default" style="margin-top: 5%;">
    <form method="POST" enctype="multipart/form-data" action="{{ route('retos.store') }}">
      @csrf
        <div class="box-header with-border">
            <div class="box-tools pull-right">
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
              <div class="col-md-3">
                  <div class="form-group">
                      <label for="gametype">Tipo de Juego</label>
                      <select class="form-control" name="gametype" value="{{ old('gametype') }}">
                        <option value="1">Reto</option>
                        <option value="0">Versus</option>
                      </select>
                  </div>
                                                
                  <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-3">
                  <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nombre" value="{{ old('name') }}">
                  </div>
                 
                  <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-3">
                  <div class="form-group">
                      <label for="i_pts">PUNTOS I</label>
                      <input type="text" class="form-control" name="i_pts" id="i_pts" value="{{ old('i_pts') }}">            
                  </div>
                 
                  <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-3">
                  <div class="form-group">
                      <label for="g_pts">PUNTOS G</label>
                      <input type="text" class="form-control" name="g_pts" id="g_pts" value="{{ old('g_pts') }}">           
                  </div>
                 
                  <!-- /.form-group -->
              </div>
              <!-- /.col -->            
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div id="app">
                          <quizchallenge-component></quizchallenge-component>     
                        </div> 
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->                                           
            </div>

            <div class="row">
                <div class="col-md-12">                
                    <div class="form-group">
                      <label for="description">Descripcion</label>
                      <textarea class="form-control" rows="5" name="description" id="description" placeholder="Describe las Instrucciones" value="{{ old('description') }}"></textarea>
                    </div>                              
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->                                           
            </div>
            
            <div class="row">
                <div class="col-md-8" >
                    <input type="hidden" name="subchapter_id" value="{{ $subcapitulo }}">                    
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>

        </div>
        <!-- /.box-body -->
    </form>
</div>



@endsection
