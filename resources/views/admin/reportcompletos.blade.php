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
                  <!---modal--->
                    <!-- Botón para abrir el modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reportes">Reportes</button>
                    <!-- Modal -->
                    <div id="reportes" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <!-- Contenido del modal -->
                        <div class="modal-content"  style="border-radius:20px;">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Generar reporte de respuestas por grupo</h4>
                          </div>
                          <div class="modal-body">
                            <!--tabla--->
                            <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th>Grupo</th>
                                    <th>Descargar archivo</th>
                                  </tr>
                                </thead>
                                <tbody>
                                 @foreach($grup as $gmodal)
                                  <tr>
                                    <td>{{$gmodal->descrip}}</td>
                                     <td>
                                        <a href="/generar/respuestas/nuevo/{{$gmodal->id}}" type="button" class="btn btn-success btn-md">Descargar</a>
                                      </td>
                                  </tr>
                                  @endforeach
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
                  <!--end modal-->
                  <!---####################################################---->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#filtrar">Filtrar</button>
                    <!-- Modal -->
                    <div id="filtrar" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <!-- Contenido del modal -->
                        <div class="modal-content"  style="border-radius:20px;">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Filtrar Por Grupos</h4>
                          </div>
                          <form method="POST" action="{{route('valFormu')}}">
                          <div class="modal-body">
                            <!--filtro-->
                                  @csrf
                                  <div class="form-row">
                                    <div class="col-md-12">
                                    <select id="idfiltro" name="idfiltro" class="form-control">
                                        <option value="todos">Todos</option>
                                        @foreach($grup as $g)
                                        <option value="{{$g->id}}">{{$g->descrip}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            <!--end filtrar-->
                            <br>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                            <button class="btn btn-success float-right" type="submit">Filtrar</button>
                          </div>
                          </form>
                        </div>

                      </div>
                    </div>
                  <!--end modal-->
                  <!---###################################################----->
               </div>  
                <div class="col-md-4" >
                 
                </div> 
                <div class="col-md-4" >
                <!--buscar-->
                <form action="{{route('consultarter')}}" method="POST">
                 @csrf
                    <div class="form-row">
                        <div class="col-md-8">
                        <input type="email" class="form-control" placeholder="Ingrese correo" id="dato" name="dato" required>
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
                                <th>Grupo</th>
                                <th>Nivel</th>
                                <th>Porcentaje</th>
                                <th>Puntos S</th>
                                <th>puntos I</th>
                                <th>puntos G</th>
                                <th>Retos</th>
                            </tr>
                        </thead>
                        <tbody id="tablaocu">
                            @foreach($usuarios as $user)  
                                <tr>      
                                    <td>{{ $user->firstname }} {{ $user->lastname }} </td>                
                                    <td>{{ $user->username }} </td>
                                    <td>{{$user->descrip}}</td>
                                    <td>{{$niveles[$user->id] ?? 0}}</td>
                                    <td>
                                    <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                        <h5 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$user->id}}">Ver mas ...</a>
                                        </h5>
                                        </div>
                                        <div id="collapse{{$user->id}}" class="panel-collapse collapse">
                                        <div class="panel-body">
                                           <!--porcentajes-->
                                           @foreach($bus as $b)
                                                @if($b['usuario'] == $user->id )
                                                <?php
                                                $por = ($b['tcom']*100)/$b['ttotal'];
                                                $red = round($por, 1);
                                                ?>
                                                <span>Cap:</span> {{$b['capitulo']}} => {{$red}} <br>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="<?= $red ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $red ?>%; background-color:#25c5ab; color:black;">
                                                        <?= $red ?>%
                                                    </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                           <!--end porcntajes-->
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                    </td>
                                    <td>{{ round($user->s_point, 2) }} </td>
                                    <td>{{ $user->i_point }} </td>
                                    <td>{{ $user->g_point }} </td>
                                    <td><a type="button" class="btn btn-warning" href="{{ route('reportcompletos.show', $user->id) }}">
                                          Completados</a></td>
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
       console.log(arreglo);
       var conta=0;
       /*
       if(arreglo.length!=0){
        //$calculonivel = $useravatar->s_point / 100;
        // $nivel = explode(".", $calculonivel); 
        var calculonivel = Math.round(arreglo[0].s_point)/100;
        var cniv = calculonivel.toString();
        var nivel = cniv.split(".");
         $("#tablaocu").hide();
         $("#tablamostrar").empty();
        //aqui imprime los datos 
                var valor = '<tr>' +
                '<td>' + arreglo[0].firstname + ' ' + arreglo[0].lastname + '</td>' +
                '<td>' + arreglo[0].username + '</td>' +
                '<td>' + arreglo[0].descrip + '</td>' +
                '<td>' + nivel[0]+ ' </td>' +
                '<td>' + nivel[0]+ ' </td>' +
                '<td>' + Math.round(arreglo[0].s_point) + '</td>' +
                '<td>' + arreglo[0].i_point + ' </td>' +
                '<td>' + arreglo[0].g_point + '</td>' +
                '<td> <a href="/reportcompletos/retos/'+arreglo[0].id+'" class="btn btn-warning">Completados</a> </td>' + 
                '</tr>';
                
            $('#tablamostrar').append(valor);
            toastr.success('Username: ' + arreglo[0].username +'&nbsp;', 'Usuario encontrado', {timeOut:3000});
        //finalizar impresion datos
       
      }else{
         $("#tablaocu").show();
         toastr.warning('Lo sentimos!', 'Datos no encontrados', {timeOut:3000});
       }
      */   
    }).fail(function(jqXHR, response){
        $("#tablaocu").show();
        $("#tablamostrar").empty();
        toastr.warning('Lo sentimos!', 'Datos no encontrados', {timeOut:3000});
       
      });
  });
  //###########################################
  $(document).ready(function() {
  $("#filter-icon").click(function() {
    $("#filter-select").toggle();
    });
  });
 </script> 


@endsection
