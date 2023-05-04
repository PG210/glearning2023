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
        <div class="form-group">
          
          <form method="POST" action="{{ route('quizzes.update', $idquizz) }}">
              @csrf
              @method('PUT')
              
              @foreach ($quizquestions as $quizquest) 
               <!-- PREGUNTAS -->           
                <input type="text" class="form-control" name="preguntas[{{$quizquest->id}}][pregunta]" value="{{$quizquest->question}}" id=""> 
                <input type="hidden" name="preguntas[{{$quizquest->id}}][id]" value="{{$quizquest->id}}"> 
                
                  <?php
                    $quizquestionsanswers = DB::table('quiz_question_answers')->where('quizquestion_id', $quizquest->id)->get();                
                  ?>  
                <div class="col-md-2">
                </div>
                <div class="col-md-10">
                  <h3>Respuestas:</h3>
                  @foreach ($quizquestionsanswers as $quizquestionsans)
                    <!-- RESPUESTAS -->           
                    <input type="text" class="form-control" name="respuestas[{{$quizquestionsans->id}}][answer]" value="{{$quizquestionsans->answer}}" id="">
                    <input type="hidden" name="respuestas[{{$quizquestionsans->id}}][id]" value="{{$quizquestionsans->id}}"> 
                    <input type="radio" name="respuestas[{{$quizquestionsans->id}}][correct]" id="" value="1">

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
</div>



  {{-- <div id="app">
    <quizeupdate-component
    iddequiz="{{ $idquizz }}">
    </quizeupdate-component>    
  </div> --}}
@endsection