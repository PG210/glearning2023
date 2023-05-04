@extends('layouts.admin')

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




<!--<div class="row">
    <div class="col-md-2" >
        <a href="{{ route('usuario.create') }}" class="btn btn-block btn-primary btn-md">Agregar Usuario</a>
    </div>
</div>
<div class="row">
    <div class="col-md-2" >
        <a href="{{ route('usuario.create') }}" class="btn btn-block btn-primary btn-md">Agregar Usuario</a>
    </div>
</div>-->
<!--botones de agregar usuarios y carga masiva-->
<div class="d-grid gap-2 d-md-block">
    <div class="col-md-2" >
   <!-- <a href="{{ route('usuario.create') }}" class="btn btn-block btn-primary btn-md">Agregar Usuario</a>-->
   <a href="{{ route('usureg_admin') }}" class="btn btn-block btn-primary btn-md">Agregar Usuario</a>
    </div>  
    <div class="col-md-2" >
    <a href="{{route('cargamasiva')}}" class="btn btn-block btn-primary btn-md">Carga Masiva</a>
    </div> 
    <div class="col-md-4" >
      
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
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Nombre_Usuario</th>
                                <th>Email</th>
                                <th>Nivel</th>
                                <th>S</th>
                                <th>G</th>
                                <th>I</th>
                                <th>Fecha_Creado</th>
                                <th>Opciones</th>  
                            </tr>
                        </thead>
                        <tbody id="tablaocu">
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->firstname }} </td>
                                    <td>{{ $user->lastname }} </td>
                                    <td>{{ $user->username }} </td>
                                    <td>{{ $user->email }} </td>

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

                                    <td>{{ $nivel[0] }} </td>

                                    <td>{{ number_format($user->s_point,0, '.', '') }} </td>
                                    <td>{{ $user->g_point }} </td>
                                    <td>{{ $user->i_point }} </td>
                                    <td>{{ $user->created_at }} </td>   
                                    
                                    <td style="width:15%;">   
                                        <a href="/home/perfil/admin/{{$user->id}}" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <form action="{{ route('usuario.destroy', $user->id ) }} " method="POST" style="display: inline-block;">
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
                         <!--aqui tabla para mostrar-->
                        <tbody id="tablamostrar"></tbody>
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
       if(arreglo.length!=0){
         $("#tablaocu").hide();
         $("#tablamostrar").empty();
        //aqui imprime los datos 
                var valor = '<tr>' +
                '<td>' + arreglo[0].firstname + '</td>' +
                '<td>' + arreglo[0].lastname + '</td>' +
                '<td>' + arreglo[0].username + '</td>' +
                '<td>' + arreglo[0].email + '</td>' +
                '<td> 0 </td>' +
                '<td>' + Math.round(arreglo[0].s_point) + '</td>' +
                '<td>' + arreglo[0].g_point + '</td>' +
                '<td>' + arreglo[0].i_point + ' </td>' +
                '<td>' + arreglo[0].created_at + '</td>' + 
                '</tr>';
            $('#tablamostrar').append(valor);
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
@endsection