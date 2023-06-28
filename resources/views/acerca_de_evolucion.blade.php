@extends('layouts.app')

@section('content')
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

        <h2>Información</h2>
        <!-- <p>vista para todos los capitulos, los datos se cargan dinamicamente</p> -->

        <!--<h3>Evolución</h3>-->
        <p style="font-size:20px;">
          Acerca de Evolución - Aprendizaje divertido
        </p>        

      </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
      <!-- About Me Box -->
      <!-- <div class="box box-primary">
        <h2>Acciones de Versus</h2>


      </div> -->
    </div>
    <!-- /.row -->

    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#activity" data-toggle="tab" style="font-size:20px;">Info empresa</a></li>

        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="activity">
            <!-- Post -->
            <div class="post" style="font-size: 2.5rem; color: #9e2aa7; font-weight:600; text-align:justify; font-family:effortless; font-weight:0px;">
              
            <div style="background-image:url('dist/img/chapter01_bg.jpg');">
              <br>
              <div class="hidden-xs" style="color:white; width: 600px; height: 400px; border-radius: 20px; background-color:#021056; margin: 0 auto; margin-top: 5px; opacity: 0.8;  border-left: 6px solid #00CCFF; border-top: 6px solid #00CCFF;">
                 <div style="padding: 20px;">
                  <p style="font-size:20px;"> <span style="color:#00CCFF; font-size:23px;">Evolución – Aprendizaje divertido </span> es una compañía que tiene como propósito ayudar a solucionar de una manera divertida, creativa y constructivista los retos de aprendizaje de las empresas. </p>
                  <p style="font-size:20px;">
                     Dentro de este propósito, hemos diseñado esta plataforma de aprendizaje que busca ayudar a fortalecer de una manera entretenida las competencias asociadas al liderazgo en las personas.
                  </p>
                  <p style="font-size:20px;">
                    Si deseas conocer más de nosotros, de otros servicios y metodologías te invitamos que visites nuestra pagina web:
                 </p>
                 <p style="text-align:right;"><a href="https://www.evolucion.co/" style="text-decoration:none; color:#00CCFF;" target="_blank">www.evolucion.co</a></p>
                </div>
                </div>
                <!--pantallas peques-->
                <div class="visible-xs" style="color:white; width: auto; height: auto; border-radius: 15px; background-color:#021056; margin: 0 auto; margin-top: 5px; opacity: 0.8;  border-left: 6px solid #00CCFF; border-top: 6px solid #00CCFF;">
                 <div style="padding: 20px;">
                  <p style="font-size:20px;"> <span style="color:#00CCFF; font-size:23px;">Evolución – Aprendizaje divertido </span> es una compañía que tiene como propósito ayudar a solucionar de una manera divertida, creativa y constructivista los retos de aprendizaje de las empresas. </p>
                  <p style="font-size:20px;">
                     Dentro de este propósito, hemos diseñado esta plataforma de aprendizaje que busca ayudar a fortalecer de una manera entretenida las competencias asociadas al liderazgo en las personas.
                  </p>
                  <p style="font-size:20px;">
                    Si deseas conocer más de nosotros, de otros servicios y metodologías te invitamos que visites nuestra pagina web:
                 </p>
                 <p style="text-align:right;"><a href="https://www.evolucion.co/" style="text-decoration:none; color:#00CCFF;" target="_blank">www.evolucion.co</a></p>
                </div>
                </div>
                <!--end pantallas -->
              <br>
            </div>

            </div>
            <!-- /.post -->
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
