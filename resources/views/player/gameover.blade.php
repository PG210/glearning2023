@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/magic-master/magic.css') }}">

<style>
  .nofin{
    display: none;
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
                  <h1 class="nofin">RETO NO TERMINADO</h1>
                  <h3>Te has excedido del Tiempo Maximo!</h3>
                  <p>No te preocupes, Vuelve a intentarlo</p>
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
