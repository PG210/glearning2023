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
      EDITAR CAPITULO    
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Editar Capitulos</li>        
    </ol>
  </section>
@endsection


@section('capitulosCreate')

<!-- INFO ACTUAL PARA EDITAR -->
<h2>EDITAR CAPITULO</h2>

<form method="POST" action="{{ route('capitulos.update', $capitulos->id) }}" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="form-group">
    <label for="name">Nombre</label>
    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" placeholder="Nombre" value="{{$capitulos->name}}">
    @if ($errors->has('name'))
      <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('name') }}</strong>
      </span>
    @endif    
  </div>

  <div class="form-group">
    <label for="title">Titulo</label>
    <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" id="title" placeholder="Titulo" value="{{$capitulos->title}}">
    @if ($errors->has('title'))
      <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('title') }}</strong>
      </span>
    @endif  
  </div>

  {{-- <div class="form-group">
    <label for="tiempo">Tiempo (Minutos)</label>
    <input type="text" class="form-control{{ $errors->has('time') ? ' is-invalid' : '' }}" name="time" id="tiempo" placeholder="tiempo para completar">
    @if ($errors->has('time'))
      <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('time') }}</strong>
      </span>
    @endif 
  </div> --}}

  <div class="form-group">
    <label for="orden">Orden</label>
    <input type="text" class="form-control{{ $errors->has('order') ? ' is-invalid' : '' }}" name="order" id="orden" placeholder="Orden del capitulo" value="{{$capitulos->order}}">
    @if ($errors->has('order'))
      <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('order') }}</strong>
      </span>
    @endif 
  </div>

  <div class="form-group">
    <label for="descripcion">Descripcion</label>
    <textarea class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="5" name="desc" id="description" placeholder="Descripcion">{{$capitulos->description}}</textarea>
    @if ($errors->has('desc'))
      <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('desc') }}</strong>
      </span>
    @endif 
  </div>
  <!--editar video-->
  <div class="form-group">
  <div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6">
  <div class="embed-responsive embed-responsive-16by9">
      <video class="embed-responsive-item" controls>
        <source src="{{ asset('/storage/public/videos/' .$capitulos->videoIntro) }}" type="video/mp4">
      </video>
    </div>
  </div>
  <div class="col-md-3"></div>
  </div>
  </div>
  <div class="form-group">
    <label for="descripcion">Url Video</label>
    <input type="file" class="form-control" name="video" id="video" value="{{$capitulos->videoIntro}}">
  </div>
  <!---end editar-->
  <button type="submit" class="btn btn-default">Guardar</button>
</form>

@endsection
