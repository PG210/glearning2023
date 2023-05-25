@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/magic-master/magic.css') }}">

<style>
  .nofin{
    display: none;
    color: #e61b1b;
  }
</style>

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
      Lo sentimos {{ Auth::user()->firstname }}
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

     <!-- /.row -->

    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#activity" data-toggle="tab">GAME OVER</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="activity">
            <!-- Post -->
            <div class="post">
              <div class="user-block">
                  <h1 class="nofin">RETO FALLIDO</h1>
                  <h3>Necesitas mas del 80% para superar la Prueba</h3>
                  <p>Intentalo de nuevo mas adelante</p>
              </div>
              <script type="application/javascript">
                setTimeout(function(){
                  $('.nofin').css("display","block").delay(500);
                  $('.nofin').addClass('magictime boingInUp');
                }, 1500);
              </script>
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


<audio controls autoplay>
  <source src="https://commondatastorage.googleapis.com/codeskulptor-demos/riceracer_assets/music/win.ogg" type="audio/ogg">
</audio>
<div class="modal modal-info fade in" id="modal-info" style="display: block; padding-right: 15px;">
  <div class="modal-dialog" style="border-radius: 27px; width: 69%;">
    <div class="modal-content" style="text-align: center; border-radius: 21px; background-color: #07a6d0;">
      <div class="modal-header" style="border-radius: 16px;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>        
        <h4 class="modal-title">RETO FALLIDO {{ Auth::user()->firstname }}</h4>
      </div>

      <div class="modal-body" style="height: 60%;">
        <h1 style="margin: 14% 0% 0% 0%;">Intentalo nuevamente!!!</h1>
      </div>
      <div class="modal-footer" style="border-radius: 14px;">
        {{-- <button type="button" class="btn btn-danger btn-lg pull-left" data-dismiss="modal">Cerrar</button> --}}
        <!--<a class="btn btn-success btn-lg" href="http://evolucion.website/home"> VOLVER </a>-->
        <!--<a class="btn btn-success btn-lg" href="http://127.0.0.1:8000/home"> VOLVER </a>-->
        <a class="btn btn-success btn-lg" href="/playerchallenge/{{ $subcapitulo }}"> VOLVER </a>
      </div>
    </div>
    
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
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
