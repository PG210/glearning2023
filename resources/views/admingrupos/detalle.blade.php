@extends('admingrupos.adminmenu')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ route('reportegeneral') }}"><i class="fa fa-dashboard"></i> Retos Completos</a></li>
    <li class="active">Completos</li>
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
            <div class="col-md-12">
                <h1>RETOS COMPLETOS</h1>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Parametros</th>
                                <th>Puntos S</th>
                                <th>Puntos I</th>
                                <th>Puntos G</th>
                                <th>Tipo</th>
                                <th> Ver</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($retos as $reto)
                                
                                @switch($reto->gametype)
                                    @case(1)
                                        <?php $tiporeto="Reto"; ?>                                    
                                        @break
                                    @case(0)
                                        <?php $tiporeto="Versus"; ?>                                    
                                        @break
                                    @default
                                        
                                @endswitch
                    
                                <tr>
                                    <td> {{ $reto->name }} </td>                
                                    <td>{{ $reto->params }} </td>
                                    <td>{{ $reto->s_point }} </td>
                                    <td>{{ $reto->i_point }} </td>
                                    <td>{{ $reto->g_point }} </td>
                                    <td>{{ $tiporeto }} </td>
                                    <td>
                                        <form action="{{ route('masdet') }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            id del reto {{ $reto->id }}
                                            <input type="hidden" name="usuario" value="{{ $usuarioreto }}">   
                                            <input type="hidden" name="idreto" value="{{ $reto->id }}">   
                                            <button type="submit" class="btn btn-default" aria-label="Left Align">
                                                <span class="fa fa-search" aria-hidden="true"></span>
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
