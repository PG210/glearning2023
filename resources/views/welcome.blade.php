<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GDD Learning</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .intro{
              background-image: url("{{ asset('dist/img/LOG_BG.jpg') }}");
              background-repeat: no-repeat;
              background-size: cover;
            }

            .a-intro{
              color:#fff !important;
            }

            .a-intro:hover {
              background-color: #fff;
              padding: 0 25px;
              color: #531b70 !important;
              transition: all 0.5s;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                /* right: 10px; */
                top: 55%;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: black;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
                color: #fff;
            }
            
            .boton_a{
           text-decoration: none;
           padding: 10px;
           font-weight: 600;
           font-size: 20px;
           color: black;
           background-color: #1ED5F4;
           border-radius: 6px;
           border: 2px solid #0016b0;
           }
          .boton_a:hover{
            color: #1883ba;
            background-color: #ffffff;
          }
        </style>

        <script>
            $(document).ready(function() {
                $("#my_audio").get(0).play();
            });
        </script>
    </head>
    <body class="intro">
          
        <audio id="my_audio" src="https://commondatastorage.googleapis.com/codeskulptor-demos/pyman_assets/intromusic.ogg" autoplay="autoplay"></audio>

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a class="a-intro boton_a" href="{{ url('/home') }}">Inicio</a>
                    @else
                   <!-- <a class="a-intro" >Ingresa</a>-->
                        <a type="button" href="{{ route('login') }}" class="btn boton_a"><h4><b>Ingresar</b></h4></a>
                       <!--Se procede a retirar la parte de registro-->
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <!-- <strong>EVO</strong>LUCIÓN -->
                    <img style="width: 100%; margin: -18% 0% 0% 0%;" src="{{ asset('dist/img/LOGO.png') }}" alt="Logo Evolucion">
                </div>
            </div>
        </div>

        
    </body>
</html>
