@extends('layouts.app')

@section('content')
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
      <h1 style="font-size: 5rem; margin: 4% 0% 2% 0%;">
        Bienvenido {{ Auth::user()->firstname }}, Comienza la Aventura.
      </h1>
  </section>

  <!-- Main content -->
  <section class="content">

     <!-- /.row -->

    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#retostab" data-toggle="tab">Reto</a></li>
          {{-- <li><a href="#recursos" data-toggle="tab">Recursos</a></li> --}}
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="retostab">
            <!-- Post -->
            <div class="post">

              <div class="user-block">
                <!-- <img class="img-circle img-bordered-sm" src="{{ asset('dist/img/char_img.png')}}" alt="user image"> -->
                                
                  @switch($retos->challenge_type_id)
                    @case(1)
                        @foreach($quiz->quizzes as $quix )
                          <!-- lo lleva para PlayerChallengeController@startplay -->                                                                         
                          <div class="row" style="margin:4% 0% 0% 0%;text-align: -webkit-center;">
                            <div class="col-md-12">
                              <div class="form-group">                
                                <a type="button" style="font-size: 1.7rem; width: 45%; white-space: nowrap;" class="btn btn-block btn-primary" href="{{ route('player.startchallenge', ['id' => $quix->id, 'idreto' => $retos->id]) }}">
                                    <strong> Comenzar:</strong> {{ $quix->name }}
                                </a>
                              </div>                                  
                            </div>
                          </div>                      

                          <strong>Descripcion:</strong>
                          <p style="color: #730028; font-size: 16px; font-weight: 600;">
                              {{ $quix->description }}.
                          </p>                                                                                                
                          <hr>
                          
                          {{-- <div style="text-align:center;">
                            <h3>Estas listo?</h3>
                            <p>
                              <strong>"Antes de comenzar el reto, ver el material"</strong> 
                            </p> 
                          </div> --}}
                          
                          <hr>
                          @if( !empty($quix->material) )                              
                            <div class="col-md-12 col-sm-8 col-xs-12">
                              <div class="info-box">                                                         
                                  <div class="panel-group">
                                      <div class="panel panel-default" style="box-shadow: 0px 5px 6px 0px #670024;border-color: #ea0d5b;">
                                        <div class="panel-heading" style="background-color: #ea0d5b; color: #fff;text-align: center;">
                                          <h4 class="panel-title">
                                            <a data-toggle="collapse" href="#collapse1">Ver Material</a>
                                          </h4>
                                        </div>
                                        <div id="collapse1" class="panel-collapse collapse">
                                          <div class="panel-body">
                                            @if(strstr($quix->material, 'http:'))
                                              <embed src="{{ $quix->material }}" type="application/pdf" width="100%" height="600px" />
                                            @else
                                              <embed src="/storage/public/{{ $quix->material }}" type="application/pdf" width="100%" height="600px" />
                                            @endif
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                <!-- /.info-box-content -->
                              </div>
                              <!-- /.info-box -->
                            </div>
                          @else
                          @endif


                        @endforeach
                        @break
                    @case(2)                                       
                        <div class="row" style="margin:4% 0% 0% 0%;text-align: -webkit-center;">
                          <div class="col-md-12">
                            <div class="form-group">                 
                              <a href="{{ route('games.ahorcado', $retos->id) }}" type="button" style="font-size: 1.7rem; width: 45%; white-space: nowrap;" class="btn btn-block btn-primary">
                                <strong> Comenzar:</strong> {{ $retos->name }}
                              </a>
                            </div>
                          </div>    
                        </div>    

                        <strong>Descripcion:</strong>
                        <p style="color: #730028; font-size: 16px; font-weight: 600;">
                            {{ $retos->description }}.
                        </p>                                                                                                
                        <hr>
                        {{-- <div style="text-align:center;">
                          <h3>Estas listo?</h3>
                          <p>
                            <strong>"Antes de comenzar el reto, ver el material"</strong> 
                          </p> 
                        </div> --}}
                        
                        <hr>
                        @if( !empty($retos->material) )                              
                          <div class="col-md-12 col-sm-8 col-xs-12">
                            <div class="info-box">                              
                              
                              <div class="panel-group">
                                <div class="panel panel-default" style="box-shadow: 0px 5px 6px 0px #670024;border-color: #ea0d5b;">
                                  <div class="panel-heading" style="background-color: #ea0d5b; color: #fff;text-align: center;">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" href="#collapse1">Ver Material</a>
                                    </h4>
                                  </div>
                                  <div id="collapse1" class="panel-collapse collapse">
                                    <div class="panel-body">
                                    @if(strstr($retos->material, 'http:'))
                                       <embed src="{{ $retos->material }}" type="application/pdf" width="100%" height="600px" />
                                     @else
                                       <embed src="/storage/public/{{ $retos->material }}" type="application/pdf" width="100%" height="600px" />
                                     @endif
                                    </div>
                                  </div>
                                </div>
                              </div>

                              </div>                              
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>                          
                        @else
                        @endif

                        @break
                        
                    @case(3)                   
                        <div class="row" style="margin:4% 0% 0% 0%;text-align: -webkit-center;">
                          <div class="col-md-12">
                            <div class="form-group">                 
                              <a href="{{ route('games.sopaletras', $retos->id) }}" type="button" style="font-size: 1.7rem; width: 45%; white-space: nowrap;" class="btn btn-block btn-primary">
                                  <strong> Comenzar:</strong> {{ $retos->name }}
                              </a>
                            </div>
                          </div>
                        </div>
                                        
                        <strong>Descripcion:</strong>
                        <p style="color: #730028; font-size: 16px; font-weight: 600;">
                            {{ $retos->description }}.
                        </p>                                                                                                
                        <hr>
                        {{-- <div style="text-align:center;">
                          <h3>Estas listo?</h3>
                          <p>
                            <strong>"Antes de comenzar el reto, ver el material"</strong> 
                          </p> 
                        </div> --}}
                        
                        <hr>
                        @if( !empty($retos->material) )                              
                        <div class="col-md-12 col-sm-8 col-xs-12">
                          <div class="info-box">                                                        
                            

                              <div class="panel-group">
                                <div class="panel panel-default" style="box-shadow: 0px 5px 6px 0px #670024;border-color: #ea0d5b;">
                                  <div class="panel-heading" style="background-color: #ea0d5b; color: #fff;text-align: center;">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" href="#collapse1">Ver Material</a>
                                    </h4>
                                  </div>
                                  <div id="collapse1" class="panel-collapse collapse">
                                    <div class="panel-body">
                                    @if(strstr($retos->material, 'http:'))
                                      <embed src="{{ $retos->material }}" type="application/pdf" width="100%" height="600px" />
                                    @else
                                      <embed src="/storage/public/{{ $retos->material }}" type="application/pdf" width="100%" height="600px" />
                                    @endif
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>
                          @else
                          @endif
                        @break
                        
                    @case(4)                      
                      <div class="row" style="margin:4% 0% 0% 0%;text-align: -webkit-center;">
                        <div class="col-md-12">
                          <div class="form-group">                 
                            <a href="{{ route('games.rompecabezas', $retos->id) }}" type="button" style="font-size: 1.7rem; width: 45%; white-space: nowrap;" class="btn btn-block btn-primary">
                              <strong> Comenzar:</strong> {{ $retos->name }}
                            </a>
                          </div>
                        </div>            
                      </div>            
                                    
                        <strong>Descripcion:</strong>
                        <p style="color: #730028; font-size: 16px; font-weight: 600;">
                            {{ $retos->description }}.
                        </p>                                                                                                
                        <hr>

                        {{-- <div style="text-align:center;">
                          <h3>Estas listo?</h3>
                          <p>
                            <strong>"Antes de comenzar el reto, ver el material"</strong> 
                          </p> 
                        </div> --}}
                        
                        <hr>
                        
                        @if( !empty($retos->material) ) 
                        <div class="col-md-12 col-sm-8 col-xs-12">
                          <div class="info-box">                            
                  

                              <div class="panel-group">
                                <div class="panel panel-default" style="box-shadow: 0px 5px 6px 0px #670024;border-color: #ea0d5b;">
                                  <div class="panel-heading" style="background-color: #ea0d5b; color: #fff;text-align: center;">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" href="#collapse1">Ver Material</a>
                                    </h4>
                                  </div>
                                  <div id="collapse1" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      @if(strstr($retos->material, 'http:'))
                                        <embed src="{{ $retos->material }}" type="application/pdf" width="100%" height="600px" />
                                      @else
                                        <embed src="/storage/public/{{ $retos->material }}" type="application/pdf" width="100%" height="600px" />
                                      @endif
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>
                        @else
                          
                        @endif
                      @break

                    @case(5)
                        <div class="row" style="margin:4% 0% 0% 0%;text-align: -webkit-center;">
                          <div class="col-md-12">
                            <div class="form-group">                 
                              <a href="{{ route('games.seevideos', $retos->id) }}" type="button" style="font-size: 1.7rem; width: 45%; white-space: nowrap;" class="btn btn-block btn-primary">
                                  <strong> Comenzar:</strong> {{ $retos->name }}
                              </a>
                            </div>
                          </div>            
                        </div>            
                                      
                        <strong>Descripcion:</strong>
                        <p style="color: #730028; font-size: 16px; font-weight: 600;">
                            {{ $retos->description }}.
                        </p>                                                                                                
                        <hr>
                        {{-- <div style="text-align:center;">
                          <h3>Estas listo?</h3>
                          <p>
                            <strong>"Antes de comenzar el reto, ver el material"</strong> 
                          </p> 
                        </div> --}}
                        
                        <hr>
                        @if( !empty($retos->material) ) 
                        <div class="col-md-12 col-sm-8 col-xs-12">
                            <div class="info-box">
                              
                              <div class="panel-group">
                                <div class="panel panel-default" style="box-shadow: 0px 5px 6px 0px #670024;border-color: #ea0d5b;">
                                  <div class="panel-heading" style="background-color: #ea0d5b; color: #fff;text-align: center;">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" href="#collapse1">Ver Material </a>
                                    </h4>
                                  </div>
                                  <div id="collapse1" class="panel-collapse collapse">
                                    <div class="panel-body">
                                     @if(strstr($retos->material, 'http:'))
                                          <embed src="{{ $retos->material }}" type="application/pdf" width="100%" height="600px" />
                                      @else
                                          <embed src="/storage/public/{{ $retos->material }}" type="application/pdf" width="100%" height="600px" />
                                      @endif
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>
                        @else
                        
                        @endif
                        
                      @break

                    @case(6)                      
                      <div class="row" style="margin:4% 0% 0% 0%;text-align: -webkit-center;">
                        <div class="col-md-12">
                          <div class="form-group">                
                            <a href="{{ route('games.upfotos', $retos->id) }}" type="button" style="font-size: 1.7rem; width: 45%; white-space: nowrap;" class="btn btn-block btn-primary">
                              <strong> Comenzar:</strong> {{ $retos->name }}
                            </a>
                          </div>
                        </div>            
                      </div>            

                        <strong>Descripcion:</strong>
                        <p style="color: #730028; font-size: 16px; font-weight: 600;">
                            {{ $retos->description }}.
                        </p>                                                                                                
                        <hr>
                        {{-- <div style="text-align:center;">
                          <h3>Estas listo?</h3>
                          <p>
                            <strong>"Antes de comenzar el reto, ver el material"</strong> 
                          </p> 
                        </div> --}}
                        
                        <hr>

                        @if( !empty($retos->material) ) 
                          <div class="col-md-12 col-sm-8 col-xs-12">
                            <div class="info-box">                              
                              
                              <div class="panel-group">
                                <div class="panel panel-default" style="box-shadow: 0px 5px 6px 0px #670024;border-color: #ea0d5b;">
                                  <div class="panel-heading" style="background-color: #ea0d5b; color: #fff;text-align: center;">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" href="#collapse1">Ver Material</a>
                                    </h4>
                                  </div>
                                  <div id="collapse1" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      @if(strstr($retos->material, 'http:'))
                                          <embed src="{{ $retos->material }}" type="application/pdf" width="100%" height="600px" />
                                      @else
                                          <embed src="/storage/public/{{ $retos->material }}" type="application/pdf" width="100%" height="600px" />
                                      @endif
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>
                        @else
                        
                        @endif
                      @break

                    @case(7)                      
                        <div class="row" style="margin:4% 0% 0% 0%;text-align: -webkit-center;">
                          <div class="col-md-12">
                            <div class="form-group">                 
                              <a href="{{ route('games.lectura', $retos->id) }}" type="button" style="font-size: 1.7rem; width: 45%; white-space: nowrap;" class="btn btn-block btn-primary">
                                <strong> Comenzar:</strong> {{ $retos->name }}
                              </a>
                            </div>   
                          </div>   
                        </div>   

                        <strong>Descripcion:</strong>
                        <p style="color: #730028; font-size: 16px; font-weight: 600;">
                            {{ $retos->description }}.
                        </p>                                                                                                
                        <hr>
                        {{-- <div style="text-align:center;">
                          <h3>Estas listo?</h3>
                          <p>
                            <strong>"Antes de comenzar el reto, ver el material"</strong> 
                          </p> 
                        </div> --}}
                        
                        <hr>

                        @if( !empty($retos->material) ) 
                          <div class="col-md-12 col-sm-8 col-xs-12">
                            <div class="info-box">                              
                             <!--descargar material-->
                             <br>
                                  <div class="form-group visible-xs"> 
                                    <a href="/storage/public/{{ $retos->material }}" target="_blank" class="btn btn-block btn-info" style="white-space:normal;" download>
                                      <i class="fa fa-download"></i>
                                      Descargar material
                                    </a>                                    
                                  </div> 
                                  <!--end material-->  
                            
                              <div class="panel-group">
                                <div class="panel panel-default" style="box-shadow: 0px 5px 6px 0px #670024;border-color: #ea0d5b;">
                                  <div class="panel-heading" style="background-color: #ea0d5b; color: #fff;text-align: center;">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" href="#collapse1">Ver Material</a>
                                    </h4>
                                  </div>
                                  <div id="collapse1" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      @if(strstr($retos->material, 'http:'))
                                        <embed src="{{ $retos->material }}" type="application/pdf" width="100%" height="600px" />
                                      @else
                                        <embed src="/storage/public/{{ $retos->material }}" type="application/pdf" width="100%" height="600px" />
                                      @endif
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>
                        @else
                        
                        @endif
                      @break

                    @case(8)                      
                      <div class="row" style="margin:4% 0% 0% 0%;text-align: -webkit-center;">
                        <div class="col-md-12">
                          <div class="form-group">                
                            <a href="{{ route('games.outdoor', $retos->id) }}" type="button" style="font-size: 100%; width: 45%; white-space: nowrap;" class="btn btn-block btn-primary">
                              <strong> Comenzar:</strong> {{ $retos->name }}
                            </a>
                          </div>
                        </div>            
                      </div>            


                        <strong>Descripcion:</strong>
                        <p style="color: #730028; font-size: 16px; font-weight: 600;">
                            {{ $retos->description }}.
                        </p>                                                                                                
                        <hr>
                        {{-- <div style="text-align:center;">
                          <h3>Estas listo?</h3>
                          <p>
                            <strong>"Antes de comenzar el reto, ver el material"</strong> 
                          </p> 
                        </div> --}}
                        
                        <hr>
                        @if( !empty($retos->material) ) 
                          <div class="col-md-12 col-sm-8 col-xs-12">
                            <div class="info-box">                                                            

                                <div class="panel-group">
                                    <div class="panel panel-default" style="box-shadow: 0px 5px 6px 0px #670024;border-color: #ea0d5b;">
                                      <div class="panel-heading" style="background-color: #ea0d5b; color: #fff;text-align: center;">
                                        <h4 class="panel-title">
                                          <a data-toggle="collapse" href="#collapse1">Ver Material</a>
                                        </h4>
                                      </div>
                                      <div id="collapse1" class="panel-collapse collapse">
                                        <div class="panel-body">
                                          @if(strstr($retos->material, 'http:'))
                                          <embed src="{{ $retos->material }}" type="application/pdf" width="100%" height="600px" />
                                          @else
                                          <embed src="/storage/public/{{ $retos->material }}" type="application/pdf" width="100%" height="600px" />
                                          @endif
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>
                        @else
                        
                        @endif
                      @break
                    @default
                        Default case...
                  @endswitch
              </div>
              <!-- /.user-block -->
            </div>
            <!-- /.post -->
          </div>
        
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.1.2
  </div>
  <strong>Copyright &copy; 2018 <a href="#">Evolución</a>.</strong> All rights
  reserved.
</footer>


<!-- ./wrapper -->

@endsection
