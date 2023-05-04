@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Actualizar</li>
    </ol>
</section>
@endsection


@section('cargosCreate')

<!--botones-->
<h2>AGREGAR NUEVO GRUPO</h2>
<div class="container">
<div class="row box-body">
    <div class="col-12">
         <!--mensaje-->
         @if(Session::has('datreg'))
            <div class="alert alert-warning alert-dismissible fade in" role="alert" style="border-radius:15px;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>{{Session('datreg')}}</strong> 
            </div>
         @endif
        <!--end mensaje-->
     
    </div>
</div>
</div>
<!--end botones-->
<div class="box box-default" style="margin-top:2%;">
     
  <!--aqui formulario --->   
<div class="container" style="margin-top:2%; padding-right:10%;">
    <div class="tab-pane" id="timeline">
          <form action="{{route('actualizarusuadmin', $usu[0]->userid)}}" method="POST">
          @csrf
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne" style="border-radius:20px; color:black; background-color:#1bf9cd">
                    <h4 class="panel-title">
                        <a style="text-decoration: none;" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
                            <input type="email" class="form-control" id="email" name="email" value="{{$usu[0]->email}}">
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="usuario">Usuario</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" value="{{$usu[0]->username}}">
                            </div>
                           </div>
                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="pass">Actualizar Contraseña</label>
                                <input type="password" class="form-control" id="passw" name="passw" placeholder="*******">
                            </div>
                           </div>
                        </div>
                         <!--grupo-->
                         <div class="row">
                         <div class="col-md-6">
                            <div class="form-group">
                                <label for="pass">Grup actual</label>
                                <span class="form-control">{{$usu[0]->grupo}}</span>
                            </div>
                           </div>
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="usuario">Grupo</label>
                                <select class="form-control" name="grupo">
                                       <option value="{{$usu[0]->idgrupo}}" selected>{{$usu[0]->grupo}}</option>
                                    @foreach($grupos as $g)
                                        @if($usu[0]->grupo != $g->descrip)
                                        <option value="{{$g->idgrup}}">{{$g->descrip}}</option>
                                        @endif
                                        @endforeach
                                </select>
                            </div>
                           </div>
                        </div>
                         <!--end formulario--->
                    </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo" style="border-radius:20px; color:black; background-color:#1bf9cd;">
                    <h4 class="panel-title">
                        <a style="text-decoration: none;" class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                       <h3> Elegir Avatar Femenino </h3>
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
                                          <label for="nombre"> Seleccionar</label>
                                          <br><br> <br><br>
                                          @if($usu[0]->id == $a->id)
                                          <input type="radio" id="contactChoice1"
                                            name="avat" value="{{$a->id}}"  checked>
                                            <label for="contactChoice1"> </label>
                                          @else
                                          <input type="radio" id="contactChoice1"
                                            name="avat" value="{{$a->id}}">
                                            <label for="contactChoice1"> </label>
                                          @endif
                                          </div><!-- /.col-lg-6 -->
                                  </div><!-- /.row -->
                                  @endforeach 
                      <!---End finalizar-->
                    </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTre"  style="border-radius:20px; color:black; background-color:#1bf9cd;">
                    <h4 class="panel-title">
                        <a style="text-decoration: none;" class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTre" aria-expanded="false" aria-controls="collapseTre">
                        <h3>Elegir Avatar Masculino</h3>
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
                                      <label for="nombre"> Seleccionar</label>
                                       <br><br> <br><br>
                                       @if($usu[0]->id == $m->id)
                                       <input type="radio" id="contactChoice1"
                                         name="avat" value="{{$m->id}}"  checked>
                                        <label for="contactChoice1"> </label>
                                        @else
                                        <input type="radio" id="contactChoice1"
                                         name="avat" value="{{$m->id}}">
                                        <label for="contactChoice1"> </label>
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
             <br>
              
              <a href="/usuario" type="button"  class="btn btn-warning">
                 <span>Cancelar</span>
              </a>
              <button type="submit"  class="btn btn-success">
                <span>Actualizar</span>
              </button>            
          </div>
          </form>
          </div>

      </div>
  
  <!--end formulario-->
  <br> 
  </div>
</div>

@endsection
