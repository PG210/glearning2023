@extends('layouts.app')
@section('nperfil')
<br>
<div class="content-wrapper">
    <div  class="tab-pane content-header" id="timeline">
          <form action="{{route('actualizarusu', $usu[0]->userid)}}" method="POST">
          @csrf
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne" style="color:black; background-color:#1bf9cd; border-radius:10px;">
                    <h4 class="panel-title">
                        <a style=" color: inherit;" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h3> Datos Personales </h3>
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body letrap">
                        <!--formulario -->
                          <br>
                        <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{$usu[0]->firstname}}">
                               </div>          
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" value="{{$usu[0]->lastname}}">
                            </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="genero">Genero</label>
                                <input type="text" class="form-control" id="genero" name="genero" value="{{$usu[0]->sexo}}">
                            </div>
                            </div>
                           </div>                      
                  
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{$usu[0]->email}}" readonly>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="usuario">Usuario</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" value="{{$usu[0]->username}}" readonly>
                            </div>
                           </div>
                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="pass">Actualizar Contraseña</label>
                                <input type="password" class="form-control" id="pass" name="pass"  readonly>
                            </div>
                           </div>
                        </div>
               

                         <!--end formulario--->
                    </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo" style="color:black; background-color:#1bf9cd; border-radius:10px;">
                    <h4 class="panel-title">
                        <a style=" color: inherit;" class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                       <h3>Avatar Femenino </h3>
                        </a>
                    </h4>                  
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body letrap">
                      <!--Elegir Avatars-->
                                <!---formulario-->
                               
                                @foreach($avatar as $a)
                                <div class="row">
                                      <div class="col-md-7">
                                          <div class="input-group">
                                           <h3><b>{{$a->name}}</b></h3>
                                           <p style="text-align: justify; text-justify: inter-word;">{{$a->description}}</p>
                                          </div><!-- /input-group -->
                                      </div><!-- /.col-lg-6 -->
                                      <div class="col-md-3">
                                          <div class="input-group">
                                                  <br><br><br><br>
                                                  <img src="{{asset($a->img)}}" style="width: 100px; height: 100px;" >
                                          </div><!-- /input-group -->
                                      </div><!-- /.col-lg-6 -->
                                          <div class="col-md-2">
                                            <br>
                                          <label for="nombre"> Selección</label>
                                          <br><br> <br><br>
                                            @if($usu[0]->id == $a->id)
                                            <input type="radio" id="contactChoice1"
                                                name="avat" value="{{$a->id}}"  checked>
                                                <label for="contactChoice1"> </label>
                                            @else
                                            {{--<input type="radio" id="contactChoice1"
                                                name="avat" value="{{$a->id}}">
                                                <label for="contactChoice1"> </label>--}}
                                            @endif
                                          </div><!-- /.col-lg-6 -->
                                  </div><!-- /.row -->
                                  @endforeach 
                      <!---End finalizar-->
                    </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTre"  style="color:black; background-color:#1bf9cd; border-radius:10px;">
                    <h4 class="panel-title">
                        <a style=" color: inherit;" class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTre" aria-expanded="false" aria-controls="collapseTre">
                        <h3>Avatar Masculino</h3>
                        </a>
                    </h4>
                    </div>
                    <div id="collapseTre" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTre">
                    <div class="panel-body letrap">
                      <!--Elegir Avatars-->
                                <!---formulario-->
                                @foreach($avatarm as $m)
                                <div class="row">
                                      <div class="col-md-7">
                                          <div class="input-group">
                                           <h3><b>{{$m->name}}</b></h3>
                                           <p style="text-align: justify; text-justify: inter-word;">{{$m->description}}</p>
                                          </div><!-- /input-group -->
                                      </div><!-- /.col-lg-6 -->
                                      <div class="col-md-3">
                                          <div class="input-group">
                                                  <br><br><br><br>
                                                  <img src="{{asset($m->img)}}" style="width: 100px; height: 100px;" >
                                          </div><!-- /input-group -->
                                      </div><!-- /.col-lg-6 -->
                                      <div class="col-md-2">
                                        <br>
                                      <label for="nombre">Selección</label>
                                       <br><br> <br><br>
                                       @if($usu[0]->id == $m->id)
                                          <input type="radio" id="contactChoice1"
                                            name="avat" value="{{$m->id}}"  checked>
                                            <label for="contactChoice1"> </label>
                                          @else
                                         {{--<input type="radio" id="contactChoice1"
                                            name="avat" value="{{$m->id}}">
                                            <label for="contactChoice1"> </label>--}}
                                          @endif
                                      </div><!-- /.col-lg-6 -->
                                  </div><!-- /.row -->
                                  @endforeach 
                      <!---End finalizar-->
                    </div>
                    
                    </div>
                     
                </div>

                </div>
             <!--buton enviar-->
             <div class="text-right">
              <button type="submit"  class="btn" style="color:white; font-size:15px; font-weight:bold; background-color:#FF397F;">
                Actualizar
              </button>             
            </div>
            </div>
          </form>
          </div>

      </div>
      <br>
      <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.1.2
        </div>
        <strong>Copyright &copy; 2018 <a href="#">Evolución</a>.</strong> All rights
        reserved.
    </footer>
@endsection