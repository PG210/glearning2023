@extends('layouts.admin')
@section('areas')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if($status)
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{$status}}
  </div>
@else

@endif

@section('titulos')

<section class="content-header">
      <h1>
        Estas en: Lista de Capitulos        
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Capitulos</li>        
      </ol>
    </section>
@endsection

@section('capitulos')

<div class="box box-default">
        <div class="box-header with-border">
            <div class="box-tools pull-right">
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-11">
                    
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre</th>            
                                    <th>Titulo</th>
                                    <th>Descripcion</th>
                                    <th>Temas</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($capitulos as $capitulo)
                                    <tr>                
                                        <td>{{ $capitulo->name }} </td>
                                        <td>{{ $capitulo->title }} </td>
                                        <td style="width: 32%;">{{ $capitulo->description }} </td>
                                        <td> <a href="{{ route('subcapitulos.show', $capitulo->id) }}" class="btn btn-block btn-warning btn-md">
                                            Ver Temas</a> 
                                        </td>                                
                                        
                                        <td>
                                            <a href="{{ route('capitulos.edit', $capitulo->id) }} ">
                                                <button type="button" class="btn btn-default" aria-label="Left Align">
                                                    <span class="fa fa-fw fa-edit" aria-hidden="true"></span>
                                                </button>
                                            </a>
                                            {{-- <form action="{{ route('capitulos.destroy', $capitulo->id ) }} " method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-default" aria-label="Left Align">
                                                    <span class="fa fa-fw fa-trash-o" aria-hidden="true"></span>
                                                </button>
                                            </form> --}}
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
