@extends('layouts.app')

@section('content')

<style>
    .content-wrapper {
        background-image: url("{{ asset('dist/img/BG02.png') }}");
    }
</style>



<div class="container">
    <br><br>
    <div class="row justify-content-center">
        <div class="col-md-12" style="padding-bottom: 5%;">
          <div class="card4">
            <div class="box-body" style="padding: 2%;box-shadow:none; border-radius 0px;">
           
            <form method="POST" enctype="multipart/form-data" action="{{ route('usuario.updatepic', Auth::user()->id) }}">
                @csrf
                @method('PUT') 
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="fotografia">Fotografia</label>
                        <input type="file" class="form-control" name="fotografia" id="fotografia">
                    </div>                                         
                </div>                            
                <div class="row">
                    <div class="col-md-8" >
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>            
            </form>

            </div>
          </div>
        </div>
    </div>
    <div class="row justify-content-center esp">
        <div class="col-md-12 loguin">
            <img src="{{ asset('dist/img/LOGOCOOMEVA.png')}}" alt="Logo Coomeva">
        </div>
    </div>
</div>


@endsection

