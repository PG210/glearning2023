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

        <h2>Informacion Evolución</h2>
        <!-- <p>vista para todos los capitulos, los datos se cargan dinamicamente</p> -->

        <h3>Evolución</h3>
        <p>
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
          <li class="active"><a href="#activity" data-toggle="tab">Info empresa</a></li>

        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="activity">
            <!-- Post -->
            <div class="post" style="font-size: 2.5rem; color: #9e2aa7; font-weight:600; text-align:justify;">


              <p>
                Evolución – Aprendizaje divertido es una compañía que tiene como propósito ayudar a solucionar de una manera divertida, creativa y constructivista los retos de aprendizaje de las empresas.

              </p>
                Dentro de este propósito, hemos diseñado esta plataforma de aprendizaje que busca ayudar a fortalecer de una manera entretenida las competencias asociadas al liderazgo en las personas.
              <p>
                Si deseas conocer más de nosotros, de otros servicios y metodologías te invitamos que visites nuestra pagina web:
              </p>  
              <p>
                <a href="http://www.evolucion.co/">www.evolucion.co</a>                              
              </p>
                
              <!-- <div class="user-block"> -->
                <!-- <img class="img-circle img-bordered-sm" src="{{ asset('dist/img/char_img.png')}}" alt="user image"> -->
                <!-- <i class="fa fa-circle-o" aria-hidden="true"></i> -->
                    <!-- <span class="username"> -->
                      <!-- <a href="#"> Conociendo la Interfaz</a> -->
                      <!-- <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a> -->
                    <!-- </span> -->
                <!-- <span class="description">Guia de navegacion de la interfaz de usuario - Conoceras la interfaz de usuario y sabras donde encontrar lo necesario para el desarrollo de -->
                <!-- las misiones y retos que te encontraras en el desarrollo de la historia.</span> -->
              <!-- </div> -->
              <!-- /.user-block -->
              <!-- <ul class="list-inline">
                <li>
                  <a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Hacer Reto</a>
                </li>
                <li class="pull-right">
              </ul> -->

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
