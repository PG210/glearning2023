@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Registro</li>
    </ol>
</section>
@endsection


@section('usuarios')
    <style>

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
    <br>
      <h1 class="text-center"  style="color:#1ED5F4";><b>Registro De Usuarios</b></h1>
      <hr style="height:2px;border-width:0;color:gray;background-color:gray">
      @if(Session::has('usu_reg'))
          <div class="alert alert-warning alert-dismissible" role="alert">
            <strong style="color:black; font-size:16px;">{{session('usu_reg')}}</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
      @endif
    <br>
    <div class="box box-default" style="background-color:white;" id="cont">
     <br>
      
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
            <div class="form-group col-md-4">
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
            <div class="form-group col-md-4">
                <label for="ced"><b>Cedula</b></label>
                <input type="number" class="form-control" id="ced" name="ced" Required>
            </div>
            <!--grupo-->
            <div class="form-group col-md-4">
                <label for="ced"><b>Grupo</b></label>
                <select id="grupo" name="grupo" class="form-control" >
                @foreach($grup as $gr)
                  <option value="{{$gr->id}}">{{$gr->descrip}}</option>
                @endforeach
                </select>
            </div>
            <!--grupo-->
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
                  <div id="confir" class="alert alert-info ocultar" role="alert">
                    Confirmación correcta!
                  </div>
                  <!--end mensajes imprimir-->
              </div>
              <div class="form-group col-md-2">
               <label for="pass2" >Confirmar</label><br>
               <button type="button" class="btn btn-success form-control" id="login" onclick="verificarPasswords();"  minlength="6" style="padding:0px;" required> Confirmar</button>
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
                        <h2 class="mb-0" >
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="text-decoration:none; background-color:#1BF9CD; color:black;">
                            Elegir Avatar
                            </button>
                        </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                        <!--imprime los avatars-->
                        <div class="row form-row">
                        @foreach($avat as $p)
                                <div style="margin: 15px;">
                                      <div class="col-md-7">
                                          <div class="input-group">
                                           <h3><b>{{$p->name}} {{$p->sexo}}</b></h3>
                                           <p style="text-align: justify; text-justify: inter-word;">{{$p->description}}</p>
                                          </div><!-- /input-group -->
                                      </div><!-- /.col-lg-6 -->
                                      <div class="col-md-3">
                                          <div class="input-group">
                                                  <br><br><br><br>
                                                  <img src="{{asset($p->img)}}" style="width: 100px; height: 100px;" >
                                          </div><!-- /input-group -->
                                      </div><!-- /.col-lg-6 -->
                                      <div class="col-md-2">
                                        <br>
                                      <label for="nombre" style="font-size:18px;"> Seleccionar</label>
                                       <br><br> <br><br>
                                          <input type="radio" id="contactChoice1"
                                            name="avatar" id="avatar" value="{{$p->id}}">
                                            <label for="contactChoice1"> </label>
                                         
                                      </div><!-- /.col-lg-6 -->
                                  </div><!-- /.row -->
                          @endforeach 
                        </div> 
                        <!--end finalizar-->
                        </div>
                        </div>
                    </div>
                    </div>
                  
                 <!---end collapse imagenes-->
            </div>
            <div class="text-right" style="margin-right:15px; color:black; font-size:15px;">
              <button type="submit" class="btn btn-primary">Registrar</button>
           </div>
            </form>
        <!--end formulario-->
        <br>
    </div>
     <br>
   
<script>

function verificarPasswords() {
 
 // Ontenemos los valores de los campos de contraseñas 
 pass1 = document.getElementById('pass1');
 pass2 = document.getElementById('pass2');

 // Verificamos si las constraseñas no coinciden 
 if (pass1.value != pass2.value) {

     // Si las constraseñas no coinciden mostramos un mensaje 
     document.getElementById("error").classList.add("mostrar");
     document.getElementById("confir").classList.remove("mostrar");
     document.getElementById("login").disabled = false;
     return true;
 } else {

     // Si las contraseñas coinciden ocultamos el mensaje de error
     document.getElementById("error").classList.remove("mostrar");
     document.getElementById("confir").classList.add("mostrar");
     // Desabilitamos el botón de login   
     document.getElementById("login").disabled = false;
     return false;
 }

}
    </script>
@endsection