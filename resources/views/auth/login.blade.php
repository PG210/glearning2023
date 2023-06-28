@extends('layouts.basics')

@section('content')


<style>
    .main-header{
      display: none;
    }

    body{
      background-image: url("{{ asset('dist/img/LOG_BG.jpg') }}");
      background-repeat: no-repeat;
      background-size: cover;
    }

    .m-b-md {
        margin-bottom: 30px;
        font-size: 1.3vw;
    }

</style>

<!--<div class="container">-->
    <div class="row justify-content-center">

        <div class="formi" style="margin-top:15%;">
            <div class="card">
                <!-- <div class="card-header">{{ __('Iniciar') }}</div> -->
                <div class="title m-b-md">
                    Inicia Sesión en <strong>EVO</strong>LUCIÓN
                </div>
                @if(Session::has('errorInicio'))
                <div style="margin-right:10px;">
                <div class="alert alert-warning alert-dismissable" style="border-radius:15px;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>{{session('errorInicio')}}</strong> 
                </div>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
<!--
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Direccion E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>-->

                        <div class="form-group row">
                            <label for="username" class="col-sm-4 col-form-label text-md-right">{{ __('Nombre Usuario') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-4 col-form-label text-md-right" for="remember">
                              {{ __('Recordar Cuenta') }}
                          </label>

                            <div class="col-md-1">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-11 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ingresar') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Olvidaste tu Contraseña?') }}
                                    </a>
                                @endif
                               <!-- <a class="btn btn-link" href="{{ route('usuario.create') }}">
                                    {{ __('No tienes Cuenta?') }}
                                </a>-->
                                <a class="btn btn-link" href="{{url('/') }}">
                                    {{ __('Volver') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!--</div>-->
@endsection
