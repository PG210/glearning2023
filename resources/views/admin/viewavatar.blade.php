@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{ url('/admin/registrar/avatar') }}"><i class="fa fa-dashboard"></i>Avatars</a></li>
    <li class="active">Editar</li>
    </ol>
</section>
@endsection

@section('usuarios')

<style>
  .scrollable-container {
      width: auto;
      height: 400px;
      border: 1px solid #ccc;
      overflow-y: scroll; /* Agregar scroll vertical */
    }
</style>

<div class="box box-default" style="margin-top: 5%;">
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
             <!--table ---> 
            <div class="col-12">
            <div class="table-responsive">
            <table class="table">       
                <thead>
                    <tr>
                    <th scope="col">Imagen</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Genero</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($avatar as $a)
                    <tr>
                    <td> <!--imagen ================= -->
                        <img class="img-thumbnail" src="{{ asset($a->img)}}" alt="Cargando imagen">
                        <!-- ========== end imagen ============ --> 
                   </td>
                    <td><b>{{$a->name}}</b></td>
                    <td>
                        <div style="text-align:justify;">
                        {{$a->description}}
                        </div>
                    </td>
                    <td>{{$a->sexo}}</td>
                    <td>
                        <!-- botones--->
                           <!-- Button trigger modal -->
                            <a type="button" class="btn" data-toggle="modal" data-target="#editaravatar{{$a->id}}">
                            <i class="fa fa-pencil" aria-hidden="true" style="font-size:24px;"></i>
                             </a>

                            <!-- Modal -->
                            <div class="modal fade" id="editaravatar{{$a->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document" >
                                <div class="modal-content" style="border-radius:20px;">
                                <div class="modal-header">
                                    <h4 class="modal-title text-center" id="exampleModalLabel">Editar Avatar: {{$a->name}} - {{$a->sexo}}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('actuAvatar')}}" method="POST" enctype="multipart/form-data">
                                @csrf()
                                <div class="modal-body">
                                    <!--formulario-->
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{$a->name}}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                            <label for="genero">Genero</label>
                                            <select id="genero" name="genero" class="form-control">
                                              <option value="{{$a->sexo}}" selected>{{$a->sexo}}</option>
                                                @if(strcmp($a->sexo, "Femenino") === 0)
                                                <option value="Masculino">Masculino</option>
                                                <option value="Default">Default</option>
                                                @elseif(strcmp($a->sexo, "Masculino") === 0)
                                                <option value="Femenino">Femenino</option>
                                                <option value="Default">Default</option>   
                                                @else
                                                <option value="Femenino">Femenino</option>
                                                <option value="Masculino">Masculino</option>         
                                                @endif
                                              
                                            </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                             <label for="descrip">Dscripción</label>
                                             <textarea class="form-control" id="descrip" name="descrip" rows="5" required>{{$a->description}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                             <label for="descrip">Subir imagen</label>
                                             <input type="file" class="form-control-file" id="avat" name="avat"  accept="image/*">
                                            </div>
                                        </div>
                                        <input type="text" id="idusu" name="idusu" value="{{$a->id}}" hidden>
                                    <!--end formulario-->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                                </form>
                                </div>
                            </div>
                            </div>
                        <!---end botones -->
                    </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            <!--end table-->
            </div>                              
        </div>
    </div>
    <!-- /.box-body -->
</div>

@endsection
