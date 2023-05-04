@extends('layouts.admin')

@section('titulos')
<section class="content-header">
      <h1>
        EDITAR RETO
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{ url('/capitulos') }}"> Capitulos</a></li>
        <li><a onclick="window.history.go(-1); return false;" style=" cursor:pointer; "> Temas</a></li>
        <li class="active">Editar Reto</li>
      </ol>
    </section>
@endsection

@section('createretos')

<div class="box box-default" style="margin-top: 5%;">
  <div class="box-header with-border">
      <div class="box-tools pull-right">
      </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
          <div class="col-md-10">
            <h2>Estas en el Tema: {{ $subcapitulo }}</h2>
              <div class="row">
                  <div class="col-md-2" >
                  </div>
              </div>

              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              
              <form method="POST" enctype="multipart/form-data" action="{{ route('retos.update', $retos->id) }}">
                @csrf
                @method('PUT')

                <div class="col-md-4">
                  <div class="form-group" style="width:90%;">
                    <label for="gametype">Tipo de Juego</label>
                    <select class="form-control" name="gametype">
                      <option value="1">Reto</option>
                      <option value="0">Versus</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" id="name" value=" {{$retos->name}} ">
                  </div>
                </div>
                <div class="col-md-12">
                  <div id="app">
                  
                    <quizchallenge-component 
                      tipodereto="{{ $retos->challenge_type_id }}" 
                      palabrasparams="{{ $retos->params }}"
                      urlvideo="{{$retos->urlvideo}}"
                      tiemporeto = "{{ $retos->time }}">
                    </quizchallenge-component>
                  
                  </div> 
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="description">Descripcion</label>
                    <textarea class="form-control" rows="5" name="description" id="description" placeholder="description">{{$retos->description}}</textarea>
                  </div>
                </div>
              
                <div class="row">
                    {{-- <div class="col-md-6">
                      <div class="box">
                        <div class="box-header">
                          <h3 class="box-title">Videos</h3>
                        </div>
                        <div class="box-body">
                          <div class="form-group">
                            <label for="name">URL Video</label>
                            <a href="{{$retos->urlvideo}}" target="_blank">Ver Video</a>
                          </div> 
                          <div class="form-group">
                            <label for="urlvideo">CAMBIAR - URL Video</label> 
                            <input type="text" name="urlvideo" id="urlvideo" placeholder="video ayuda para Reto" class="form-control">
                          </div>        
                        </div>
                      </div>
                    </div> --}}
                    <!-- /.col -->
                    {{-- <div class="col-md-6">
                      <div class="box">
                        <div class="box-header">
                          <h3 class="box-title">Materiales</h3>
                        </div>
                        <div class="box-body">
                          <div class="form-group">
                            <label for="name">Documentos</label>
                            <a href="{{$retos->material}}" target="_blank">Descargar Documento</a>
                          </div>
                          <div class="form-group">
                            <label for="material">CAMBIAR Material</label> 
                            <input type="file" name="material" id="material" placeholder="Recursos del Reto" class="form-control">
                          </div>
                        </div>
                      </div>          
                    </div> --}}
                    <!-- /.col -->
                  </div>
              
                  <div class="col-md-12">
                  </div>
                  <h2>PUNTAJES</h2>
                  <div class="col-md-12" style="margin-bottom: 2%">
                    <div class="col-md-3">
                      <label for="i_pts">PUNTOS I</label>
                      <input type="text" class="form-control" name="i_pts" id="i_pts" value="{{$retos->i_point}}">
                    </div>
                    <div class="col-md-3">
                      <label for="g_pts">PUNTOS G</label>
                      <input type="text" class="form-control" name="g_pts" id="g_pts" value="{{$retos->g_point}}">
                    </div>
                    <br><br><br>
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                  
                    <input type="hidden" name="subchapter_id" value="{{$retos->subchapter_id}}">
                  </div>
                  
              </form>                     
          </div>
          <!-- /.col -->                                
      </div>
  </div>
  <!-- /.box-body -->
</div>








@endsection
