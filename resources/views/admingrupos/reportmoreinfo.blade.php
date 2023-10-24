@extends('admingrupos.adminmenu')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ route('reportegeneral') }}"><i class="fa fa-dashboard"></i> Retos Completos</a></li>
    <li><a href="{{ url('/admin/detalle/'.$idusuario) }}"><i class="fa fa-dashboard"></i> Detalle Completos</a></li>
    <li class="active">Detalle Evidencias</li>
    </ol>
</section>
@endsection

@section('reporte')

<div class="box box-default" style="margin-top: 5%;">
    <div class="box-header with-border">
        <div class="box-tools pull-right">
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">

            <h1>RETOS COMPLETOS</h1>
            
            @foreach($infocomplete as $info)

            <div class="container">
                <h3 class="col-md-12">Informacion de Usuario</h3>
                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="name">id Usuario</label>
                        <input type="text" class="form-control" value="{{ $info->id_usuario }}" disabled>                       
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group col-md-3">
                        <label for="name">Nombre Usuario</label>
                        <input type="text" class="form-control" value="{{ $info->Usuario}}" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="name">Apellido</label>
                        <input type="text" class="form-control" value="{{ $info->Apellido }}" disabled>                       
                    </div>                                    
                    <!-- /.form-group -->                    
                </div>
                <div class="row">
                    <h3 class="col-md-12">Informacion de Reto</h3>
                    <div class="form-group col-md-1">
                        <label for="name">Id Reto</label>
                        <input type="text" class="form-control" value="{{ $info->id_reto }}" disabled>                       
                    </div>                                    
                    <div class="form-group col-md-1">
                        <label for="name">Tiempo </label>
                        <input type="text" class="form-control" value="{{ $info->tiempo }}" disabled>                       
                    </div>                                    
                    <!-- /.form-group -->
                    <div class="form-group col-md-2">
                        <label for="name">Material </label>
                        <input type="text" class="form-control" value="{{ $info->material }}" disabled>                       
                    </div>                                    
                    <!-- /.form-group -->
                    <div class="form-group col-md-3">
                        <label for="name">Nombre Reto</label>
                        <input type="text" class="form-control" value="{{ $info->nombre_reto }}" disabled>                       
                    </div>                                    
                    <!-- /.form-group -->
                </div>
                <div class="row">                                     
                    <!-- /.form-group -->
                    <div class="form-group col-md-3">
                        <label for="name">Palabras</label>
                        <input type="text" class="form-control" value="{{ $info->palabras }}" disabled>                       
                    </div>                                    
                    <!-- /.form-group -->
                    <!-- /.form-group -->
                    <div class="form-group col-md-10">
                        <label for="name">Descripcion </label>
                        <textarea class="form-control" rows="5" name="desc" disabled>{{ $info->descripcion }}</textarea>            
                    </div>   
                </div>

                @if ($info->video)                    
                <div class="row">
                    <h3 class="col-md-12">Video del reto</h3>
                    <!-- /.form-group -->
                    <div class="form-group col-md-12">
                       <iframe width="600" height="315" src="{{ $info->video }}" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                   </div>  
                </div>
                @endif

                <div class="row">
                    <h3 class="col-md-12">puntos obtenidos por el usuario</h3>                                  
                    <!-- /.form-group -->
                    <div class="form-group col-md-2">
                        <label for="name">Puntos I </label>
                        <input type="text" class="form-control" value="{{ $info->I_ganados }}" disabled>                       
                    </div>                                    
                    <!-- /.form-group -->
                    <div class="form-group col-md-2">
                        <label for="name">Puntos G </label>
                        <input type="text" class="form-control" value="{{ $info->G_ganados }}" disabled>                       
                    </div>                                    
                    <!-- /.form-group -->
                </div>

                @if($info->Evidencia_Salidas)
                <div class="row">
                    <h3 class="col-md-12">Evidencias Obtenidas</h3>
                </div>
                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="name">Salidas </label>
                        <textarea class="form-control" rows="5" disabled>{{ $info->Evidencia_Salidas }}</textarea>
                    </div>                                    
                    <!-- /.form-group -->
                    <div class="form-group col-md-3">
                        <label for="name">Imagen Salidas </label>
                        <img src="{{ asset($info->imagen_Salidas)}}" width="90%">                     
                    </div>                                    
                    <!-- /.form-group -->
                </div>
                @endif

                @if($info->Evidencia_Fotografia)
                <div class="row">
                    <h3 class="col-md-12">Evidencias Obtenidas</h3>
                </div>
                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="name">Evidencia Fotografias</label>
                        <textarea class="form-control" rows="5" disabled>{{ $info->Evidencia_Fotografia }}</textarea>
                    </div>                                    
                    <!-- /.form-group -->
                    <div class="form-group col-md-3">
                        <label for="name">Fotografias</label>
                        <img src="{{ asset($info->imagen_Fotografia)}}" width="90%">                     
                    </div>                                    
                    <!-- /.form-group -->
                </div>                    
                @endif

                @if ($info->Evidencia_Lecturas)
                <div class="row">
                    <h3 class="col-md-12">Evidencias Obtenidas</h3>
                </div>
                <div class="row">                
                    <div class="form-group col-md-8">
                        <label for="name">Evidencia Lecturas</label>
                        <textarea class="form-control" rows="5" disabled>{{ $info->Evidencia_Lecturas }}</textarea>
                    </div>                                    
                    <!-- /.form-group -->
                </div>
                @endif

                @if ($info->Evidencia_videos)
                <div class="row">
                    <h3 class="col-md-12">Evidencias Obtenidas G</h3>
                </div>
                <div class="row">                    
                    <div class="form-group col-md-8">
                        <label for="name">Evidencia Videos</label>
                        <textarea class="form-control" rows="5" disabled>{{ $info->Evidencia_videos }}</textarea>                                            
                    </div>                                    
                    <!-- /.form-group -->
                </div>
                @endif
            </div>

            @endforeach   
            <!--ver outdoors--> 
           
            @foreach($infoout as $salida)

                <div class="container">
                    <h3 class="col-md-12">Informacion de Usuario</h3>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="name">id Usuario</label>
                            <input type="text" class="form-control" value="{{ $salida->id_usuario }}" disabled>                       
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group col-md-3">
                            <label for="name">Nombre Usuario</label>
                            <input type="text" class="form-control" value="{{ $salida->Usuario}}" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="name">Apellido</label>
                            <input type="text" class="form-control" value="{{ $salida->Apellido }}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->                    
                    </div>
                    <div class="row">
                        <h3 class="col-md-12">Informacion de Reto</h3>
                        <div class="form-group col-md-1">
                            <label for="name">Id Reto</label>
                            <input type="text" class="form-control" value="{{ $salida->id_reto }}" disabled>                       
                        </div>                                    
                        <div class="form-group col-md-1">
                            <label for="name">Tiempo </label>
                            <input type="text" class="form-control" value="{{ $salida->tiempo }}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->
                        <div class="form-group col-md-2">
                            <label for="name">Material </label>
                            @if($salida->material)
                            @if(strstr($salida->material, 'http:'))
                              <a href="{{$salida->material}}" target="_blank" ><h4>Ver</h4></a>   
                            @else
                               <a href="/storage/public/{{$salida->material}}" target="_blank"><h4>Ver</h4></a>   
                            @endif
                            @endif                
                        </div>                                    
                        <!-- /.form-group -->
                        <div class="form-group col-md-3">
                            <label for="name">Nombre Reto</label>
                            <input type="text" class="form-control" value="{{ $salida->nombre_reto }}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->
                    </div>
                    <div class="row">                                     
                        <!-- /.form-group -->
                        <div class="form-group col-md-3">
                            <label for="name">Palabras</label>
                            <input type="text" class="form-control" value="{{ $salida->palabras }}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->
                        <!-- /.form-group -->
                        <div class="form-group col-md-10">
                            <label for="name">Descripcion </label>
                            <textarea class="form-control" rows="5" name="desc" disabled>{{ $salida->descripcion }}</textarea>            
                        </div>   
                    </div>

                    <div class="row">
                        <h3 class="col-md-12">puntos obtenidos por el usuario</h3>
                        <div class="form-group col-md-2">
                            <label for="name">Puntos S </label>
                            <input type="text" class="form-control" value="{{round($salida->S_ganados, 2)}}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->
                        <div class="form-group col-md-2">
                            <label for="name">Puntos I </label>
                            <input type="text" class="form-control" value="{{ $salida->I_ganados }}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->
                        <div class="form-group col-md-2">
                            <label for="name">Puntos G </label>
                            <input type="text" class="form-control" value="{{ $salida->G_ganados }}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->
                    </div>

                    @if($salida->Evidencia_Salidas)
                    <div class="row">
                        <h3 class="col-md-12">Evidencias Obtenidas</h3>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label for="name">Salidas </label>
                            <textarea class="form-control" rows="5" disabled>{{ $salida->Evidencia_Salidas }}</textarea>
                        </div>                                    
                        <!-- /.form-group -->
                        <div class="form-group col-md-3">
                            <label for="name">Imagen Salidas </label>
                            @if(strstr($salida->Evidencia_Salidas, 'http:'))
                              <img src="{{ asset($salida->imagen_Salidas)}}" width="90%"> 
                            @else
                              <img src= "{{ asset('/storage/gameoutdoor/' .$salida->imagen_Salidas) }}" width="90%">
                            @endif
                                                
                           
                        </div>                                    
                        <!-- /.form-group -->
                    </div>
                     <!--link-->
                     @if($salida->video != "")
                      <div class="row">
                      <div class="form-group col-md-12" style="font-size:20px;">
                            <label for="name">Video</label>
                            <a href="{{$salida->video}}" target="_blank">Link video</a>
                        </div>
                    </div>
                    @endif
                    @endif
                </div>
                @endforeach 
            <!--end outdoors-->
            <!--ver informacion de pdfs-->
            @foreach($infolectura as $lectura)
                <div class="container">
                    <h3 class="col-md-12">Informacion de Usuario</h3>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="name">id Usuario</label>
                            <input type="text" class="form-control" value="{{ $lectura->id_usuario }}" disabled>                       
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group col-md-3">
                            <label for="name">Nombre Usuario</label>
                            <input type="text" class="form-control" value="{{ $lectura->Usuario}}" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="name">Apellido</label>
                            <input type="text" class="form-control" value="{{ $lectura->Apellido }}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->                    
                    </div>
                    <div class="row">
                        <h3 class="col-md-12">Informacion de Reto</h3>
                        <div class="form-group col-md-1">
                            <label for="name">Id Reto</label>
                            <input type="text" class="form-control" value="{{ $lectura->id_reto }}" disabled>                       
                        </div>                                    
                        <div class="form-group col-md-1">
                            <label for="name">Tiempo </label>
                            <input type="text" class="form-control" value="{{ $lectura->tiempo }}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->
                        <div class="form-group col-md-2">
                            <label for="name">Material </label>
                            @if(strstr($lectura->material, 'http:'))
                              <a href="{{$lectura->material}}" target="_blank" ><h4>Ver</h4></a>   
                            @else
                               <a href="/storage/public/{{$lectura->material}}" target="_blank"><h4>Ver</h4></a>   
                            @endif                         
                        </div>                                    
                        <!-- /.form-group -->
                        <div class="form-group col-md-3">
                            <label for="name">Nombre Reto</label>
                            <input type="text" class="form-control" value="{{ $lectura->nombre_reto }}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->
                    </div>
                    <div class="row">                                     
                        <!-- /.form-group -->
                        <div class="form-group col-md-3">
                            <label for="name">Palabras</label>
                            <input type="text" class="form-control" value="{{ $lectura->palabras }}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->
                        <!-- /.form-group -->
                        <div class="form-group col-md-10">
                            <label for="name">Descripcion </label>
                            <textarea class="form-control" rows="5" name="desc" disabled>{{ $lectura->descripcion }}</textarea>            
                        </div>   
                    </div>
                    <div class="row">
                        <h3 class="col-md-12">puntos obtenidos por el usuario</h3>
                        <div class="form-group col-md-2">
                            <label for="name">Puntos S </label>
                            <input type="text" class="form-control" value="{{round($lectura->S_ganados, 2)}}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->
                        <div class="form-group col-md-2">
                            <label for="name">Puntos I </label>
                            <input type="text" class="form-control" value="{{ $lectura->I_ganados }}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->
                        <div class="form-group col-md-2">
                            <label for="name">Puntos G </label>
                            <input type="text" class="form-control" value="{{ $lectura->G_ganados }}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->
                    </div>

                    @if ($lectura->Evidencia_Lecturas)
                    <div class="row">
                        <h3 class="col-md-12">Evidencias Obtenidas</h3>
                    </div>
                    <div class="row">                
                        <div class="form-group col-md-8">
                            <label for="name">Evidencia Lecturas</label>
                            <textarea class="form-control" rows="5" disabled>{{ $lectura->Evidencia_Lecturas }}</textarea>
                        </div>                                    
                        <!-- /.form-group -->
                    </div>
                    @endif
                </div>

                @endforeach   
            <!--end informacion pdfs-->

            <!--ver informacion de fotos-->
            @foreach($infopicture as $picture)
                <div class="container">
                    <h3 class="col-md-12">Informacion de Usuario</h3>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="name">id Usuario</label>
                            <input type="text" class="form-control" value="{{ $picture->id_usuario }}" disabled>                       
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group col-md-3">
                            <label for="name">Nombre Usuario</label>
                            <input type="text" class="form-control" value="{{ $picture->Usuario}}" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="name">Apellido</label>
                            <input type="text" class="form-control" value="{{ $picture->Apellido }}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->                    
                    </div>
                    <div class="row">
                        <h3 class="col-md-12">Informacion de Reto</h3>
                        <div class="form-group col-md-1">
                            <label for="name">Id Reto</label>
                            <input type="text" class="form-control" value="{{ $picture->id_reto }}" disabled>                       
                        </div>                                    
                        <div class="form-group col-md-1">
                            <label for="name">Tiempo </label>
                            <input type="text" class="form-control" value="{{ $picture->tiempo }}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->
                        <div class="form-group col-md-2">
                            <label for="name">Material </label>
                            <input type="text" class="form-control" value="{{ $picture->material }}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->
                        <div class="form-group col-md-3">
                            <label for="name">Nombre Reto</label>
                            <input type="text" class="form-control" value="{{ $picture->nombre_reto }}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->
                    </div>
                    <div class="row">                                     
                        <!-- /.form-group -->
                        <div class="form-group col-md-3">
                            <label for="name">Palabras</label>
                            <input type="text" class="form-control" value="{{$picture->palabras }}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->
                        <!-- /.form-group -->
                        <div class="form-group col-md-10">
                            <label for="name">Descripcion </label>
                            <textarea class="form-control" rows="5" name="desc" disabled>{{$picture->descripcion }}</textarea>            
                        </div>   
                    </div>

                    <div class="row">
                        <h3 class="col-md-12">puntos obtenidos por el usuario</h3>
                        <div class="form-group col-md-2">
                            <label for="name">Puntos S </label>
                            <input type="text" class="form-control" value="{{round($picture->S_ganados, 2)}}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->
                        <div class="form-group col-md-2">
                            <label for="name">Puntos I </label>
                            <input type="text" class="form-control" value="{{$picture->I_ganados }}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->
                        <div class="form-group col-md-2">
                            <label for="name">Puntos G </label>
                            <input type="text" class="form-control" value="{{$picture->G_ganados }}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->
                    </div>
                    @if($picture->Evidencia_Fotografia)
                    <div class="row">
                        <h3 class="col-md-12">Evidencias Obtenidas</h3>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label for="name">Evidencia Fotografias</label>
                            <textarea class="form-control" rows="5" disabled>{{$picture->Evidencia_Fotografia }}</textarea>
                        </div>    
                        <!--link--> 
                                               
                        <!-- /.form-group -->
                        <div class="form-group col-md-3">
                            <label for="name">Fotografias</label> 
                            @if(strstr($picture->imagen_Fotografia, 'http:'))
                              <img src="{{ asset($picture->imagen_Fotografia)}}" width="90%"> 
                            @else
                              <img src= "{{ asset('/storage/gamefoto/' .$picture->imagen_Fotografia) }}" width="90%">
                            @endif                  
                        </div>                                    
                        <!-- /.form-group -->
                    </div> 
                    <!--link-->
                      @if($picture->pvideo != "")
                      <div class="row">
                      <div class="form-group col-md-12" style="font-size:20px;">
                            <label for="name">Video</label>
                            <a href="{{$picture->pvideo}}" target="_blank">Link video</a>
                        </div>
                    </div>
                    @endif
                    <!--link video-->                    
                    @endif
                </div>

                @endforeach   
            <!--end informacion de fotos-->
               <!--ver informacion de quizz-->
               @if(isset($quizs[0]->nombre))
               <div class="container">
                    <h3 class="col-md-12">Informacion de Usuario</h3>
                    <div class="row">
                        <!-- /.form-group -->
                        <div class="form-group col-md-4">
                            <label for="name">Nombre Usuario</label>
                            <input type="text" class="form-control" value="{{ $quizs[0]->nombre}}" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="name">Apellido</label>
                            <input type="text" class="form-control" value="{{ $quizs[0]->apellido }}" disabled>                       
                        </div> 
                        <div class="form-group col-md-4">
                            <label for="name">Reto</label>
                            <input type="text" class="form-control" value="{{ $quizs[0]->reto }}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->                    
                    </div>
                    <div class="container">
                    <div class="table-responsive">                                      
                        <table class="table" style="width:90%;">
                            <tr>
                                <th>Pregunta</th>
                                <th>Respuesta</th>
                                <th>Correcta</th>
                            </tr>
                            @foreach($quizs as $q)
                            <tr>
                                <td class="success">{{$q->pregunta}}</td>
                                <td class="success">{{$q->respuesta }}</td>
                                @if($q->correcto != 1)
                                 <td class="success"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                @else
                                <td class="success"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                @endif
                            </tr>
                            @endforeach  
                        </table>   
                    </div>
                </div>

                    <div class="row">
                        <h3 class="col-md-12">puntos obtenidos por el usuario</h3>
                        <div class="form-group col-md-2">
                            <label for="name">Puntos S </label>
                            <input type="text" class="form-control" value="{{round($quizs[0]->s, 2)}}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->
                        <div class="form-group col-md-2">
                            <label for="name">Puntos I </label>
                            <input type="text" class="form-control" value="{{$quizs[0]->i}}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->
                        <div class="form-group col-md-2">
                            <label for="name">Puntos G </label>
                            <input type="text" class="form-control" value="{{$quizs[0]->g}}" disabled>                       
                        </div>                                    
                        <!-- /.form-group -->
                    </div>
                </div> 
            <!--end informacion de quizz-->
            @endif
        </div>
    </div>
    <!-- /.box-body -->
</div>







@endsection
