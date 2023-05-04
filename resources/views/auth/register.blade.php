@extends('layouts.basics')

@section('content')
///en los estylos de la parte superior etaba
<style>
 .main-header{
      display: none;
    }

    .formi{
      width: 75%;
      margin: 4% auto 0 auto;
      border-top: solid 2px #b343ec;
      padding: 3% 0% 3% 5%;
      border-radius: 1vw;
      background-color: #fff;
      box-shadow: 5px 5px 25px #212020;
    }

    body{
      background: url("{{ asset('dist/img/LOG_BG.jpg') }}") no-repeat center center fixed;
      /* background-repeat: no-repeat;
      background-size: cover; */
    }

    .m-b-md {
        margin-bottom: 30px;
        font-size: 1.3vw;
    }

    .selPer {
      float: left;
      padding: 20px;
      text-align: center;
      width: 50%;
    }

    .txtPer {
      margin-top: 10px;
      margin-bottom: 15px;
      width: 100% !important;
    }

    .radioBtn {
      /* width: 10%; */
      margin-top: 15px;
    }

    .container {
      overflow: hidden;
    }

    .filterDiv {
      width: 50%;
      float: left;
      padding: 2%;
      display: none; /* Hidden by default */
    }

    /* The "show" class is added to the filtered elements */
    .show {
      display: block;
    }

    /* Style the buttons */
    .btn {
      border: none;
      outline: none;
      padding: 12px 16px;
      background-color: #f1f1f1;
      cursor: pointer;
    }

    /* Add a light grey background on mouse-over */
    .btn:hover {
      background-color: #ddd;
    }

    /* Add a dark background to the active button */
    .btn.active {
      background-color: #666;
      color: white;
    }

    /* Style the buttons */
    .btnx {
      border: none;
      outline: none;
      padding: 12px 16px;
      background-color: #f1f1f1;
      cursor: pointer;
    }

    /* Add a light grey background on mouse-over */
    .btnx:hover {
      background-color: #ddd;
    }

    /* Add a dark background to the active button */
    .btnx.activex {
      background-color: #666;
      color: white;
    }

    .mainCont{
      width: 100%;
    }

    .sending{
      cursor: pointer;
      background-color: #ffffff;
      color: #7e27ce;
      border: solid 3px #7e27ce;
      border-radius: 10px;
      padding: 8px 10px 8px 10px;
      font-family: 'effortless';
    }

    .sendinghover:hover{
      text-decoration: none;
      color: #7e27ce!important;
      font-family: 'effortless';
    }

    .sending.active{
      cursor: pointer;
      background-color: #7e27ce;
      color: #ffffff;
      border: solid 3px #7e27ce;
      border-radius: 10px;
      padding: 8px 10px 8px 10px;
      font-family: 'effortless';
    }

    .activi{
      cursor: pointer;
      background-color: #7e27ce;
      color: #ffffff;
      border: solid 3px #7e27ce;
      border-radius: 10px;
      font-weight: 900;
      padding: 12px 20px 12px 20px;
      font-family: 'effortless';
    }
    .activi:hover{
      color: #fff!important;
      font-weight: 900;
      font-size: 17px;
      font-family: 'effortless';
    }
