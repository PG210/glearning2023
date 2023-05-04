@extends('layouts.admin')

@section('cargos')
<h1>ASIGNACION DE JEFES</h1>

<div class="row">
    <div class="col-md-2" >
    </div>
</div>


<div class="box box-default" style="margin-top: 5%;">
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
                            <th>Area</th>
                        </tr>
                    </thead>
                    <tbody>                                    
                        @if(!empty($areas))
                            @foreach($areas as $area)    
                                <?php
                                $namearea = DB::table('areas')->where('id', $area->id_areas)->get();                            
                                ?>
                                <tr>
                                    <td>{{ $namearea[0]->name }}</td>
                                    <td>
                                        {{-- <button type="button" class="btn btn-default" aria-label="Left Align">
                                            <a href=""><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        </button> --}}

                                        {{-- <form action="{{ route('jefesareas.destroy', $namearea[0]->id )}}" method="POST" style="display: inline-block;">
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
             <!-- /.form-group -->
            </div>
            <!-- /.col -->                                
        </div>
    </div>
    <!-- /.box-body -->
</div>
@endsection
