@extends('layouts.ahorcado')

@section('content')
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
<?php
  $dificultad = $retos->dificult;
  $palabraAhorcado = $retos->params; //Selecciono el dato que necesito sacar de la BD
  // Al finalizar el juego y dar click en FINALIZAR realizo el almacenamiento
  // de los datos de Unity aqui en el navgeador para enviar luego a la BD
?>


<script type="application/javascript">
  var palabra;
  var modo_juego;
  
  palabra = "<?php echo $palabraAhorcado; ?>"; //Viene de la BD y se envia a Unity
  modo_juego = "<?php echo $dificultad; ?>";  //Viene de la BD y se envia a Unity valor entero 0 o 1

  function senddata(value, mode){
    //procesos para mandar los valores a unity
    gameInstance.SendMessage('coded_web','palabra_from_web',value);
    gameInstance.SendMessage('coded_web','bool_from_web',mode);
    //iniciar procesos del juego
    gameInstance.SendMessage('coded_web','word_process');

    document.getElementById("boton").style.visibility = 'hidden';
  }

function codeBD(){
  alert(localStorage.getItem("gano"));
  document.getElementById("asdf").value= localStorage.getItem("gano");
}

</script>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Bienvenido {{ Auth::user()->firstname }}
    </h1>
    <ol class="breadcrumb">

    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

     <!-- /.row -->
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
              <h1>COMENZANDO EL RETO - AHORCADO</h1>
              <p>{{ $retos->description }}</p>

              <h5>Tienes {{ $retos->time }} minutos para terminar</h5>
              <tiempos-component tiempoasignado="{{ $retos->time }}"></tiempos-component>

              <!-- juego ahorcado -->
              <div class="webgl-content hidden-xs">
                <button class="btn btn-warning btn-lg" id="boton" onclick="senddata(palabra,modo_juego)" style="visibility: hidden; width: 50%;margin-top: 2%;margin-left: 20%;margin-right: -25%;">Empezar Juego</button>
                
                <div id="gameContainer" style="width: 95%; height: 580px; margin: auto"></div>

              <!-- se lleva el resultado a GamesController -->
              <form method="POST" action="{{ route('gamesplay.unitygamesplayed', 5) }}">
                @csrf
                <input type="hidden" name="valorjuego" id="asdf" value="">
                <input type="hidden" name="idretoactual" value="{{ $retos->id }}">
                <input type="hidden" name="usuario" value="{{ Auth::user()->id }}">

                <button class="btn btn-success btn-lg" id="boton_BD" style="visibility: hidden; width: 50%;margin-top: 2%;margin-left: 20%;margin-right: -25%;">COMPLETAR</button>                
              </form>

              <div class="footer">             

                <script type="application/javascript">
                  localStorage.setItem("gano",-1)
                  var test = localStorage.getItem("gano");
                </script>
              </div>
            </div>
              <!--aqui termina juego-->
              <!--aqui avanzar -->
                <!--pantallas xs-->
                <div class="visible-xs">
                    <div class="container">
                      <p>Este juego solamente esta disponible en pantalla de Computadora</p>
                      <form method="POST" action="{{ route('gamesplay.unitygamesplayed', 5) }}">
                        @csrf
                        <input type="hidden" name="valorjuego" id="asdf" value="1">
                        <input type="hidden" name="idretoactual" value="{{ $retos->id }}">
                        <input type="hidden" name="usuario" value="{{ Auth::user()->id }}">

                        <button class="btn btn-success btn-lg" id="boton_BD" style="width: 50%;margin-top: 2%;margin-left: 20%;margin-right: -25%;">CONTINUAR</button>                
                      </form>
                    </div>
                </div>
                <!--end pantallas xs-->
              <!--end avanzar-->
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
                  <h3 class="timeline-header"><a href="#">Recurso </a></h3>
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
