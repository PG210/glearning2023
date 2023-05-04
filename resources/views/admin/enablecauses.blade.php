@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Causas</li>
    </ol>
</section>
@endsection


@section('insignias')

<div class="box box-default" style="margin-top: 5%;">
    <div class="box-header with-border">
        <div class="box-tools pull-right">
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-10">
                            
            <h1>HABILITAR CAUSAS por cantidad de puntos</h1>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Puntos I</th>
                            <th>Puntos G</th>                        
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($avaiblecausas as $avaible)
                            <tr>
                                <td>{{ $avaible->i_point }} </td>
                                <td>{{ $avaible->g_point }} </td>
                                <td>
                                    <a href="{{ route('causasadmin.edit', $avaible->id) }}" class="btn btn-default">
                                        <i class="fa fa-pencil" aria-hidden="true"></i></a>                                
                                </td>
                            </tr>
                        @endforeach
    
                    </tbody>
                </table>  

            </div>

            <div class="panel panel-primary"> 
                <div class="panel-heading"> 
                    <h3 class="panel-title">Habilitar Causas.</h3> 
                </div> 
                <div class="panel-body"> Edita los puntos con los cuales cada usuario tendra acceso a las causas desde su panel personal. </div> 
            </div>

            </div>
            <!-- /.col -->                                
        </div>
    </div>
    <!-- /.box-body -->
</div>

@endsection
