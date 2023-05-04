@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="javascript:window.history.back(1);">Qüices</a></li>
    <li class="active">Qüices-create</li>
    </ol>
</section>
@endsection



@section('quizzesCreate')

  <h1>
    Agregar Nuevos Qüices     
  </h1>

  <div id="app">
    <quizcreation-component></quizcreation-component>    
  </div>
@endsection