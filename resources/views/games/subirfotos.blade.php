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
    <h1>
      Bienvenido {{ Auth::user()->firstname }}
    </h1>
    <ol class="breadcrumb">
      <!-- <li><a href="#"><i class="fa fa-dashboard"></i> Retos</a></li> -->
      <!-- <li><a href="#">Mision 1</a></li>
      <li class="active">Reto 1</li> -->
    </ol>
  </section>

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

  <!-- Main content -->
  <section class="content">

     <!-- /.row -->

    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#activity" data-toggle="tab">Reto</a></li>
          {{-- <li><a href="#timeline" data-toggle="tab">Recursos</a></li>
          <li><a href="#settings" data-toggle="tab">Recompensas</a></li> --}}
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="activity">
            <!-- Post -->
            <div class="post">
              <div class="user-block">
            <h1>COMENZANDO EL RETO - Subir Fotografia</h1>
            <p style="color: #730028; font-size: 16px; font-weight: 600; text-align: center;">
              {{ $retos->description }}
            </p>
            <tiempos-component tiempoasignado="{{ $retos->time }}"></tiempos-component>

            <form method="POST" enctype="multipart/form-data" action="{{ route('gamesplay.upfotos', 5) }}">
                @csrf
                <input type="hidden" name="usuario" value="{{ Auth::user()->id }}">
                <input type="hidden" name="reto" value="{{ $retos->id }}">
                
                <div class="row" style="margin:4% 0% 0% 0%;text-align: -webkit-center;">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="image">Subir Foto</label>
                        <input type="file" class="form-control" name="image" id="image" placeholder="Sube tu imagen" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="link">Link de video (Opcional)</label>
                        <input type="text" class="form-control" name="video" id="video" placeholder="Agrega tu link">
                    </div>
                    <div class="form-group">
                        <label for="evidence">Descripcion Foto - Minimo 120 Caracteres</label>
                        <textarea class="form-control{{ $errors->has('evidence') ? ' is-invalid' : '' }}" rows="5" name="evidence" id="evidence" spellcheck="true" placeholder="A continuación escribe tus respuestas a las instrucciones planteadas en el Reto">{{ old('evidence') }}</textarea>
                    </div>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary">Terminar</button>
            </form>

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

          <div class="tab-pane" id="settings">
            <!-- RECOMPENSAS -->
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
