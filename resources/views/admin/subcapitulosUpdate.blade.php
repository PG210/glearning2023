@extends('layouts.admin')


@section('titulos')
<section class="content-header">
      <h1>
        EDITAR TEMA        
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{ url('/capitulos') }}"> Capitulos</a></li>
        <li class="active">Editar Tema</li>
      </ol>
    </section>
@endsection


@section('subcapitulosCreate')

<h2>Editar Tema</h2>


<div class="box box-default">
  <form method="POST" action="{{ route('subcapitulos.update', $subcapitulo->id) }}">
    @csrf

    @method('PUT')
    <input type="hidden" name="chapter_id" value="{{ $subcapitulo->chapter_id }}">
    
    <div class="box-header with-border">      
      <div class="box-tools pull-right">    
      </div>  
    </div>
    <!-- /.box-header -->
    <div class="box-body">    
      <div class="row">
        <div class="col-md-12">              
          <div class="col-md-3">                              
            <div class="form-group">            
              <label for="name">Nombre</label>             
              <input type="text" class="form-control" name="name" id="name" value="{{$subcapitulo->name}}" placeholder="Nombre">             
            </div>            
          </div>             
            <!-- /.form-group -->
              
            <div class="col-md-3">                
                <div class="form-group">
                  <label for="order">Orden</label>
                  <input type="text" class="form-control" name="order" id="order" value="{{$subcapitulo->order}}" placeholder="Orden">
                </div> 
              </div>      
              
              <!-- ASIGNAR COMPETENCIAS -->
              <?php
                $competencias = DB::table('competences')->get();
              ?>
              
              <div class="col-md-4">
                <label for="competencias">Asignar Competencia al Tema</label>
                <select class="form-control" name="competencias" id="competencias">
                  <option> Selecciona la competencia </option>
                    @foreach ($competencias as $item)
                      <option value="{{ $item->id }}" {{ ($item->id == $subcapitulo->competence_id) ? 'selected' : '' }}> {{ $item->name }} </option>
                    @endforeach    
                </select>
              </div>

              
            </div>
            <!-- /.col -->            
            <div class="col-md-12">              
              <div class="col-md-3">
                
                <div class="form-group">
                    <label for="title">Titulo</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{$subcapitulo->title}}" placeholder="Titulo">
                  </div>            
              </div>
              <!-- /.form-group -->
              
              <div class="col-md-3">                  
                <div class="form-group">
                    <label for="time">Tiempo (Minutos)</label>
                    <input type="text" class="form-control" name="time" id="time" value="{{$subcapitulo->time}}" placeholder="Tiempo">
                  </div>
                  <!-- /.form-group -->
                </div>
            </div>

            <div class="col-md-10" style="margin-bottom: 2%;">                
              <div class="form-group">
                     <!-- MOSTRAR USUARIOS ASIGNADOS A SUBCAPITULO -->
                      <?php
                      $users = DB::table('users')->get();
                      $relatedusers = DB::table('subchapter_user')->where('subchapter_id', $subcapitulo->id)->distinct()->get();
                      
                      //======obtener ID de los usuarios relacionaos al subcapitulo elegido=======
                      $arrayrelacionados = array();
                      foreach ($relatedusers as $relateuser) {        
                        $arrayrelacionados[] = $relateuser->user_id;
                      }

                      //===== obtener usuarios que no han sido relacionados con el subcapitulo elegido ========
                      $nonrealacinados = array();
                      foreach ($users as $user) {
                        if (!in_array($user->id, $arrayrelacionados) ) {
                          $nonrealacinados[] = $user;
                        }
                      }
                    ?>
                    @if(!$relatedusers->isEmpty())
                      
                        {{-- <label for="userasignado">Asignar Usuarios al subcapitulo</label>
                        <select multiple class="form-control" name="userasignado[]" id="userasignado">
                            @foreach($relatedusers as $related)
                              @foreach($users as $user)                         
                                @if($user->id === $related->user_id)
                                  <option value="{{ $user->id }}" selected> {{ $user->firstname }}  {{ $user->lastname }} </option>               
                                @endif
                              @endforeach
                            @endforeach               
                            @foreach($nonrealacinados as $nonrelate)
                              <option value="{{ $nonrelate->id }}"> {{ $nonrelate->firstname }}  {{ $nonrelate->lastname }} </option>
                            @endforeach
                        </select> --}}


                        {{-- INICIA SUPERTABLA --}}                        
                        <div id="example_wrapper" class="dataTables_wrapper">
                          <label for="userasignado">Asignar Usuarios al Tema</label>                         
                            <table id="example" class="table table-striped table-bordered" style="width: 100%;" role="grid" aria-describedby="example_info">                                
                              <div class="row" style="padding-bottom: 2%">                                
                                <div class="col-md-2">                          
                                  <a class="btn btn-default" value="Todos" id="checked_all" onclick="selectAll()"><i class="fa fa-check-square-o" aria-hidden="true"></i></a>                                                                            
                                  <a class="btn btn-default" value="Todos" id="clear_all" onclick="clearAll()"><i class="fa fa-close" aria-hidden="true"></i></a>                                
                                </div>
                              </div>
                              <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Seleccion: activate to sort column descending" style="width: 131px;">Seleccion</th>            
                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Cod: activate to sort column ascending" style="width: 210px;">Cod</th>
                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Nombre: activate to sort column ascending" style="width: 98px;">Nombre</th>
                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Apellido: activate to sort column ascending" style="width: 41px;">Apellido</th>        
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($relatedusers as $related)
                            @foreach($users as $user)                         
                                @if($user->id === $related->user_id)
                                <tr role="row" class="odd">
                                    <td class="sorting_1"> <input type="checkbox" name="userasignado[]" id="" value="{{ $user->id }}" checked> </td>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->firstname }}</td>
                                    <td>{{ $user->lastname }}</td>                                    
                                </tr> 
                                @endif
                            @endforeach
                            @endforeach               
                            @foreach($nonrealacinados as $nonrelate)                                  
                            <tr role="row" class="odd">    
                                <td class="sorting_1"> 
                                  <input type="checkbox" name="userasignado[]" id="" value="{{ $nonrelate->id }}">
                                </td>
                                <td>{{ $nonrelate->id }}</td>
                                <td>{{ $nonrelate->firstname }}</td>
                                <td>{{ $nonrelate->lastname }}</td>                                    
                            </tr>                               
                            @endforeach
                        </tbody>
                        </table>
                        </div>
                        {{-- INICIA SUPERTABLA --}}
                    @else
                    
                      
                      <div class="form-group">                          
                        {{-- <label for="userasignado">Asignar Usuarios al subcapitulo</label>
                        <select multiple class="form-control" name="userasignado[]" id="userasignado">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"> {{ $user->firstname }} {{ $user->lastname }} </option>                
                            @endforeach    
                        </select> --}}


                        {{-- INICIA SUPERTABLA --}}
                        
                        <div id="example_wrapper" class="dataTables_wrapper">
                            <label for="userasignado">Asignar Usuarios al tema </label>
                            <table id="example" class="table table-striped table-bordered" style="width: 100%;" role="grid" aria-describedby="example_info">    
                                
                              <div class="row" style="padding-bottom: 2%">
                                    
                                  <div class="col-md-2">                          
                                      <a class="btn btn-default" value="Todos" id="checked_all" onclick="selectAll()"><i class="fa fa-check-square-o" aria-hidden="true"></i></a>                                                                            
                                      <a class="btn btn-default" value="Todos" id="clear_all" onclick="clearAll()"><i class="fa fa-close" aria-hidden="true"></i></a>                                
                                    </div>
                                  </div>
                              <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Seleccion: activate to sort column descending" style="width: 131px;">Seleccion</th>            
                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Cod: activate to sort column ascending" style="width: 210px;">Cod</th>
                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Nombre: activate to sort column ascending" style="width: 98px;">Nombre</th>
                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Apellido: activate to sort column ascending" style="width: 41px;">Apellido</th>        
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)                         
                                <tr role="row" class="odd">
                                    <td class="sorting_1"> <input type="checkbox" name="userasignado[]" id="" value="{{ $user->id }}"> </td>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->firstname }}</td>
                                    <td>{{ $user->lastname }}</td>                                    
                                </tr> 
                            @endforeach
                        </tbody>
                        </table>
                        </div>
                        {{-- INICIA SUPERTABLA --}}

                      </div>
                    @endif
                </div>
                <!-- /.form-group -->

            </div>
            <!-- /.col -->

          <hr>
            
          <div class="col-md-10" >                
            <div class="form-group">
              <label for="description">Descripcion</label>
              <textarea class="form-control" rows="5" name="description" id="description" placeholder="Descripcion">{{$subcapitulo->description}}</textarea>
            </div>
          </div>
        </div>
            
        <div class="col-md-8" >                  
          <div class="btn-group">
              <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </div>
          <!-- /.row -->
      </div>
      <!-- /.box-body -->
    </form>
<script>

  $(document).ready(function() {
    $('#example').DataTable( {
        "language": {
            "lengthMenu": "Mostrar _MENU_ Filas",
            "zeroRecords": "No se encontraron registros - sorry",
            "info": "Mostrar pagina _PAGE_ of _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(Filtre por maximo _MAX_ total records)"
        },
        "paging": false
    });
});

  </script>
</div>
@endsection