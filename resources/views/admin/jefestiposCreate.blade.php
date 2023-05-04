@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <h1>TIPOS DE JEFES</h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{ url('/jefes') }}"> Jefes</a></li>
        <li class="active">Editar-Tipos-Jefes</li>
    </ol>
</section>
@endsection

@section('cargos')
<div class="box box-default" style="margin-top: 5%;">
    <div class="box-header with-border">
        <div class="box-tools pull-right">
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-10">        
                <div class="box-body table-responsive no-padding">
                
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tipo Jefe</th>
                                <th>Mensaje</th>
                                <th>Puntos I</th>           
                                <th>Puntos G</th>           
                            </tr>
                        </thead>
                        <tbody>
                    
                    @if(!empty($jefestipos))
                        @foreach($jefestipos as $jefestipo)
                            <tr>
                                <th scope="row">{{ $jefestipo->name }}</th>
                                <td>{{ $jefestipo->message }}</td>
                                <td>{{ $jefestipo->i_point }}</td>
                                <td>{{ $jefestipo->g_point }}</td>
                                <td>                
                                    <a href="{{ route('jefestipos.edit', $jefestipo->id )}}" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i></a>                
                                    {{-- <form action="{{ route('jefestipos.destroy', $jefestipo->id )}}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-default" aria-label="Left Align">
                                           <span class="fa fa-fw fa-trash-o" aria-hidden="true"></span>                       
                                        </button>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    @endif
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
