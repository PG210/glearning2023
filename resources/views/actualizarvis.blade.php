<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <title>Actualizar</title>
    <style>

      body {
          background-image: url("{{asset('dist/img/LOG_BG.jpg')}}");
          background-attachment: fixed;
          background-repeat: no-repeat;
          background-size: cover;
          }
          footer {
            
          text-align: center;
          padding: 3px;
          background-color:#4b42bc;
          color: white;      
        }
        .letramay{
          text-transform: uppercase;
         }
    .boton_p{
     text-decoration: none;
     padding: 10px;
     font-weight: 600;
     font-size: 20px;
     color: #ffffff;
     background-color: #1ED5F4;
     border-radius: 6px;
     border: 2px solid #0016b0;
     }
   .boton_p:hover{
    color: #1883ba;
    background-color: #ffffff;
    } 
</style>
  </head>
  <body>
    <br>
      <h1 class="text-center letramay"  style="color:#1ED5F4";>BIENVENID@ {{Auth::user()->firstname}} ACTUALIZA TU PERFIL</h1>
      <hr>
    <br>
   
    <div  class="container">
        <div class="row text-center">
         <div class="col-md-6">

         </div>
         <div class="col-md-1"  style="margin-top:100px;">
         <a type="button" href="{{ route('perfilhome') }}"  class="btn boton_p">Continuar</a>
        </div>
         <div class="col-md-5">
             
        </div>

        </div>
    </div>
      

  </body>
</html>
