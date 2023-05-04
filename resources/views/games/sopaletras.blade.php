@extends('layouts.sopaletras')

@section('content')
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
<?php
  $dificultad = $retos->dificult;
  $sopaletras = $retos->params; //Selecciono el dato que necesito sacar de la BD

  // Al finalizar el juego y dar click en FINALIZAR realizo el almacenamiento
  // de los datos de Unity aqui en el navgeador para enviar luego a la BD
?>

<script type="application/javascript">
  var palabra;
  var limpia='';
  var modo_juego;
  var i=0;
  
  palabra = <?php echo $sopaletras; ?>; //string largo de palabras de la base de datos
  modo_juego = <?php echo $dificultad; ?>;  //Viene de la BD y se envia a Unity valor entero 0 o 1

  for (i = 0; i < palabra.length; i++) {
    if(i==0){
      limpia = palabra[i];
    }else {
      limpia = limpia +","+ palabra[i];
    }
  }

  function senddata(value, mode){
    //procesos para mandar los valores a unity
    gameInstance.SendMessage('Board','changing_info2',value);
    gameInstance.SendMessage('Board','bool_from_web',mode);
    //iniciar procesos del juego
    gameInstance.SendMessage('Board','startLevel',0);

    document.getElementById("boton").style.visibility = 'hidden';
  }

  function codeBD(){
    document.getElementById("asdf").value= localStorage.getItem("gano");
  }

</script>




<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Bienvenido {{ Auth::user()->firstname }}
    </h1>
    <ol class="breadcrumb">

    </ol>
  </section>

  <section class="content">

    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#activity" data-toggle="tab">Reto</a></li>          
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="activity">
            <!-- Post -->
            <div class="post">
              <div class="user-block">

              <h1>COMENZANDO EL RETO - SOPA DE LETRAS</h1>
              <p style="text-align: center;">{{ $retos->description }}</p>
              
              <p>Tienes {{ $retos->time }} minutos para terminar</p>
              <tiempos-component tiempoasignado="{{ $retos->time }}"></tiempos-component>

              <div class="webgl-content">
              
              <button class="btn btn-warning btn-lg" id="boton" onclick="senddata(limpia,modo_juego)" style="visibility: hidden; width: 60%;margin-top: 1%;margin-left: 17%;margin-right: -25%;">Empezar Juego</button>
              
              <div id="unityContainer" style="width: 95%; height: 580px; margin: auto"></div>

              <form method="POST" action="{{ route('gamesplay.unitygamesplayed', 12) }}">
                @csrf
                <input type="hidden" name="valorjuego" id="asdf" value="">
                <input type="hidden" name="idretoactual" value="{{ $retos->id }}">
                <input type="hidden" name="usuario" value="{{ Auth::user()->id }}">

                <button class="btn btn-success btn-lg" id="boton_BD" style="visibility: hidden; width: 50%;margin-top: 2%;margin-left: 20%;margin-right: -25%;">COMPLETAR</button>                

              </form>

                <div class="footer">
                  <!-- <div class="webgl-logo"></div> -->
                  <!-- <div class="fullscreen" onclick="gameInstance.SetFullscreen(1)"></div> -->
               
                  <script type="application/javascript">
                    localStorage.setItem("gano",-1)
                    var test = localStorage.getItem("gano");
                  </script>
                
              </div>
              </div>

              </div>
              <!-- /.user-block -->
            </div>
            <!-- /.post -->
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="timeline">
            <!-- The timeline -->
            <ul class="timeline timeline-inverse">
              <li>
                <i class="fa fa-envelope bg-blue"></i>
                <div class="timeline-item">
                  <h3 class="timeline-header"><a href="#">Recurso </a>}</h3>
                  <div class="timeline-body">
                    Bienvenido a la Evolución
                  </div>
                </div>
              </li>
              <!-- END timeline item -->

              <li>
                <i class="fa fa-check-circle bg-gray"></i>
              </li>
            </ul>
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="settings">
            <!-- RECOMPENSAS -->
          </div>
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





@endsection
