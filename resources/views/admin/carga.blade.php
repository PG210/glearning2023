@extends('layouts.basics')

@section('content')

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
    .btn-nu{
        text-decoration: none;
        padding: 10px;
        font-weight: 300;
        font-size: 15px;
        color: #ffffff;
        background-color: #1883ba;
        border-radius: 6px;
        border: 2px solid #0016b0;

    } 
    .btn-nu:hover{
        color: #1883ba;
        background-color: #ffffff;
    }
    .btn-g{
        text-decoration: none;
        padding: 10px;
        font-weight: 300;
        font-size: 15px;
        color: black;
        background-color: #9EE1E2;
        border-radius: 6px;
        border: 2px solid #0016b0;

    } 
    .btn-g:hover{
        color: #1883ba;
        background-color: #ffffff;
    }
     .tex{
         font-weight: 300;
         font-size: 20px;
         color: black;
     }
    .mensaje {
    color: #4F8A10;
    background-color: #DFF2BF;
}
</style>

<script src="{{ asset('dist/js/MyJs.js') }}"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="formi">
            <div class="card">
              <div class="tex text-center">
                 <b> Registro Masivo de Usuarios </b>
                </div>
                <div class="Container">
                 @if(Session::has('mensaje'))
                    <div class="mensaje" >{{Session('mensaje')}}</div>
                 @endif
                 <div class="card-body">
                    <form method="POST" action="{{route('subir')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="uploadedfile">Eliga un archivo .txt</label>
                            <input type="file" name="uploadedfile" id="uploadedfile" accept=".txt*" class="form-control-file" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Descripciòn</label>
                            <input type="text" name="nombre" id="nombre" class="form-control-file" required>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{url('/usuario')}}" class="btn-nu btn-secondary me-md-2" type="button"><span>Volver</span></a>
                            <button class="btn-g" type="submit"><span>Guardar</span></button>
                            <a href="{{route('crg')}}" class="btn-nu btn-secondary me-md-2" type="button"><span>Archivos Cargados</span></a>
                        </div>
                        
                    </form>
                </div>
              </div>
            </div>
        </div>
       
    </div>
   
</div>

@endsection
