<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('pageTitle') Evolucion</title>
    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link href="https://fonts.googleapis.com/css?family=Share+Tech&display=swap" rel="stylesheet">
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
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- jQuery 3 -->
    <script src="{{ asset('js/jquery/dist/jquery.min.js') }} "></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('js/bootstrap/dist/js/bootstrap.min.js') }} "></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }} "></script>

    <script>
        var nomRetos;
    </script>
 @if(Auth::user()->avatar_id !=9) 
 
    <?php
        //Todos los retos
        $challenges = App\Challenge::all(); 

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
        
        try {
            //code...
            $useravatar = App\User::find($userid);
            $avatarimage = App\Avatar::find($useravatar->avatar_id);
            $avataritem = App\Avatar::find($useravatar->avatar_id);
    
            $avatarlevelscustom = DB::select( DB::raw("SELECT gifts.id as iditem, gifts.name, gifts.imagen, gifts.avatarchange, gifts.avatar_id, gift_user.user_id 
                                                        FROM gifts 
                                                        INNER JOIN gift_user ON gifts.id = gift_user.gift_id 
                                                        INNER JOIN users ON gift_user.user_id = users.id 
                                                        WHERE users.id ='$userid' 
                                                        AND gifts.id = (SELECT MAX(gift_user.gift_id) FROM gift_user) "));
    
            $avatarlevelblank = DB::table('gifts')->where('avatar_id', '=', Auth::user()->avatar_id)->first();                                                    
                
        } catch (\Throwable $th) {
            //throw $th;
        }

        // dd($avatarlevelblank->avatarchange);        
        if ($avatarlevelscustom != null) {            
            foreach ($avatarlevelscustom as $avatarlevel) {
                $avatarimage =  $avatarlevel->avatarchange;
            }
        }else {
            $avatarimage = $avatarlevelblank->avatarchange;
        }


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
        $caps = DB::select("call chapterSecuence($userid)");
        $capitulos = array_reverse($caps);

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
@endif
<style>
    @keyframes blink {
      0% { opacity: 1; }
      50% { opacity: 0; }
      100% { opacity: 1; }
    }

    .blinking-lock {
      animation: blink 1s infinite;
    }
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
@if(Auth::user()->avatar_id !=9 ) 

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
                    
                        <!-- end message -->
                        </ul>
                        <!-- /.menu -->
                    </li>
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

                        @endforeach
                        <!-- end task item -->

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- The user image in the navbar-->
                    <img src="{{ asset($avatarimage) }}" class="user-image" alt="User Image">
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
                        <img src="{{ asset($avatarimage) }}" class="img-circle" alt="User Image">
                        <p>
                        @auth
                            <span> {{ Auth::user()->firstname }} </span>
                        @endauth
                        <small> {{$avataritem->name}} </small>
                        </p>
                    </li>
                    <!-- Menu Body -->
                    <li class="user-body">
                        <div class="row">
                        <div class="col-xs-3 text-center">
                            <span>Nivel</br><strong>{{ $nivel[0][0] }}</strong></span>
                        </div>
                        <div class="col-xs-3 text-center">
                            <span>Puntos I</br><strong>{{ Auth::user()->i_point }}</strong></span>
                        </div>
                        <div class="col-xs-3 text-center">
                            <span>Puntos G</br><strong>{{ Auth::user()->g_point }}</strong></span>
                        </div>
                        <div class="col-xs-3 text-center">
                            <span>Puntos S</br><strong>{{ ceil(Auth::user()->s_point) }}</strong></span>
                        </div>
                        </div>
                        <!-- /.row -->
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                        {{-- <a href="{{ url('/perfil') }}" class="btn btn-default btn-flat">Perfil</a> --}}
                        </div>
                        <div class="pull-right">
                        <!--<a href="#" class="btn btn-default btn-flat">Salir</a>-->

                        <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                            style="z-index:1111111111111;"
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
      <img src="{{ asset($avatarimage) }} " class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info" style="text-align: center;">

        @auth
            <p>{{ Auth::user()->firstname }}</p>
        @endauth
      <!-- Status -->
      <span style="text-align: center;"> {{$avataritem->name}} </span>
      <!-- Barra de Nivel -->
      @auth
        @if(isset($cap))
        <?php
          $usuid = Auth::user()->id;
           $tarealizadas = DB::table('challenge_user')
                            ->join('challenges', 'challenge_user.challenge_id', '=', 'challenges.id')
                            ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                            ->where('subchapters.chapter_id', $cap)
                            ->where('challenge_user.user_id', '=', $usuid)
                            ->selectRaw('challenge_user.user_id as idusu, subchapters.chapter_id, COUNT(challenge_user.challenge_id) as tot')
                             ->groupBy('challenge_user.user_id', 'subchapters.chapter_id')
                            ->get();
            $tarporcap = DB::table('challenges')
                            ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                            ->where('subchapters.chapter_id', $cap)
                            ->selectRaw('subchapters.chapter_id as cap, COUNT(challenges.id) as tot')
                            ->groupBy('subchapters.chapter_id')
                            ->get();
         if(count($tarealizadas) != 0){
            $niv = ($tarealizadas[0]->tot*100)/$tarporcap[0]->tot;
         }else{
            $niv = 0;
         }
        //
         $bn = round($niv, 0);
         //dd($niv);
         
        ?>
         <p style="text-align: center;">Nivel {{ $cap }} </p>      
        <p>{{ $bn }}%</p>
        @endif
      @endauth

        @auth
        @if(isset($bn))
        <div class="progress xs">
        <!-- Change the css width attribute to simulate progress -->
        <div class="progress-bar progress-bar-aqua" style="width: {{ $bn }}%; background-color: #ff397f;" role="progressbar"
             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
            <span class="sr-only">EXP: {{ $bn }}%</span>            
        </div>
        </div>
        @endif
        @endauth
    </div>
  </div>

  

  <!-- Sidebar Menu -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header"></li>
    <!-- Optionally, you can add icons to the links -->
     <!---validar para escoger usuario-->
    <li class="active"><a href="{{ url('/home') }}"><i class="fa fa-arrow-circle-right"></i> <span>Inicio</span></a></li>
    <li><a href="{{ route('perfilhomedos') }}"><i class="fa fa-arrow-circle-right"></i> <span>Perfil</span></a></li>
    <li class="treeview active">
      <a href="#"><i class="fa fa-arrow-circle-right"></i> <span>Capitulos</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>

    <?php
        $userauth_id = Auth::user()->id;
        //validar para el procedure o para funcion sql
        $conta = DB::table('subchapter_user')
                ->where('user_id', '=', $userauth_id)
                ->select('chapter_id')
                ->distinct('chapter_id')
                ->count();
         if($conta != 0){
           $subc = DB::table('subchapter_user')
                ->join('chapters', 'subchapter_user.chapter_id', '=', 'chapters.id')
                ->where('user_id', '=', $userauth_id)
                ->where('estado', '=', 1)
                ->select('chapter_id', 'subchapter_user.id', 'estado', 'chapters.name')
                ->distinct('chapter_id')
                ->orderBy('chapter_id','ASC')
                ->get();
            //$capitulosprocedural = DB::select("call chapterSecuence($userauth_id)");
         }else{
            //###################3
           $capitulosprocedural = DB::select("call chapterSecuence($userauth_id)");

         }
        //#################validar el nivel de cada capitulo
        $tTareas = DB::table('challenges')
                  ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                  ->selectRaw('subchapters.chapter_id as cap, COUNT(challenges.id) as tareas')
                  ->groupBy('subchapters.chapter_id')
                  ->get();
        $tareasuser = DB::table('challenge_user')
                        ->join('challenges', 'challenge_user.challenge_id', '=', 'challenges.id')
                        ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                        ->where('challenge_user.user_id', $userauth_id)
                        ->selectRaw('challenge_user.user_id as idusu, subchapters.chapter_id, COUNT(challenge_user.challenge_id) as valor')
                        ->groupBy('challenge_user.user_id', 'subchapters.chapter_id')
                        ->get();
        if(isset($tareasuser) && count($tareasuser) == 0){
            $buscar = [];
            $al = [];
            $niveles =[];
          
        }else{
            //##########################################
            foreach($tTareas as $t1){
                $conta = 0;
                foreach($tareasuser as $t2){
                if($t1->cap == $t2->chapter_id){
                    $sum = $t1->tareas - $t2->valor;
                    $conta = $conta+1;
                    $item = [
                    'usuario' => $t2->idusu,
                    'capitulo' => $t2->chapter_id,
                    'tcom' => $t2->valor,
                    'tfaltan' => $sum,
                    'ttotal' => $t1->tareas,
                    'nivel' => $conta
                ];
                $al[] = $item;
                }
                }
            }
            $niveles = collect($al)->groupBy('usuario')->map(function ($items) {
                return count($items);
            });
            //este me da los niveles 
            //##########################################
            }
    ?>    
      @if($conta == 0 && isset($capitulosprocedural))
      <ul class="treeview-menu">
          @foreach($capitulosprocedural as $capitulo)
            @if ($capitulo->RETOS_CAPITULO_REQUERIDO != 0)
              @foreach($al as $b)
                 @if($b['capitulo'] == $capitulo->id)
                       <?php
                       $por = ($b['tcom']*100)/$b['ttotal'];
                       
                        $red = round($por, 0);
                       
                       
                       ?>
                  <li><a href="{{ route('capitulos.show', $capitulo->id) }} ">
                     {{ $capitulo->name }} 
                    </a>
                    <div class="progress" style="margin-right:3px; margin-bottom:0px;">
                        <div class="progress-bar" role="progressbar" aria-valuenow="<?= $red ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $red ?>%; background-color:#25c5ab; color:black;">
                            <?= $red ?>% 
                        </div>
                    </div></li>
                    @endif
                @endforeach            
            @endif
          @endforeach
          <br>
      </ul>
      @else
      <ul class="treeview-menu">
          @foreach($subc as $s)
               <!---ver porcentaje de capitulos--> 
               @foreach($al as $b)
                    @if($b['capitulo'] == $s->chapter_id)
                       <?php
                       echo $b['ttotal'];
                       $por = ($b['tcom']*100)/$b['ttotal'];
                       $red = round($por, 0);
                       ?>
                  <li>
                    <a href="{{ route('capitulos.show', $s->chapter_id) }} ">
                        {{$s->name}}</a>
                    <div class="progress" style="margin-right:3px; margin-bottom:0px;">
                    <div class="progress-bar" role="progressbar" aria-valuenow="<?= $red ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $red ?>%; background-color:#25c5ab; color:black;">
                        <?= $red ?>%
                    </div>
                </div>
                  </li>
                    @endif
                @endforeach 
               <!--end porcentaje capitulos-->        
          @endforeach
          <br>
      </ul>
      @endif
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

    @if ($puntosi > $enable->i_point && $puntosg > $enable->g_point && $enable->i_point != 0 && $enable->g_point != 0)
        <li><a href="{{ url('causas') }}"><i class="fa fa-arrow-circle-right"></i> <span>Causas</span></a></li>
    @endif

    {{--<li><a href="{{ url('/versus') }}"><i class="fa fa-arrow-circle-right"></i> <span>Versus</span></a></li>
    --}}
    <li class="header"></li>
    <li><a href="{{ url('/about') }}"><i class="fa fa-arrow-circle-right"></i> <span>Aceca de Evolución</span></a></li>
    <li><a href="{{ url('/historia') }}"><i class="fa fa-arrow-circle-right"></i> <span>Historia</span></a></li>
    {{-- <li><a href="{{ url('/faq') }}"><i class="fa fa-arrow-circle-right"></i> <span>FAQ</span></a></li> --}}
  </ul>
  <!-- /.sidebar-menu -->

    <main class="py-4">
        @yield('content')
    </main>
</aside>
</div>

    @yield('contentperfil')
    @yield('nperfil')

@endif

@if(Auth::user()->avatar_id==9 ) 
 @include('actualizarvis');
@endif
</body>
</html>
