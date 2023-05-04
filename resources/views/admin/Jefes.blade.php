@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <h1>ASIGNACION DE JEFES</h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Jefes</li>
    </ol>
</section>
@endsection

@section('cargos')
<div class="box box-default" style="margin-top: 5%;">
    <form method="POST" enctype="multipart/form-data" action="{{ route('jefes.store') }}">
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
                    <!-- selector multiple de usuarios para convertir en jefe o subjefe -->
                    <label for="usuarios">Usuarios</label>
                    <select class="form-control" name="usuarios" id="usuarios" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}"> {{ $user->firstname }} </option>
                        @endforeach
                    </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <!-- selector multiple de areas para asignar a los usuarios elegidos -->
                    <label for="areas">Areas</label>
                    <select multiple class="form-control" name="areas[]" id="areas" required>
                        @foreach($areas as $area)
                            <option value="{{ $area->id }}"> {{ $area->name }} </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="row">
                    <div class="col-md-8" >
                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary">Asignar Jefe</button>
                        </div>
                        <div class="btn-group">
                            <a href="{{ route('jefestipos.create') }}" class="btn btn-block btn-success btn-md">Ver Tipos de Jefes</a>
                        </div>
                    </div>
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <div class="form-group">
                    <!-- selector de los tipos de jefe que puede ser el usuario -->
                    <label for="tipojefe">TIPO DE JEFE</label>
                    <select class="form-control" name="tipojefe" id="tipojefe" required>
                        <option value="vacio"> Selecciona Tipo Jefe</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}"> {{ $type->name }} </option>
                        @endforeach
                    </select>                
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </form>
</div>



<div class="box box-default">
    <div class="box-header with-border">
        <div class="box-tools pull-right">
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-10">
                <h2>Lista de Jefes</h2>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Tipo Jefe</th>
                            <th>Areas Asignadas</th>
                            <th>Opciones</th>           
                        </tr>
                    </thead>
                    <tbody>
                
                @if(!empty($elarray))
                    @foreach($elarray as $arrai)
                        <tr>
                            <td>{{ $arrai->id}}</td>
                            <th scope="row">{{ $arrai->firstname }}</th>
                            <td>{{ $arrai->types[0]->name }}</td>

                            <td><a href="{{ route('jefes.show', $arrai->id) }}">Ver Areas</a></td>
                            <td>
                                
                                <a href="{{ route('jefes.edit', $arrai->id )}}" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i></a>                
                
                                <form action="{{ route('jefes.destroy', $arrai->id )}}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-default" aria-label="Left Align">
                                        <span class="fa fa-fw fa-trash-o" aria-hidden="true"></span>                       
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                    </tbody>
                </table>
                <!-- /.form-group -->
            </div>
            <!-- /.col -->                                
        </div>
    </div>
    <!-- /.box-body -->
</div>

@endsection
