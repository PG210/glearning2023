@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Completos</li>
    </ol>
</section>
@endsection


@section('usuarios')
<div class="box box-default" style="margin-top: 5%;">
    <div class="box-header with-border">
        <div class="box-tools pull-right">
        </div>
    </div>
    <!-- /.box-header -->
           <!--end botones-->
             <div class="d-grid gap-2 d-md-block">
                <div class="col-md-4" >
                 <a href="{{route('creartxt')}}" type="button" class="btn btn-success btn-md">Generar</a>
                 <a href="/informe/archivo.txt" type="button" class="btn btn-primary" download>Download</a>
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
    
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <h1>RETOS COMPLETOS </h1>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Nombre de Usuario</th>
                                <th>Email</th>
                                <th>Nivel Actual</th>
                                <th>Puntos S</th>
                                <th>puntos I</th>
                                <th>Retos</th>
                            </tr>
                        </thead>
                        <tbody id="tablaocu">
                            @foreach($usuarios as $user)

                                
                                <tr>
                                    
                                    <td>{{ $user->firstname }} {{ $user->lastname }} </td>                
                                    <td>{{ $user->username }} </td>
                                    <td>{{ $user->email }} </td>

                                    <?php 
                                    $numeroiduser = $user->id;                                
                                    $currentlevel = DB::select("SELECT chapters.id, chapters.name, chapters.title FROM challenge_user INNER JOIN challenges ON challenge_user.challenge_id = challenges.id INNER JOIN subchapters ON challenges.subchapter_id = subchapters.id INNER JOIN chapters ON subchapters.chapter_id = chapters.id where user_id = '$numeroiduser' and challenge_id = (SELECT max(challenge_id) FROM challenge_user)");
                                    $currentlevel = json_encode($currentlevel);                                  
                                   ?>
                                    <td>{{$currentlevel}}</td>
                                    <td>{{ round($user->s_point, 2) }} </td>
                                    <td>{{ $user->i_point }} </td>
                                    <td><a href="{{ route('reportcompletos.show', $user->id) }}">Completados</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tbody id="tablamostrar"></tbody>
                    </table>        
                </div>
            </div>
            <!-- /.col  se agrego un div mas-->    
        </div>
    </div>
    <!-- /.box-body -->
</div>
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
                '<td> <a href="/reportcompletos/retos/'+arreglo[0].id+'" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></a> </td>' + 
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
