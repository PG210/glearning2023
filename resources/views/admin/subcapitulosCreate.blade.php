@extends('layouts.admin')

@section('titulos')
<section class="content-header">
      <h1>
        NUEVO TEMA      
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{ url('/capitulos') }}"> Capitulos</a></li>
        <li class="active">Crear Tema</li>
      </ol>
    </section>
@endsection



@section('subcapitulosCreate')

<div class="box box-default" style="margin-top: 5%;">
    <form method="POST" action="{{ route('subcapitulos.store') }}">
        @csrf
        <div class="box-header with-border">
          <p>Temas para el Capitulo: {{ $capitulo }}</p>
            <div class="box-tools pull-right">
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nombre" required>
                      </div>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <div class="form-group">
                        <label for="order">Orden</label>
                        <input type="text" class="form-control" name="order" id="order" placeholder="Orden" required>
                      </div>
                </div>                               
                <!-- /.form-group -->
                <?php
                  $users = DB::table('users')->get();
                ?>
                <div class="form-group">
                  <label for="userasignado">Asignar Usuarios al Tema</label>
                  <span class="small">Selecciona uno o varios cargos</span>
                  <select multiple class="form-control" name="userasignado[]" id="userasignado">                      
                      @foreach($users as $user)
                        <option value="{{ $user->id }}"> {{ $user->firstname }} {{ $user->lastname }} </option>
                      @endforeach
                  </select>
                </div>

                <div class="form-group">
                    <label for="description">Descripcion</label>
                    <textarea class="form-control" rows="5" name="description" id="description" placeholder="Descripcion"></textarea>
                  </div>
                
                  <input type="hidden" name="chapter_id" value="{{ $capitulo }}">
               
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-group">
                        <label for="title">Titulo</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Titulo" required>
                      </div>             
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label for="time">Tiempo (Minutos)</label>
                    <input type="text" class="form-control" name="time" id="time" placeholder="Tiempo" required>
                  </div>
                <!-- /.form-group -->

                <?php
                  $competencias = DB::table('competences')->get();
                ?>
                <div class="form-group">
                  <label for="competencias">Asignar Competencia al tema</label>
                  <select class="form-control" name="competencias" id="competencias">
                      <option> Selecciona la competencia </option>
                        @foreach($competencias as $competen)
                          <option value="{{ $competen->id }}"> {{ $competen->name }} </option>
                        @endforeach
                  </select>
                </div>
                
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
