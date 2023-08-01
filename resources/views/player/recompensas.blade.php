@extends('layouts.app')

@section('content')

<?php
  $users = App\User::find(Auth::user()->id);
  $usu =  Auth::user()->id;
  $info = DB::table('insignia_user')->join('users', 'insignia_user.user_id', '=', 'users.id')
         ->join('insignias', 'insignia_user.insignia_id', '=', 'insignias.id')
         ->where('insignia_user.user_id', $usu)
         ->select('insignia_user.id', 'insignia_user.insignia_id as idinsig', 'insignias.name', 'insignias.imagen', 'insignias.description', 'insignia_user.created_at')
         ->get();
  //insignias por capitulo
  $infoc = DB::table('insigcap_user')
         ->join('users', 'insigcap_user.userid', '=', 'users.id')
         ->join('insigniacap', 'insigcap_user.insigid', '=', 'insigniacap.id')
         ->where('insigcap_user.userid', $usu)
         ->select('insigcap_user.id', 'insigcap_user.insigid as idinsig', 'insigniacap.nombre as name',
                  'insigniacap.url as imagen', 'insigniacap.descripcion as description', 'insigniacap.created_at')
         ->get();
  
?>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Bienvenido {{ Auth::user()->firstname }}
    </h1>
    <ol class="breadcrumb">
      <!-- <li><a href="#"><i class="fa fa-dashboard"></i> Retos</a></li> -->
      <!-- <li><a href="#">Mision 1</a></li>
      <li class="active">Reto 1</li> -->
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">

        <h2>RECOMPENSAS</h2>
        <!-- <p>vista para todos los capitulos, los datos se cargan dinamicamente</p> -->
        <p>
          Aqui encontraras todas las recompensas que te han sido otorgadas en tu desarrollon de historia
        </p>
        <p>
          <h4><b>Accesorios:</b></h4>
          Los retos otorgan puntos, a ciertas cantidades de puntos el juego te recompensará con los accesorios para tu CYBORG 
        </p>
        <p>
        <h4><b>Insignias:</b></h4>
           En la medida que avances de niveles, el juego te reconocerá con insignias especiales para tu CYBORG.
        </p>
      </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
      <!-- About Me Box -->
      <!-- <div class="box box-primary">
        <h2>Acciones de Recompensas</h2>


      </div> -->
    </div>
    <!-- /.row -->

    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#insignias" data-toggle="tab" style="font-size:20px;">Insignias y Recompensas</a></li>
          {{-- <li><a href="#premios" data-toggle="tab">Accesorios</a></li> --}}
          <!-- <li><a href="#settings" data-toggle="tab">Causas</a></li> -->
        </ul>
        <div class="tab-content">
          <!-- INSIGNIAS -->
          <div class="active tab-pane" id="insignias">
            <!-- ACCESORIOS -->
            <div class="post">
              <h3>Insignias</h3>
              @foreach($info as $insignia)
              <div class="row">
                <div class="col-md-6">
                  <div class="user-block">
                    <img class="img-circle img-responsive img-bordered-sm" src="{{ asset($insignia->imagen) }}" width="100px" alt="{{($insignia->name) }}">
                    <i aria-hidden="true"></i>
                        <span class="username">
                          <span> {{($insignia->name) }}</span>
                        </span>
                    <span class="description">{{($insignia->description) }}</span>
                  </div>
              </div>
              <div class="col-md-6" style="font-size:15px;">
                  <div class="user-block">
                  {{-- <a  class="pull-right" href="https://www.linkedin.com/sharing/share-offsite/?url=https://www.it-institute.org/wp-content/uploads/2021/05/medal.png" target="_blank">
                    <i class="fa fa-linkedin-square" aria-hidden="true"></i>
                       Compartir pub
                    </a>
                    <a  class="pull-right btn btn-info" href="/evolucion/insignia/win/{{$insignia->id}}" target="_blank" style="font-size:15px;">
                       Visualizar
                    </a>
                    <!--modal-->
                     <!-- Botón para abrir el modal -->
                        <a type="button" class="pull-right" data-toggle="modal" data-target="#com{{$insignia->id}}" style="font-size:24px; padding-right:5px;"> <i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                        <!-- Modal -->
                        <div id="com{{$insignia->id}}" class="modal fade" role="dialog">
                          <div class="modal-dialog" >
                            <!-- Contenido del modal -->
                            <div class="modal-content" style="border-radius:20px;">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Compartir insignia</h4>
                              </div>
                              <div class="modal-body">
                                   <p>
                                     Por favor, introduce la URL de tu perfil de LinkedIn en el campo correspondiente para poder agregar una insignia a tu perfil.
                                  </p>
                                  <p>
                                     La URL debe seguir el siguiente formato: <b><br>https://www.linkedin.com/in/tu-nombre-de-perfil/</b></p>
                                  <p>Para obtener esta URL, ve a LinkedIn, haz clic en ver perfil, copia la URL y pégala en el campo indicado.</p> 
                                   <!--aqui debe ir-->
                                   <br>
                                   <!--colapsed-->
                                   <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                      <div class="panel-heading">
                                        <h4 class="panel-title">
                                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1">Información de insignia</a>
                                        </h4>
                                      </div>
                                      <div id="collapse1" class="panel-collapse collapse">
                                        <div class="panel-body">
                                          <p>Nombre: {{($insignia->name) }}</p> 
                                          <p>Empresa emisora: Evolución / Aprendizaje Divertido</p> 
                                          <p>Fecha expedición: {{$insignia->created_at}}</p> 
                                          <p>Fecha caducidad: Indefinido</p> 
                                          <p>ID credencial: </p> 
                                          <p>Url de la credencial: {{ asset($insignia->imagen) }} </p> 
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                   <!--end colapsed-->
                                  <label for="usuario">Url de LinkedIn:</label>
                                  <input type="text" name="urlval"  id="urlval"  class="form-control" onInput="validarInput()" />
                              </div>
                              <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal" id="btncerrar">Cerrar</button>
                                    <button onclick="compartirLinkedIn()" name="add_to_cart" id="btnCompartir" class="btn btn-info" style="display: none;">Compartir</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    <!--end modal-->
                    --}}
                  </div>
              </div>
            </div>
              @endforeach
              <!-- /.user-block -->
            </div>
            <!-- /.post -->

            <!--visualizacion de insignias por capitulo-->
            <div class="post">
              <h3>Insignias para compartir</h3>
              @foreach($infoc as $in)
                <div class="user-block">
                <div class="row">
                <div class="col-md-6">
                  <img class="img-circle img-responsive img-bordered-sm" src="/insigcap/{{$in->imagen}}" width="100px" alt="Imagen">
                  <i aria-hidden="true"></i>
                      <span class="username">
                        <a href="#"> {{($in->name) }}</a>
                      </span>
                     <span class="description">{{($in->description) }}</span>
                    <!--modal-->
                </div>
                 <div class="col-md-6">
                   <a  class="pull-right btn btn-info" href="/evolucion/insignia/win/{{$in->id}}" target="_blank" style="font-size:15px;">
                       Visualizar
                    </a>
                 </div>
                </div>
              </div>
              @endforeach
            </div>
            <!--end insignias por capitulo-->
            <!-- RECOMPENSAS -->
            <div class="post">
              <h3>Recompensas</h3>
              @foreach($users->gifts as $gift)
                <div class="user-block">
                  <img class="img-circle img-responsive img-bordered-sm" src="{{ asset($gift->imagen) }}" width="100px" alt="{{($gift->name) }}">
                  <i aria-hidden="true"></i>
                      <span class="username">
                        <span> {{($gift->name) }}</span>
                        <!--<a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>-->
                      </span>
                  <span class="description">{{($gift->description) }}</span>
                </div>
              @endforeach
              <!-- /.user-block -->
            </div>

            
          </div>
          <!-- /.tab-pane -->


          {{-- <div class="tab-pane" id="premios">
            
          </div> --}}
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.1.2
  </div>
  <strong>Copyright &copy; 2018 <a href="#">Evolución</a>.</strong> All rights
  reserved.
</footer>


<!-- ./wrapper -->

<script>
    function validarInput() {
      var btnCompartir = document.getElementById("btnCompartir");
      var btncerrar = document.getElementById("btncerrar");
      var usuarioInput = document.getElementById("urlval");

      if (!usuarioInput.value.length) {
        btnCompartir.style.display = "none";
      } else if (usuarioInput.value.includes("https://www.linkedin.com/in/")) {
        //compartirLinkedIn();
        btncerrar.style.display = "none";
        btnCompartir.style.display = "block";

      } else {
        console.log('La URL no es válida');
      }
    }
    function compartirLinkedIn() {
        var usuarioInput = document.getElementById("urlval");
        var usuario = usuarioInput.value;
        var url = usuario + "edit/forms/certification/new/?profileFormEntryPoint=PROFILE_COMPLETION_HUB";
        window.open(url, "_blank");
      }
  </script>

@endsection
