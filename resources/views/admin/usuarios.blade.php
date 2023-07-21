@extends('layouts.admin')

<style>
    .modal-body-scroll {
        max-height: calc(100vh - 200px);
        overflow-y: auto;
    }
</style>

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Usuarios</li>
    </ol>
</section>
@endsection


@section('usuarios')

@if($status)
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{$status}}
    </div>
@else

@endif

<h1>USUARIOS</h1>
@if(Session::has('grup'))
<br>
    <div class="alert alert-warning alert-dismissible fade in" role="alert" style="border-radius:15px;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <strong>{{Session('grup')}}</strong> 
    </div>
    @endif
<!--botones de agregar usuarios y carga masiva-->
<div class="d-grid gap-2 d-md-block">
    <div class="col-md-2" >
   <!-- <a href="{{ route('usuario.create') }}" class="btn btn-block btn-primary btn-md">Agregar Usuario</a>-->
   <a href="{{ route('usureg_admin') }}" class="btn btn-block btn-md btn-warning">Agregar Usuarios</a>
    </div>  
    <div class="col-md-2" >
    <a href="{{route('cargamasiva')}}" class="btn btn-block btn-primary btn-md">Carga Masiva</a>
    </div> 
    <div class="col-md-2" >
    <!---modal para desactivar grupos-->
    <button type="button" class=" btn btn-block btn-md" data-toggle="modal" data-target="#descat" style="background-color:#ff3b30; color:white; border-color: #af1249; border-width: 0 0 5px;">
        Desactivar
    </button>
    <div class="modal fade" id="descat" role="dialog">
        <div class="modal-dialog ">
            <div class="modal-content" style="border-radius:20px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Desactivar usuarios por grupo.</h4>
                </div>
                <div class="modal-body modal-body-scroll">
                    <p>Usted puede restringir el ingreso de todos los usuarios pertenecientes a un grupo.</p>
                     <!--tabla-->
                     <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Grupo</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($grupos as $gr)
                                <tr>
                                    <td>{{$gr->descrip}}</td>
                                    @if($gr->estado_grup == 1)
                                    <td>
                                        <a href="/activar/grupo/{{$gr->id}}" class="btn btn-success">Activado</a>
                                    </td>
                                    @else
                                    <td>
                                        <a href="/activar/grupo/{{$gr->id}}" class="btn btn-info">Desactivado</a>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                                <!-- Agrega más filas según sea necesario -->
                            </tbody>
                        </table>
                    </div>
                     <!--end tabla-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
            
        </div>
    </div>
    <!--end modal para descativar grupos-->
    </div>
    <div class="col-md-2" >
    </div>
    <div class="col-md-4" >
    <!--buscar-->
     <form id="buscar">
       @csrf
        <div class="form-row">
            <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Ingrese correo" id="dato">
            </div>
            <div class="col-md-4">
            <button class="btn btn-success float-right" type="submit">Buscar</button>
            </div>
        </div>
        </form>
        <!--end buscar-->
    </div>
</div>
<br>
<!--end botones-->

