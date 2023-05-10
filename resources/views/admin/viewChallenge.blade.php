@extends('layouts.admin')


@section('titulos')
<section class="content-header">
      <h1>
        RESUMEN RETOS
      </h1>
      
@endsection

@section('areas')



<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Reto</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">    
    <div class="row">
    
      <div class="col-md-3">
        <div class="form-group">
          <label>Nombre:</label>
          {{$retos->name}}
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <label>Dificultad:</label>
          {{$retos->dificult}}
        </div>              
      </div>

      
      <div class="col-md-3">
        <div class="form-group">
          <label>Creado en:</label>
          {{$retos->created_at}}
        </div>
      </div>
    </div>


    <div class="row">

      <div class="col-md-3">
        <div class="form-group">
          <label>Tiempo (Minutos):</label>
          {{$retos->time}}
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <label>Tipo de Reto:</label>
          {{$tiporeto[0]->name}}
        </div>
      </div>

    </div>
    
    <div class="row">      
      <div class="col-md-3">
        <div class="form-group">
          <label>Puntos S:</label>
          {{$retos->s_point}}
        </div>
      </div>
  
      <div class="col-md-3">
        <div class="form-group">
          <label>Puntos I:</label>
          {{$retos->i_point}}
        </div>
      </div>
  
      <div class="col-md-3">
        <div class="form-group">
          <label>Puntos G:</label>
          {{$retos->g_point}}
        </div>
      </div>
    </div>


    <div class="row">        
      <div class="col-md-3">
        <div class="form-group">
          <label>Material:</label> 
          @if (!$retos->material)
            <a href="#">Sin Material</a>       
          @else
           @if(strstr($retos->material, 'http:'))
            <a href="{{$retos->material}}" class="btn btn-default" target="_blank">
              <i class="fa fa-file" aria-hidden="true">.</i>
            </a>
            <a href="{{$retos->material}}" target="_blank"> Descargar Documento</a>  
            @else
             <a href="/storage/public/{{$retos->material}}" class="btn btn-default" target="_blank">
              <i class="fa fa-file" aria-hidden="true">.</i>
             </a>
            <a href="/storage/public/{{$retos->material}}" target="_blank"> Descargar Documento</a>
            @endif  
          @endif        
        </div>
      </div>         
      <div class="col-md-4">
          @if ($retos->urlvideo)            
            <div class="form-group">
              <label>Video Material:</label>          
              <a href="{{$retos->urlvideo}}" target="_blank">Ver Video</a>
            </div>
            <div class="embed-responsive embed-responsive-16by9">
                <video class="embed-responsive-item" controls>
                    <source src="{{ asset('/storage/public/videos/' .$retos->urlvideo) }}" type="video/mp4">
                </video>
            </div>
            <!-- /.form-group -->
          @endif               
      </div>
      <div class="col-md-3">
        @if ($retos->params)
          <div class="form-group">
            <label>Parametros:</label>
            {{$retos->params}}
          </div>
          <!-- /.form-group -->            
        @endif
      </div> 
    </div>

    <!-- /.row -->
  </div>
  <!-- /.box-body -->    
</div>

@endsection