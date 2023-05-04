@extends('layouts.admin')

@section('titulos')
<section class="content-header">
      <h1>
        Estas en: Lista de Tema        
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{ url('/capitulos') }}"> Capitulos</a></li>
        <li class="active">Temas</li>
      </ol>
    </section>
@endsection

@section('capitulos')

<div class="box box-default" style="margin-top: 5%;">
    <div class="box-header with-border">
        <div class="box-tools pull-right">
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-10">
                <h3>AGREGAR TEMAS A:</h3>
                <h2>CAPITULO: {{ $capitulos->title }}</h2>
                                
                <?php
                    $subcapitulos = DB::table('subchapters')->where('chapter_id', $capitulos->id)->get();
                ?>
                
                <div class="row">
                    <div class="col-md-4" >
                        <a href="{{ route('subcapitulos.pasarcapitulo', $capitulos->id ) }}" class="btn btn-block btn-warning btn-md">
                        <span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Tema</a>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Titulo</th>
                                <th>orden</th>
                                <th>Total Usuarios</th> 
                                <th>Total P_I</th>
                                <th>Total P_G</th>
                                <th>Retos</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subcapitulos as $subcap)
                    
                            <?php            
                                $sumapuntosi = DB::table('challenges')->where('subchapter_id', $subcap->id)->sum('i_point');
                                $sumapuntosg = DB::table('challenges')->where('subchapter_id', $subcap->id)->sum('g_point');
                                $totalusuarios = DB::table('subchapter_user')->where('subchapter_id', $subcap->id)->count();            
                            ?>
                                <tr>
                                    <td>{{ $subcap->name }} </td>
                                    <td>{{ $subcap->title }}</td>
                                    <td>{{ $subcap->order }}</td> 
                                    <td>{{$totalusuarios}} </td>
                                    <td>{{$sumapuntosi}}</td>
                                    <td>{{$sumapuntosg}}</td>
                                    <td> <a href="{{ route('retos.show', $subcap->id) }}" class="btn btn-block btn-success btn-md"> 
                                     Agregar Retos
                                    </a> </td>  
                                    <td>
                                        <a href="{{ route('subcapitulos.edit', $subcap->id) }} ">
                                            <button type="button" class="btn btn-default" aria-label="Left Align">
                                                <span class="fa fa-fw fa-edit" aria-hidden="true"></span> Asignar Usuarios
                                            </button>
                                        </a>
                                        <a href="{{ route('subcapitulos.edit', $subcap->id) }} ">
                                            <button type="button" class="btn btn-warning" aria-label="Left Align">
                                                <span class="fa fa-fw fa-edit" aria-hidden="true"></span> Editar Tema
                                            </button>
                                        </a>
                                        {{-- <form action="{{ route('subcapitulos.destroy', $subcap->id ) }} " method="POST" style="display: inline-block;">
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