<div class="box box-default" style="margin-top: 5%;">
    <div class="box-header with-border">
        <div class="box-tools pull-right">
        </div>
    </div>

    <!--Mensaje de eliminar usuarios-->
    <div class="container-fluid">
    @if(Session::has('eliminado'))
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{{session('eliminado')}}</strong> 
    </div>
    @endif
    </div>
    <!--mensaje de eliminar usuarios-->
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" >
                        <thead>
                            <tr>
                                <th>Nombres</th>
                                <th>Nombre_Usuario</th>
                                <th>Email</th>
                                <th>Estado</th>
                                <th>Grupo</th>
                                <th>Nivel</th>
                                <th>S</th>
                                <th>G</th>
                                <th>I</th>
                                <th>Fecha_Creado</th>
                                <th >Opciones</th>  
                                
                            </tr>
                        </thead>
                        <tbody id="tablaocu">
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                                    <td>{{ $user->username }} </td>
                                    <td>{{ $user->email }}</td>
                                    @if($user->estado != 0)
                                    <td>Activo</td>
                                    @else
                                    <td><span  style="background-color:yellow;">Inactivo</span></td>
                                    @endif
                                    {{-- buscar el nivel del jugador --}}
                                    <?php
                                        $useravatar = App\User::find($user->id);

                                        $calculonivel = $useravatar->s_point / 100;
                                        // $nivel = number_format($calculonivel, 1);

                                        $nivel = explode(".", $calculonivel);

                                        $spointceiled = ceil($useravatar->s_point);
                                        $nivelbarra = $spointceiled % 100;
                                        $nivelbarra = ceil($nivelbarra);

                                        if ($nivelbarra == 0 && $useravatar->s_point == 0) {
                                            $nivelbarra = 0;
                                            $nivel = explode(".", $calculonivel);

                                        }elseif ($nivelbarra == 0) {
                                            $nivelbarra = 100;
                                            $nivel = explode(".", $calculonivel);
                                        }
                                    ?>
                                    <td>{{ $user->descrip }} </td>
                                    <td>{{ $nivel[0] }} </td>
                                 
                                    <td>{{ number_format($user->s_point,0, '.', '') }} </td>
                                    <td>{{ $user->g_point }} </td>
                                    <td>{{ $user->i_point }} </td>
                                    <td>{{ $user->created_at }} </td>   
                                    
                                    <td style="width:25%;">   
                                        <a href="/home/perfil/admin/{{$user->id}}" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    @if($user->username != "admin")
                                        <!--desactivar usuario -->
                                        <a type="button" class="btn btn-default" data-toggle="modal" data-target="#deshabilitar{{$user->id}}">
                                           <i class="fa fa-user-times" aria-hidden="true"></i>
                                       </a>
                                       <!--eliminar usuario-->
                                       <a type="button" class="btn btn-default" data-toggle="modal" data-target="#eliminar{{$user->id}}">
                                         <span class="fa fa-fw fa-trash-o" aria-hidden="true"></span>
                                       </a>
                                       <!--end eliminar usuario-->
                                    @endif
                                        <!-- Modal -->
                                        <div class="modal fade" id="deshabilitar{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content" style="border-radius:20px;">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">Deshabilitar/Habilitar Usuario: {{ $user->username }}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Al deshabilitar un usuario, este no puede ingresar a la plataforma, pero toda su información sera conservada.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                                                <a href="/deshabilitar/usuario/{{$user->id}}" type="button" class="btn btn-primary">Continuar</a>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        <!--end desactivar-->
                                         <!-- Modal eliminar -->
                                         <div class="modal fade" id="eliminar{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content" style="border-radius:20px;">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">Eliminar Usuario: {{ $user->username }}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Al eliminar un usuario, este no puede ingresar a la plataforma y toda su información sera eliminada de la base de datos.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                                                <a href="/eliminar/usuario/{{$user->id}}" type="button" class="btn btn-primary">Continuar</a>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        
                                        <!--end modal eliminar-->
                                    </td>
    
                                </tr>
                            @endforeach
                        </tbody>
                         <!--aqui tabla para mostrar-->
                        <tbody id="tablamostrar"></tbody>
                        <!--aqui modal deshabilitar javascript-->
                        <div class="modal fade" id="deshabilitars" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content" style="border-radius:20px;">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">Deshabilitar/Habilitar Usuario: </h4>
                                </div>
                                <div class="modal-body">
                                    <p>Al deshabilitar un usuario, este no puede ingresar a la plataforma, pero toda su información sera conservada.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                                    <a href="/deshabilitar/usuario/" id="userLink" type="button" class="btn btn-primary">Continuar</a>
                                </div>
                                </div>
                            </div>
                            </div>
                            <!--end modal deshabilitar javascript-->
                       <!--aqui modal eliminar javascript-->
                        <div class="modal fade" id="eliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content" style="border-radius:20px;">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">Eliminar Usuario: </h4>
                                </div>
                                <div class="modal-body">
                                    <p>Al eliminar un usuario, este no puede ingresar a la plataforma y toda su información sera eliminada de la base de datos.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                                    <a href="/eliminar/usuario/" id="userLinkelim" type="button" class="btn btn-primary">Continuar</a>
                                </div>
                                </div>
                            </div>
                            </div>
                            <!--end modal desh javascript-->
                        <!--end tabla para mostrar-->
                    </table>
                </div>
               {{$users->links()}} <!--aqui imprime la paginacion --->

                            
            </div>
            <!-- /.col -->                                
        </div>
    </div>
    <!-- /.box-body -->