</style>
<script src="{{ asset('dist/js/MyJs.js') }}"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="formi">
            <div class="card">
              <div class="title m-b-md">
               <a style="float:left;" type="button" href="{{url('/usuario')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>&nbsp;Registrarse en <strong>EVO</strong>LUCIÓN
              </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" id="regForm">
                        @csrf
                      <!-- Tab 1 Registro -->
                        <div class="tab"> Información Usuario:
                          <p>
                            <!-- <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label> -->

                            <!-- <input class="regInp"  oninput="this.className = ''" name="nombre"> -->

                            <input id="firstname" placeholder="Nombre" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" required autofocus>
                            @if ($errors->has('firstname'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('firstname') }}</strong>
                                </span>
                            @endif

                          </p>
                          <p>
                            <!-- <input class="regInp" placeholder="Apellido" oninput="this.className = ''" name="apellido"> -->
                            <input id="lastname" placeholder="Apellido" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required autofocus>
                            @if ($errors->has('lastname'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                </span>
                            @endif
                          </p>
                          <p>
                            <!-- <input class="regInp" placeholder="E-mail" oninput="this.className = ''" name="email"> -->
                            <input id="email" placeholder="E-mail" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                          </p>

                        <!--  <div id="app">
                            <selectregister-component></selectregister-component>
                          </div>-->
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
                        </div>

                        <!-- Tab 2 Registro -->
                        <div class="tab">Datos Personaje:
                          <p>
                            <!-- <input class="regInp" placeholder="Nombre de Usuario" oninput="this.className = ''" name="nombre_usuario"> -->
                            <input id="username" placeholder="Nombre de Usuario" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                            @if ($errors->has('username'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                          </p>
                          <p>
                            <!-- <input class="regInp" placeholder="Contraseña" oninput="this.className = ''" name="contrasena" type="password"> -->
                            <input id="password" placeholder="Contraseña" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                          </p>
                          <p>
                            <input id="password-confirm" placeholder="Confirmar Contraseña" type="password" class="form-control" name="password_confirmation" required>
                          </p>
                        </div>

                        <!-- Tab 3 Registro -->
                        <div class="tab anchus">
                          <h2>Seleccion Personaje:</h2>

                          <?php
                              $avatars = DB::table('avatars')->get();
                          ?>

                          <!-- Filtro Seleccion Raza-->
                          <div id="BtnContainer" style="font-family: 'Share Tech', sans-serif; font-size:18px;">
                            <!-- <a class="btn active" onclick="filterSelection('todos')"> Ver Todos</a> -->
                            <a class="btn active" onclick="filterSelection('Memorex')"> Memorex</a>
                            <a class="btn" onclick="filterSelection('Linguo')"> Linguo</a>
                            <a class="btn" onclick="filterSelection('Maker')"> Maker</a>
                            <a class="btn" onclick="filterSelection('Sabius')"> Sabius</a>
                            <!---Aqui sale la informacion del usuario por defecto -->
                            <a class="btn" onclick="filterSelection('Default')">Default</a>
                          </div>

                          <!-- PERSONAJES -->
                          <div class="container mainCont">

                            @foreach($avatars as $avatar)
                            <div class="col-sm txtPer filterDiv {{ $avatar->name }} {{ $avatar->sexo }}"> 
                              <div style="font-family: 'Share Tech', sans-serif; text-align:justify; font-size:18px;">
                                {!! $avatar->description !!} 
                              </div>
                            </div>
                            @endforeach
                            
                            @foreach($avatars as $avatar)
                              <div class="col-sm filterDiv {{ $avatar->name }} {{ $avatar->sexo }}">

                                  <img class="col-sm imgPer" src="{{ $avatar->img }}" style="width: 70%" alt="">
                                  <h3>{{ $avatar->name }} - {{ $avatar->sexo }}</h3>
                                  <div class="radioBtn">
                                      <a class="sending sendinghover" sexo="{{ $avatar->sexo }}" name="{{ $avatar->id }}" >SELECCIONAR</a>
                                      <input class="valAvtr" type="hidden" name="avatar_id" value="{{ $avatar->id }}">
                                      <input class="valsexvtr" type="hidden" name="AvatarSexo" value="{{ $avatar->sexo }}">
                                  </div>

                              </div>
                            @endforeach
                          </div>

                          <script>

                          // BOTON SELECCIONAR
                          $(".sending").click(function(){
                            $(".sending").removeClass("activi");

                            var bandera = $(this).attr("name");
                            var banderax = $(this).attr("sexo");

                            $(".valAvtr").val(bandera);
                            $(".valsexvtr").val(banderax);

                            console.log($(".valAvtr").val());

                            $(this).toggleClass("activi");

                          });

                          // PERSONAJES (si se quiere mostrar todos se pone todos en vez de Memorex)
                          filterSelection("Memorex")
                          function filterSelection(c) {
                            var x, i;
                            x = document.getElementsByClassName("filterDiv");
                            if (c == "todos") c = "";
                            // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
                            for (i = 0; i < x.length; i++) {
                              w3RemoveClass(x[i], "show");
                              if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
                            }
                          }

                          // Show filtered elements
                          function w3AddClass(element, name) {
                            var i, arr1, arr2;
                            arr1 = element.className.split(" ");
                            arr2 = name.split(" ");
                            for (i = 0; i < arr2.length; i++) {
                              if (arr1.indexOf(arr2[i]) == -1) {
                                element.className += " " + arr2[i];
                              }
                            }
                          }

                          // Hide elements that are not selected
                          function w3RemoveClass(element, name) {
                            var i, arr1, arr2;
                            arr1 = element.className.split(" ");
                            arr2 = name.split(" ");
                            for (i = 0; i < arr2.length; i++) {
                              while (arr1.indexOf(arr2[i]) > -1) {
                                arr1.splice(arr1.indexOf(arr2[i]), 1);
                              }
                            }
                            element.className = arr1.join(" ");
                          }

                          //PERSONAJES
                          var btnContainer = document.getElementById("BtnContainer");
                          var btns = btnContainer.getElementsByClassName("btn");
                          for (var i = 0; i < btns.length; i++) {
                            btns[i].addEventListener("click", function() {
                              var current = document.getElementsByClassName("active");
                              current[0].className = current[0].className.replace(" active", "");
                              this.className += " active";
                            });
                          }
                          </script>

                          @if ($errors->has('avatar_id'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('avatar_id') }}</strong>
                              </span>
                          @endif
                          @if ($errors->has('sexo'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('sexo') }}</strong>
                              </span>
                          @endif

                        </div>

                        <!-- Marcadores Paso -->
                        <div style="text-align:center;margin-top:40px;">
                          <span class="step"></span>
                          <span class="step"></span>
                          <span class="step"></span>
                        </div>
                        <br>

                        <!-- Siguiente / Anterior -->
                        <div style="overflow:auto;">
                          <div style="float:right;">
                            <button class="regBtn" type="button" id="prevBtn" onclick="nextPrev(-1)">Anterior</button>
                            <button class="regBtn" type="button" name="send" id="nextBtn" onclick="nextPrev(1)">Siguiente</button>
                           
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
