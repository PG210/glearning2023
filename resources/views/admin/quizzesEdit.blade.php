@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="javascript:window.history.back(1);">Qüices</a></li>
    <li class="active">Qüices-Editar</li>
    </ol>
</section>
@endsection


@section('quizzesCreate')

  <h1>
    Actualizar Qüices - quizz   {{ $idquizz }} 
  </h1>


  <?php
  
    $quizzes = DB::table('quizzes')->where('id', $idquizz)->get();              

    $quizquestions = DB::table('quiz_questions')->where('quiz_id', $idquizz)->get();                
  ?>




<div class="box box-default" style="margin-top: 5%;">
  <div class="box-body">
    <div class="row">
      <div class="col-md-6">

          <form method="POST" action="{{ route('quizzes.update', $idquizz) }}">
              @csrf
              @method('PUT')
              
              @foreach ($quizquestions as $quizquest) 
               <!-- PREGUNTAS -->
               <div class="form-group">
                 <input type="text" class="form-control" name="preguntas[{{$quizquest->id}}][pregunta]" value="{{$quizquest->question}}" id=""> 
                 <input type="hidden" name="preguntas[{{$quizquest->id}}][id]" value="{{$quizquest->id}}"> 
               </div>
                
                  <?php
                    $quizquestionsanswers = DB::table('quiz_question_answers')->where('quizquestion_id', $quizquest->id)->get();                
                  ?>  
                <div class="col-md-2"></div>

                <div class="col-md-10" style=" margin-bottom:3%; ">
                  <h3>Respuestas:</h3>
                  @foreach ($quizquestionsanswers as $quizquestionsans)
                    <!-- RESPUESTAS -->
                    <div class="form-inline">
                      <div class="form-group col-md-8">                      
                        <input type="text" class="form-control" name="respuestas[{{$quizquestionsans->id}}][answer]" value="{{$quizquestionsans->answer}}" id="">
                        <input type="hidden" name="respuestas[{{$quizquestionsans->id}}][id]" value="{{$quizquestionsans->id}}"> 
                        
                      </div>
  
                      <div class="form-group col-md-2">
                        <input type="radio" name="respuestas[{{$quizquestionsans->id}}][correct]" id="" value="1">                        
                      </div>

                      <div class="form-group col-md-2">
                        @if ($quizquestionsans->correct==1)
                          <img src="{{ asset('dist/img/checked.png') }}" style="width: 42%;">                            
                        @endif                                                
                      </div>

                    </div>                    

                  @endforeach
                </div>
              @endforeach
              <div class="row">
                <div class="col-md-8" >
                  <div class="btn-group">
                    <button type="submit" class="btn btn-default">Actualizar</button>
                  </div>                     
                </div>
              </div>            
          </form>





      </div>
    </div>
  </div>
</div>



  {{-- <div id="app">
    <quizeupdate-component
    iddequiz="{{ $idquizz }}">
    </quizeupdate-component>    
  </div> --}}
@endsection