</div>

<script>
 $('#alert').on('closed.bs.alert', function () {
  // do something…
  $().alert();
  $().alert('close');
})
</script>

<script>
  /*tomamos la información del formulario y la enviamos a la ruta y de la ruta al controlador*/
  $('#buscar').submit(function(e){
    e.preventDefault();
    var dato=$('#dato').val();
    console.log(dato);
    var _token = $('input[name=_token]').val();
    console.log(_token);
    $.ajax({
      url:"{{route('buscar_usuario')}}",
      type: "POST",
      data:{
        dato:dato,
        _token:_token,
      }
    }).done(function(response){
       var arreglo = JSON.parse(response);
       var conta=0;
       var userLink = document.getElementById('userLink');
       var userLinkelim = document.getElementById('userLinkelim');
       if(arreglo.length!=0){
         $("#tablaocu").hide();
         $("#tablamostrar").empty();
        //aqui imprime los datos 
            if(arreglo[0].estado != 0){
                var valor = '<tr>' +
                '<td>' + arreglo[0].firstname + ' ' + arreglo[0].lastname + '</td>' +
                '<td>' + arreglo[0].username + '</td>' +
                '<td>' + arreglo[0].email + '</td>' +
                '<td>' + 'Activo' + '</td>' +
                '<td>' + arreglo[0].descrip + '</td>' +
                '<td> 0 </td>' +
                '<td>' + Math.round(arreglo[0].s_point) + '</td>' +
                '<td>' + arreglo[0].g_point + '</td>' +
                '<td>' + arreglo[0].i_point + ' </td>' +
                '<td>' + arreglo[0].created_at + '</td>' + 
                '<td> <a href="/home/perfil/admin/'+arreglo[0].id+'" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i></a>'+ ' ' +
                     '<a type="button" class="btn btn-default" data-toggle="modal" data-target="#deshabilitars"><i class="fa fa-user-times" aria-hidden="true"></i></a>'+ ' '+
                     '<a type="button" class="btn btn-default" data-toggle="modal" data-target="#eliminar"><span class="fa fa-fw fa-trash-o" aria-hidden="true"></span></a>'+
                 '</td>' + 
                '</tr>';
            }else{
                var valor = '<tr>' +
                '<td>' + arreglo[0].firstname + ' ' + arreglo[0].lastname + '</td>' +
                '<td>' + arreglo[0].username + '</td>' +
                '<td>' + arreglo[0].email + '</td>' +
                '<td>' + '<span style="background-color:yellow;">Inactivo</span>' + '</td>' +
                '<td>' + arreglo[0].descrip + '</td>' +
                '<td> 0 </td>' +
                '<td>' + Math.round(arreglo[0].s_point) + '</td>' +
                '<td>' + arreglo[0].g_point + '</td>' +
                '<td>' + arreglo[0].i_point + ' </td>' +
                '<td>' + arreglo[0].created_at + '</td>' + 
                '<td> <a href="/home/perfil/admin/'+arreglo[0].id+'" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i></a>'+ ' ' +
                     '<a type="button" class="btn btn-default" data-toggle="modal" data-target="#deshabilitars"><i class="fa fa-user-times" aria-hidden="true"></i></a>'+ ' '+
                     '<a type="button" class="btn btn-default" data-toggle="modal" data-target="#eliminar"><span class="fa fa-fw fa-trash-o" aria-hidden="true"></span></a>'+
                 '</td>' + 
                '</tr>';
            }
            $('#tablamostrar').append(valor);
            userLink.href = "/deshabilitar/usuario/" + arreglo[0].id; //envia dinamicamente al href
            userLinkelim.href = "/eliminar/usuario/" + arreglo[0].id;
            
            toastr.success('Username: ' + arreglo[0].username +'&nbsp;', 'Usuario encontrado', {timeOut:3000});
        //finalizar impresion datos
       }else{
         $("#tablaocu").show();
         toastr.warning('Lo sentimos!', 'Datos no encontrados', {timeOut:3000});
       }
         
    }).fail(function(jqXHR, response){
        $("#tablaocu").show();
        $("#tablamostrar").empty();
        toastr.warning('Lo sentimos!', 'Datos no encontrados', {timeOut:3000});
       
      });
  });
 </script> 
 <!--abrir modal-->
<!--end-->
@endsection