<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('pageTitle') Evolucion</title>


    <!-- Fonts -->
    <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Styles -->

    <!-- <link rel="shortcut icon" href="{{ asset('juegos/hangman/TemplateData/favicon.ico') }}"> -->
    <!-- <link rel="stylesheet" href="{{ asset('juegos/hangman/TemplateData/style.css') }}"> -->
    <!-- <script src="{{ asset('juegos/hangman/TemplateData/UnityProgress.js') }}"></script> -->
    <script src="{{ asset('juegos/hangman/Build/UnityLoader.js') }}"></script>
    <script>
      var gameInstance = UnityLoader.instantiate("gameContainer", "{{ asset('juegos/hangman/Build/ahorcado.json') }} ");
    </script>

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
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- jQuery 3 -->
    <script src="{{ asset('js/jquery/dist/jquery.min.js') }} "></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('js/bootstrap/dist/js/bootstrap.min.js') }} "></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }} "></script>

    <script>
      var nomRetos;
    </script>

    <?php

      $challenges = App\Challenge::all(); //Todos los retos

      // echo "<script>console.log($challenges);</script>";
      echo "<script>var numRetos = ($challenges).length</script>";
      echo "<script>console.log(numRetos);</script>";

      foreach($challenges as $nombres_retos){
        echo "<script>nomRetos = '$nombres_retos->name'</script>";
      }


    //calcular cantidad de retos
    $countchallenges = DB::table('challenges')->count();
        

        if (Auth::user() != null) {            
            $userid = Auth::user()->id;
        }else {
            $userid = 1;
        }
        


        $useravatar = App\User::find($userid);
        $avatarimage = App\Avatar::find($useravatar->avatar_id);

        $calculonivel = $useravatar->s_point / 100;
        // $nivel = number_format($calculonivel, 1);

        $nivel = explode(".", $calculonivel);

        $spointceiled = ceil($useravatar->s_point);
        $nivelbarra = $spointceiled % 100;
        $nivelbarra = ceil($nivelbarra);

        if ($nivelbarra == 0 && $useravatar->s_point == 0) {
            $nivelbarra = 0;
            $nivel = explode(".", $calculonivel);

        }elseif ($nivelbarra == 0) {
            $nivelbarra = 100;
            $nivel = explode(".", $calculonivel);

        }

        // Al finalizar el juego y dar click en FINALIZAR realizo el almacenamiento
        // de los datos de Unity aqui en el navgeador para enviar luego a la BD


        //llamado al procedimiento almacenaddo para mostrar los capitulos en secuencia
        $capitulos = DB::select("call chapterSecuence($userid)");


        //consulta para encontrar las causas invitadas
        $users = App\User::find($userid);
        $causas = $users->causes;

        //hallar los versus pendientes para el usuario
        $versusplayers = DB::table('duels')
                            ->where('player1', $userid)
                            ->orWhere('player2', $userid)
                            ->get();


        if (!empty($versusplayers)) {
            foreach ($versusplayers as $versusplayer) {
                $versuspendientes = App\Challenge::find($versusplayer->challenge_id);
            }
        }else{
            $versuspendientes = null;
        }
    ?>

  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div id="app">

        <!-- Main Header -->
        <header class="main-header">

        <!-- Logo -->
        <a href="{{ url('/')}} " class="logo">
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
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- <i class="fa fa-envelope-o"></i> -->
                <span class="label label-success"></span>
                </a>
                <ul class="dropdown-menu">
                <!-- <li class="header">No tienes Mensajes</li> -->
                <li>
                    <!-- inner menu: contains the messages -->
                    <ul class="menu">
                    <!-- <li> -->
                      <!-- start message -->
                        <!-- <a href="#"> -->
                        <!-- <div class="pull-left"> -->
                            <!-- User Image -->
                            <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
                        <!-- </div> -->
                        <!-- Message title and timestamp -->
                        <!-- <h4>
                            Admin Evolución
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                        </h4> -->
                        <!-- The message -->
                        <!-- <p>Tienes Retos pendientes por hacer!</p> -->
                        <!-- </a> -->
                    <!-- </li> -->
                    <!-- end message -->
                    </ul>
                    <!-- /.menu -->
                </li>
                <!-- <li class="footer"><a href="#">Ver Todos los Mensajes</a></li> -->
                </ul>
            </li>
            <!-- /.messages-menu -->

            <!-- Notifications Menu -->
                <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i>
                    <span class="label label-warning"></span>
                    </a>
                    <ul class="dropdown-menu">
                    <li class="header">Notificaciones</li>
                    <li>
                        <ul class="menu">
                            @if ($causas != null)
                                @foreach ($causas as $causa)
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> {{$causa->name}}
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> No tienes Causas
                                    </a>
                                </li>
                            @endif
                            @if (!empty($versuspendientes))
                                <li>
                                    <a href="{{ route('versus.pasarversus', $versuspendientes->id) }}">
                                        <i class="fa fa-users text-aqua"></i> {{$versuspendientes->name}}
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> No tienes Versus
                                    </a>
                                </li>
                            @endif
                        <!-- end notification -->
                        </ul>
                    </li>
                    <li class="footer"><a href="#">Ver Todos</a></li>
                    </ul>
                </li>
            <!-- Tasks Menu -->
            {{-- <li class="dropdown tasks-menu"> --}}
                <!-- Menu Toggle Button -->
                {{-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-flag-o"></i>
                <span class="label label-danger">{{$countchallenges}}</span>
                </a>
                <ul class="dropdown-menu">
                <li class="header txtRetos">tienes {{$countchallenges}} retos</li>
                <li>
                    <!-- Inner menu: contains the tasks -->
                    <ul class="menu cantiretos"> --}}

                            @foreach($capitulos as $capitulo)

                            <?php
                                //obtener cantidad de retos pertenecientes al capitulo
                                $subchapcantretos = DB::table('subchapters')
                                    ->join('challenges', 'subchapters.id', '=', 'challenges.subchapter_id')
                                    ->where('subchapters.chapter_id', '=', $capitulo->id)
                                    ->count();

                                //obtenercantidad de retos jugados pertenecientes al capitulo
                                $userauthid = $userid;
                                $subchapretosplayed = DB::table('subchapters')
                                ->join('challenges', 'challenges.subchapter_id', '=', 'subchapters.id' )
                                    ->join('challenge_user', function ($join) use($userauthid) {
                                        $join->on('challenge_user.challenge_id', '=', 'challenges.id')
                                            ->where('challenge_user.user_id', '=', $userauthid);
                                    })
                                    ->where('subchapters.chapter_id', '=', $capitulo->id)
                                    ->count();

                                //establecer niveles para las barras de progreso de los chapters segun sus cantidades de retos
                                if ($subchapretosplayed == 0) {
                                    $totalchapters = 0;
                                    $nivelchaptercount = 0;
                                } else {
                                    $calchaptercant = $subchapretosplayed / $subchapcantretos;
                                    $nivelchaptercount = number_format($calchaptercant, 1);
                                    $totalchapters = $subchapretosplayed % $subchapcantretos;

                                    if ($totalchapters == 0) {
                                        $totalchapters = 100;
                                        $nivelchaptercount = number_format($calchaptercant, 0);
                                    }
                                }

                            ?>
                            {{-- <li>
                                <a href="{{ route('capitulos.show', $capitulo->id) }} ">
                                <h3>
                                    {{ $capitulo->name }}
                                    <small class="pull-right"> {{$totalchapters}} %</small>
                                </h3>
                                
                            
                                </a>
                            </li> --}}

                        @endforeach
                        <!-- end task item -->
                        {{-- </ul>
                    </li>
                    </ul> --}}
                {{-- </li> --}}
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="{{ asset($avatarimage->img) }}" class="user-image" alt="User Image">
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
                    <img src="{{ asset($avatarimage->img) }}" class="img-circle" alt="User Image">
                    <p>
                    @auth
                        <span> {{ Auth::user()->firstname }} </span>
                    @endauth
                    <small> {{$avatarimage->name}} </small>
                    </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                    <div class="row">
                    <div class="col-xs-3 text-center">
                        <span>Nivel</br><strong>{{ $nivel[0][0] }}</strong></span>
                    </div>
                    <div class="col-xs-3 text-center">
                        <span>SP</br><strong>{{ ceil(Auth::user()->s_point) }}</strong></span>
                    </div>
                    <div class="col-xs-3 text-center">
                        <span>IP</br><strong>{{ Auth::user()->i_point }}</strong></span>
                    </div>
                    <div class="col-xs-3 text-center">
                        <span>GP</br><strong>{{ Auth::user()->g_point }}</strong></span>
                    </div>
                    </div>
                    <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="pull-left">
                    <a href="{{ url('/perfil') }}" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="pull-right">
                    <!--<a href="#" class="btn btn-default btn-flat">Salir</a>-->

                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                        style="z-index:1111111111;"
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
            <!-- <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li> -->
            </ul>
        </div>
        </nav>
        </header>


  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

  <!-- Sidebar user panel (optional) -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="{{ asset($avatarimage->img) }} " class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">

        @auth
            <p>{{ Auth::user()->firstname }}</p>
        @endauth
      <!-- Status -->
      <span style="text-align: center;"> {{$avatarimage->name}} </span>
      <!-- Barra de Nivel -->
      @auth
        <p style="text-align: center;">Nivel {{ $nivel[0] }}</p>      
        <p>{{ $nivelbarra }}%</p>
      @endauth

      <div class="progress xs">
        <!-- Change the css width attribute to simulate progress -->
        @auth
        <div class="progress-bar progress-bar-aqua" style="width: {{ $nivelbarra }}%; background-color: #ff397f;" role="progressbar"
             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
            <span class="sr-only">EXP: {{ Auth::user()->s_point }}%</span>            
        </div>
        @endauth
      </div>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header"></li>
    <!-- Optionally, you can add icons to the links -->
    <li class="active"><a href="{{ url('/home') }}"><i class="fa fa-arrow-circle-right"></i> <span>Inicio</span></a></li>
    <li class="treeview">
      <a href="{{ url('/capitulos') }}"><i class="fa fa-arrow-circle-right"></i> <span>Capitulos</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>

      <ul class="treeview-menu">
            @foreach($capitulos as $capitulo)
              <li><a href="{{ route('capitulos.show', $capitulo->id) }} ">{{ $capitulo->name }}</a></li>
            @endforeach
        </ul>
  
      </li>
      <li><a href="{{ url('/recompensas') }}"><i class="fa fa-arrow-circle-right"></i> <span>Distinciones</span></a></li>
  
      <?php
  
  
          if (Auth::user() != null) {                        
              $puntosi = Auth::user()->i_point;
              $puntosg = Auth::user()->g_point;
          }else {
              $puntosi = 0;
              $puntosg = 0;
          }
          
  
         $enablepuntos = DB::table('causas_points')->get();
  
         foreach ($enablepuntos as $enable) {
         }
      ?>
  
      @if ($puntosi >= $enable->i_point && $puntosg >= $enable->g_point)
          <li><a href="{{ url('causas') }}"><i class="fa fa-arrow-circle-right"></i> <span>Causas</span></a></li>
      @endif
  
      <li><a href="{{ url('/versus') }}"><i class="fa fa-arrow-circle-right"></i> <span>Versus</span></a></li>
      <li class="header"></li>
      <li><a href="{{ url('/about') }}"><i class="fa fa-arrow-circle-right"></i> <span>Aceca de Evolución</span></a></li>
      <li><a href="{{ url('/historia') }}"><i class="fa fa-arrow-circle-right"></i> <span>Historia</span></a></li>
      {{-- <li><a href="{{ url('/faq') }}"><i class="fa fa-arrow-circle-right"></i> <span>FAQ</span></a></li> --}}
    </ul>
    <!-- /.sidebar-menu -->

        <main class="py-4">
            @yield('content')
        </main>
    </div>


    @yield('contentperfil')


  </body>
  </html>
