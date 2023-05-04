@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <h1>
    Estas en: Lista de Retos        
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{ url('/capitulos') }}"> Capitulos</a></li>
    <li><a href="{{ url('/subcapitulos/'.$subcapitulos->chapter_id) }}" style="cursor:pointer;"> Temas</a></li>
    <li class="active">Retos</li>
    </ol>
</section>
@endsection

@section('retos')

@if($status)
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{$status}}
  </div>
@else

@endif

<div class="box box-default" style="margin-top: 5%;">
    <div class="box-header with-border">
        <div class="box-tools pull-right">
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-11">
                <h2>TEMA: {{ $subcapitulos->title }}<span style="font-size:18px;"> - {{ $subcapitulos->name }}</span></h2>

                <?php
                    $retos = DB::table('challenges')->where('subchapter_id', $subcapitulos->id)->get();
                ?>
                
                <div class="row">
                    <div class="col-md-3" >
                        <a href="{{ route('retos.pasarsubcapitulo', $subcapitulos->id ) }}" class="btn btn-block btn-success btn-md">
                        <span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Retos</a>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover"> 
                        <thead> 
                            <tr> 
                                <th>Codigo Reto</th>
                                <th>Nombre</th>
                                <th>Puntos I</th>
                                <th>Puntos G</th>
                                <th>Descripcion</th>
                                <th>Ver</th>
                                <th>Tipo</th>
                                <th>Opciones</th>
                            </tr> 
                        </thead> 
                    
                        <tbody>        
                            @foreach($retos as $reto)       
                                <tr> 
                                    <td>{{ $reto->id }}</td>
                                    <td>{{ $reto->name }}</td> 
                                    <td>{{ $reto->i_point}}</td>
                                    <td>{{ $reto->g_point}}</td>
                                    <td>{{ $reto->description }}</td>
                                    <td><a href="{{ route('retos.datosreto', $reto->id) }}" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></a></td>
                                    <td>                                        
                                        @switch($reto->gametype)
                                            @case(1)
                                                <span class="label label-info"> Reto </span>                        
                                                @break
                                            @case(0)
                                                <span class="label label-warning"> Versus </span>
                                                @break
                                        @endswitch            
                                    </td> 
                                    <td style="width:15%;">                    
                                        <a href="{{ route('retos.edit', $reto->id) }}" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <form action="{{ route('retos.destroy', $reto->id ) }} " method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-default" aria-label="Left Align">
                                                <span class="fa fa-fw fa-trash-o" aria-hidden="true"></span>
                                            </button>
                                        </form>
                                    </td>
                                </tr> 
                            @endforeach       
                        </tbody> 
                    </table>             
                </div>
            </div>
            <!-- /.col -->                                
        </div>
    </div>
    <!-- /.box-body -->
</div>
@endsection

