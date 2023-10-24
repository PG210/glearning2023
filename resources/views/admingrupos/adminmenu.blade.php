<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('pageTitle') Evolucion - Admin</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Styles -->


    <link rel="stylesheet" href="{{ asset('css/bootstrap/dist/css/bootstrap.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/owncustom.css') }} ">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }} ">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('css/Ionicons/css/ionicons.min.css') }} ">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.css') }}">
    <!-- Style Color -->
    <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.css') }} ">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


  <script src="{{ asset('/js/app.js') }}"></script>
<!-- jQuery 3 -->
<script src="{{ asset('js/jquery/dist/jquery.min.js') }} "></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('js/bootstrap/dist/js/bootstrap.min.js') }} "></script>


<script src="{{ asset('dist/js/demo.js') }} "></script>

<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }} "></script>


</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="{{ url('/backdoor')}} " class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Evo</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Evo</b>lución</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Activar Navegación</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown messages-menu">
               
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src=" {{ asset('dist/img/evolucion-2018.png')}} " style="width:53px; border:none;" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                @auth
                <span class="hidden-xs">{{ Auth::user()->firstname }} </span>
                @endauth
                </a>
                <ul class="dropdown-menu">

               @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </li>
                @else


                <!-- The user image in the menu -->
                <li class="user-header">
                    <img src="dist/img/evolucion-2018.png" alt="User Image" style="width:190px; border:none;">

                    <p>
                        @auth
                            <a href="#"> {{ Auth::user()->firstname }} </a>
                        @endauth

                    <small>Evolucion Admin</small>
                    </p>
                </li>
                <!-- Menu Body -->
                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="pull-left">
                    <!-- <a href="{{ url('/perfil') }}" class="btn btn-default btn-flat">Perfil</a> -->
                    </div>
                    <div class="pull-right">
                    <!--<a href="#" class="btn btn-default btn-flat">Salir</a>-->

                    <a class="btn btn-default btn-flat" style="z-index:1111111111111;" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Salir') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                    </div>
                </li>
                @endguest
                </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
                <!-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> -->
            </li>
            </ul>
        </div>
        </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
          <!-- sidebar: style can be found in sidebar.less -->
          <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
              <div class="pull-left image">
                <img style="border:none;" src="{{ asset('dist/img/evolucion-2018.png')}}" alt="User Image">
              </div>
              <div class="pull-left info">
                @auth
                    <p>{{ Auth::user()->firstname }}</p>
                @endauth
                <a href="#"><i class="fa fa-circle text-success"></i> Usuario Admin</a>
              </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
              <li class="header text-center"><h5 style="color:white;">Navegación Principal</h5></li>

              
              <li class="treeview">
                  <a href="#">
                    <i class="fa fa-group"></i>
                    <span>Players</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>

                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{ route('reportegeneral') }}"><i class="fa fa-circle-o text-aqua"></i> <span>Retos Completos</span></a></li>
                </ul>
                </li>
            </ul>
          </section>
          <!-- /.sidebar -->
        </aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('titulos')

      <!-- Main content -->
      <section class="content">

        @yield('reporte')
     
      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 0.1
    </div>
    <strong>Copyright &copy; 2023 <a href="#">EVOLUCION</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<script src="{{ asset('dist/js/MyJs.js') }}"></script>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



<script>
  // function selectAll(selectBox, selectAll){
  //   if (typeof selectBox == "string") {
  //     selectBox = document.getElementById(selectBox);      
  //   }
  //   if (selectBox.type == "select-multiple") {
  //     for (var i = 0; i < selectBox.options.length; i++) {
  //       selectBox.options[i].selected = selectAll;        
  //     }
  //   }
  // }


  $(document).ready(function() {
    $('#example').DataTable();

    $('#checked_all').click(function(){
      $("input:checkbox").attr('checked', true);
    });

    $('#clear_all').click(function(){
      $("input:checkbox").attr('checked', false);
    });


  });

</script>

</body>
</html>