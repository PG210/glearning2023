@extends('layouts.app')

@section('content')
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1 style="font-size: 5rem; margin: 4% 0% 2% 0%;">
        Bienvenido {{ Auth::user()->firstname }}
      </h1>
  </section>
  <!-- Main content -->
  <section class="content">    
    <tiempos-component tiempoasignado="{{ $tiempoasignado }}"></tiempos-component>  
     <!-- /.row -->
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#activity" data-toggle="tab">Reto</a></li>
          <li><a href="#timeline" data-toggle="tab">Recursos</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="activity">
            <!-- Post -->
            <?php
              $quizz = DB::table('quizzes')->where('id', $idreto)->get();                                               
            ?>

            <div class="post">
              <div class="user-block">                            
                <h1>Reto Encuesta</h1>
                {{-- <p style="text-align: center;">{{ $quizz[0]->description }}</p> --}}
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  <!-- se va para PlayerChallengeController@store -->
                  <form method="POST" action="{{ route('startchallenges.store') }}">
                    @csrf
                    @foreach($questions as $question)
                      <input type="hidden" name="quizactual" value="{{ $question->quiz_id }}">
                      <input type="hidden" name="preguntas[]" value="{{ $question->id }}">                    
                      <input type="hidden" name="usuario" value="{{ Auth::user()->id }}">
                      <input type="hidden" name="idretoactual" value="{{ $idreto }}">
  
                      <div class="box box-info">
                        <div class="box-header with-border">
                            <h2 class="box-title">{{ $question->question }}</h2>
                        </div>
                        <div class="box-body"> 
                          <?php
                            $answers = DB::table('quiz_question_answers')->where('quizquestion_id', $question->id)->get();                        
                          ?>
                          @foreach($answers as $answe)
                        <input type="hidden" name="idquizzes[]" value="{{$answe->quizquestion_id}}">
                            <div class="form-group">
                              <div class="radio">
                                  <label>
                                  <input type="radio" name="{{$answe->quizquestion_id}}" value="{{ $answe->id }}">
                                      {{ $answe->answer }} 
                                  </label>
                              </div>
                            </div>
                          @endforeach
                          <!-- /input-group -->
                          </div>
                          <!-- /.box-body -->
                      </div>
                    @endforeach
                    <div class="box-footer" style="text-align: -webkit-center;">
                        <button type="submit" class="btn btn-primary" style="font-family: effortless; width: 40%; font-size: 2.6rem;">TERMINAR</button>
                    </div>
                  </form>                
                </div>
                <div class="col-md-3"></div>

              </div>
              <!-- /.user-block -->
            </div>
            <!-- /.post -->
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="timeline">
            <!-- The timeline -->
            <ul class="timeline timeline-inverse">
              <!-- timeline time label -->
              <!-- <li class="time-label">
                    <span class="bg-red">
                      12 Dic. 2018 (Fecha actual desde el servidor)
                    </span>
              </li> -->
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <li>
                <i class="fa fa-envelope bg-blue"></i>

                <div class="timeline-item">
                  <!-- <span class="time"><i class="fa fa-clock-o"></i> 12:05 (Hora PC)</span> -->

                  <h3 class="timeline-header"><a href="#">Recurso Reto 1</a> </h3>

                  <div class="timeline-body">
                    Bienvenido a la Evolución
                  </div>
                </div>
              </li>
              <!-- END timeline item -->

              <li>
                <i class="fa fa-check-circle bg-gray"></i>
              </li>
            </ul>
          </div>
          <!-- /.tab-pane -->
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
