@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Cargos</li>
    </ol>
</section>
@endsection

@section('cargos')

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
            <div class="col-md-10">
                <h1>CARGOS</h1>

                <div class="row">
                    <div class="col-md-3" >
                        <a href="{{ route('cargos.create') }}" class="btn btn-block btn-primary btn-md">Nuevo Cargo</a>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Area</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cargos as $cargo)
                                <?php                
                                    $areas = App\Position::find($cargo->id);                
                                    $area = $areas->areas[0]->name;
                                ?>
                                <tr>
                                    <td>{{ $cargo->name }} </td>
                                    <td>{{ $cargo->description }} </td>
                                    <td> {{$area}}</td>
                                    <td>
                                        <a href="{{ route('cargos.edit', $cargo->id) }}" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <form action="{{ route('cargos.destroy', $cargo->id ) }} " method="POST" style="display: inline-block;">
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
