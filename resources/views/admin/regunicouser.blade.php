<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>Evolución-Admin</title>
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
        #cont{
            border:3px solid blue;
            border-radius:22px;
        }

         
        .ocultar {
            display: none;
        }
        
        .mostrar {
            display: block;
        }
        
</style>
  </head>
  <body>
    <br>
      <h1 class="text-center"  style="color:#1ED5F4";><b>Registro De Usuarios </b></h1>
      <hr style="height:2px;border-width:0;color:gray;background-color:gray">
    <br>
    <div class="container" style="background-color:white;" id="cont">
     <br>
        @if(Session::has('usu_reg'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('usu_reg')}}</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <br>
        @endif
        <!--formulario-->
        <br>
        <form action="{{route('regunicousuario')}}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-4">
                <label for="nombre"><b>Nombre</b></label>
                <input type="text" class="form-control" id="nombre" name="nombre" Required>
                </div>
                <div class="form-group col-md-4">
                <label for="apellido"><b>Apellido</b></label>
                <input type="text" class="form-control" id="apellido" name="apellido" Required>
                </div>
                <div class="form-group col-md-4">
                <label for="sexo"><b>Genero</b></label>
                <select id="sexo" name="sexo" class="form-control" >
                  <option selected>Elegir...</option>
                  <option value="masculino">Masculino</option>
                  <option value="femenino">Femenino</option>
                  <option value="otro">Otro</option>
                </select>

                </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
                <label for="correo"><b>Correo</b></label>
                <input type="email" class="form-control" id="correo" name="correo"  Required>
                 <!--validar el correo-->
                 @if(Session::has('notcorreo'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{session('notcorreo')}}</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <br>
                @endif
                  <!---end validar correo-->
              </div>
            <div class="form-group col-md-6">
                <label for="nameuser"><b>Usuario</b></label>
                <input type="text" class="form-control" id="nameuser" name="nameuser" Required>
                  <!--validar el correo-->
                  @if(Session::has('notuser'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{session('notuser')}}</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <br>
                @endif
                  <!---end validar correo-->
            </div>
           </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                <label for="pass1"><b>Contraseña</b></label>
                <input type="password" class="form-control" id="pass1" required>
                </div>
                <div class="form-group col-md-5">
                <label for="pass2"><b>Confirmar Contraseña</b></label>
                <input type="password" class="form-control" id="pass2" name="password_confirmation"  minlength="6" required>
                <div id="msg"></div><!--mensaje de contraseña incorrecta-->
                  <!--mensajes para imprimir-->
                  <div id="error" class="alert alert-danger ocultar" role="alert">
                    Las Contraseñas no coinciden, vuelve a ingresar !
                  </div>
                  <!--end mensajes imprimir-->
              </div>
              <div class="form-group col-md-2">
               <label for="pass2" >Confirmar</label><br>
               <button type="button" class="btn btn-success form-control" id="login" onclick="verificarPasswords();"  minlength="6" required> Confirmar</button>
            </div>
            </div>
            <div class="form-group" hidden>
                            <label for="areas_id">Area</label>
                            <select class="form-control" name="areas_id" id="areas_id">
                              <option value="1" selected>Evolucion</option>
                            </select>
                          </div>
                          <div class="form-group" hidden>
                            <label for="position_id">Cargo</label>
                            <select class="form-control" name="position_id" id="position_id">
                              <option value="1" selected>Evolucion</option>
                            </select>
             </div>

            <div class="form-group">
                 <!--Colapse imagenes-->
                 <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="text-decoration:none;">
                            Elegir Avatar
                            </button>
                        </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                        <!--imprime los avatars-->
                        <div class="row">
                        @foreach($avat as $p)
                            
                                <div class="col-sm-6 my-3">
                                <div class="card" style="background-color:rgb(147,197,253)">
                                    <div class="card-body" >
                                    <h5 class="card-title" >{{$p->name}} {{$p->sexo}} </h5>
                                    <!--ver mas--->
                                      <div class="container">
                                       <p>
                                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample{{$p->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Ver Mas >>
                                        </a>
                                        </p>
                                        <div class="collapse" id="collapseExample{{$p->id}}">
                                        <div class="card card-body">
                                             <p class="card-text" style="text-align: justify;">{{$p->description}}</p>
                                        </div>
                                        </div>
                                       </div>
                                    <!---end ver mas-->
                                        <div class="container"> <img class="img-thumbnail"  src="{{asset($p->img)}}"  width="150px" height="150px"/> </div>
                                       <div class="container">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                
                                             </div>
                                             <div class="col-md-4">
                                                
                                            </div>
                                             <div class="col-md-4">
                                             Seleccionar
                                                <input type="radio" id="contactChoice1"
                                                name="avatar" id="avatar" value="{{$p->id}}" required>
        
                                             </div>
                                         </div>
                                        
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            @endforeach
                             </div> 
                             <!--end finalizar-->
                        </div>
                        </div>
                    </div>
                    </div>
                  
                 <!---end collapse imagenes-->
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
            <a href="/usuario" type="button" class="btn btn-primary">Volver</a>
            </form>
        <!--end formulario-->
        <br>
    </div>
     <br>
   
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

<script>

         
function verificarPasswords() {
 
 // Ontenemos los valores de los campos de contraseñas 
 pass1 = document.getElementById('pass1');
 pass2 = document.getElementById('pass2');

 // Verificamos si las constraseñas no coinciden 
 if (pass1.value != pass2.value) {

     // Si las constraseñas no coinciden mostramos un mensaje 
     document.getElementById("error").classList.add("mostrar");
     document.getElementById("login").disabled = false;
     return true;
 } else {

     // Si las contraseñas coinciden ocultamos el mensaje de error
     document.getElementById("error").classList.remove("mostrar");
     // Desabilitamos el botón de login 
   
     
     document.getElementById("login").disabled = false;
     return false;
 }

}
    </script>
  </body>
</html>