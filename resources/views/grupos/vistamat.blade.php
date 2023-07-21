@extends('layouts.app')
@section('nperfil')
<br>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Bienvenido {{ Auth::user()->firstname }}
    </h1>
    <ol class="breadcrumb">
      <!-- <li><a href="#"><i class="fa fa-dashboard"></i> Retos</a></li> -->
      <!-- <li><a href="#">Mision 1</a></li>
      <li class="active">Reto 1</li> -->
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">

        <h2>MATERIAL DISPONIBLE</h2>
        <!-- <p>vista para todos los capitulos, los datos se cargan dinamicamente</p> -->
        <p>
          Aquí encontraras el material disponible para descargar a medida que avanzas en cada capítulo de la historia
        </p>
      </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
      <!-- About Me Box -->
    </div>
    <!-- /.row -->

    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active">
            <a href="#insignias" data-toggle="tab" style="font-size:20px;">Lista de capítulos</a>
        </li>
          <!-- <li><a href="#settings" data-toggle="tab">Causas</a></li> -->
        </ul>
        <div class="tab-content">
          <!-- INSIGNIAS -->
          <div class="active tab-pane" id="insignias">
            <!-- ACCESORIOS -->
            <div class="post">
            @foreach($ninfo as $a)
              <div class="row">
                <div class="col-md-6">
                <h3>{{ $a["nombre"] }}</h3>
                   <p>
                   {{ $a["titulo"] }}
                    </p>
                </div>
                <div class="col-md-6 text-right">
                <br>
                @if($a["tfaltan"] <= 0)
                  <!--validar que capitulo es para descargar la info-->
                    @switch($a["capitulo"])
                        @case("1")
                            <a href="#" class="btn btn-info"><i class="fa fa-download"></i> Descargar </a>
                            @break

                        @case("2")
                            <a href="{{asset('/dist/materialcapitulos/capitulo_autoliderazgo.zip')}}" class="btn btn-info" download><i class="fa fa-download"></i> Descargar </a>
                            @break

                        @case("3")
                            <a href="{{asset('/dist/materialcapitulos/capitulo_administracion_del_tiempo.zip')}}" class="btn btn-info"><i class="fa fa-download"></i> Descargar </a>
                            @break
    
                        @case("4")
                            <a href="{{asset('/dist/materialcapitulos/capitulo_desarrollo_de_personas.zip')}}" class="btn btn-info"><i class="fa fa-download"></i> Descargar </a>
                            @break
                        
                        @case("5")
                            <a Href="#" class="btn btn-info"><i class="fa fa-download"></i> Descargar </a>
                            @break
                        
                        @case("6")
                            <a Href="#" class="btn btn-info"><i class="fa fa-download"></i> Descargar </a>
                            @break

                        @case("7")
                            <a Href="#" class="btn btn-info"><i class="fa fa-download"></i> Descargar </a>
                            @break
                        @default
                            <p>No hay información</p>
                    @endswitch
                  <!--end validacion-->
                 @else
                 <a Href="#" class="btn btn-info" disabled><i class="fa fa-download"></i> Descargar </a>
                @endif
                </div>
              </div>
            @endforeach
            </div>
            <!-- /.post -->
            
          </div>
          <!-- /.tab-pane -->
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
@endsection