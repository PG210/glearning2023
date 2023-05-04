@extends('layouts.rompecabezas')

@section('content')
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
<?php
  $dificultad = $retos->dificult;
  $palabraAhorcado = $retos->material; //Selecciono el dato que necesito sacar de la BD

  // Al finalizar el juego y dar click en FINALIZAR realizo el almacenamiento
  // de los datos de Unity aqui en el navgeador para enviar luego a la BD
?>


<script type="text/javascript">
  var urlImg;
  urlImg = "<?php echo $palabraAhorcado; ?>"; //Viene de la BD y se envia a Unity

  var modo_juego;
  modo_juego = "<?php echo $dificultad; ?>";  //Viene de la BD y se envia a Unity valor entero 0 o 1

  function senddata(value, mode){
    //procesos para mandar los valores a unity
    gameInstance.SendMessage('Board','palabra_from_web',value);
    gameInstance.SendMessage('Board','bool_from_web',mode);
    //iniciar procesos del juego
    gameInstance.SendMessage('Board','webserviceInicialize');
    document.getElementById("boton").style.visibility = 'hidden';
  }
  function codeBD(){
    //alert(localStorage.getItem("gano"));
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
    <div class="col-md-12" style="float:inherit">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#activity" data-toggle="tab">Reto</a></li>

        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="activity">
            <!-- Post -->
            <div class="post">
              <div class="user-block">

                <h1>COMENZANDO EL RETO - ROMPECABEZAS</h1>
                <h3>{{ $retos->description }}</h3>
                
                <p>Tienes {{ $retos->time }} minutos para terminar</p>
                <tiempos-component tiempoasignado="{{ $retos->time }}"></tiempos-component>

              <!-- juego ahorcado -->
              <div class="webgl-content">
                <div id="gameContainer" style="width: 95%; height: 580px; margin: auto"></div><br>
                <button class="btn btn-warning btn-lg" id="boton" onclick="senddata(urlImg,modo_juego)" style="visibility: hidden; width: 60%;margin-top: 1%;margin-left: 29%;margin-right: -25%;">Empezar Juego</button>

                <form method="POST" action="{{ route('gamesplay.unitygamesplayed', 5) }}">
                  @csrf
                  <input type="hidden" name="valorjuego" id="asdf" value="">
                  <input type="hidden" name="idretoactual" value="{{ $retos->id }}">
                  <input type="hidden" name="usuario" value="{{ Auth::user()->id }}"><br>
                  <button class="btn btn-success btn-lg" id="boton_BD" style="visibility: hidden; width: 60%;margin-top: 1%;margin-left: 29%;margin-right: -25%;">COMPLETAR</button>
                </form>
                <div class="footer">
                  <input type="hidden" id="asdf" value="">
                  <script>
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
