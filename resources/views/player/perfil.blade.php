@extends('layouts.app')

@section('contentperfil')

<?php
  $users = App\User::find(Auth::user()->id);
?>

<!-- Left side column. contains the logo and sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Perfil de {{ Auth::user()->firstname }}
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">
            <!-- <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture"> -->

            <h3 class="profile-username text-center">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h3>
            <p class="text-muted text-center">{{ Auth::user()->username }}</p>
            <p class="text-muted text-center">Tipo de Personaje (Personaje Seleccionado en Registro)</p>

            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>Email</b> <a class="pull-right">{{ Auth::user()->email }}</a>
              </li>
              <li class="list-group-item">
                <b>Miembro desde</b> <a class="pull-right">{{ Auth::user()->created_at }}</a>
              </li>
              <li class="list-group-item" style="padding-bottom: 39px!important;">
                <b>Grupos a los que pertenece</b> 
                <a class="pull-right">(Grupos en los que esta metido)</a>
              </li>

              <li class="list-group-item">
                <b>Insignias</b> 
                <ul>
                  @foreach($users->insignias as $insignia)
                  <li>
                    <img src="{{ asset($insignia->imagen)}}" width="12px">
                    {{ $insignia->name }} 
                  </li>
                  @endforeach
                </ul>
              </li>

              <li class="list-group-item" style="padding-bottom: 39px!important;">
                <b>Reconocimientos</b> <a class="pull-right">(Reconocimientos Ganados)</a>
              </li>
              <li class="list-group-item" style="padding-bottom: 39px!important;" >
                <b>Retos realizados</b> <a class="pull-right">(Cantida de retos hechos)</a>
              </li>
            </ul>

            <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- About Me Box -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Sobre {{ Auth::user()->firstname }}</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <!-- <hr> -->
            <strong><i class="fa fa-file-text-o margin-r-5"></i> Información</strong>

            <p class="text-muted">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque. {{ Auth::user()->description }}
            </p>

            <hr>

            <strong><i class="fa fa-book margin-r-5"></i> Cargo</strong>

            <p class="text-muted">
              (Cargo Registrado)
            </p>

            <hr>

            <strong><i class="fa fa-map-marker margin-r-5"></i> Área</strong>

            <p class="text-muted">(Área Registrada)</p>

            <hr>

            <strong><i class="fa fa-pencil margin-r-5"></i> Fortalezas</strong>

            <p>
              <span class="label label-danger">Reconocimiento 1</span>
              <span class="label label-success">Reconocimiento 2</span>
              <span class="label label-info">Insignia 1</span>
              <span class="label label-warning">Insignia 2</span>
              <span class="label label-primary">Reconocimiento 3</span>
            </p>


          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab">Actividad</a></li>
            <li><a href="#timeline" data-toggle="tab">Linea de Tiempo</a></li>
            <li><a href="#settings" data-toggle="tab">Configuración</a></li>
          </ul>
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <!-- Post -->
                <?php
                    $useravatar = App\User::find(Auth::user()->id);                
                    $avatarimage = App\Avatar::find($useravatar->avatar_id);
                ?>
              <div class="post">
                <div class="user-block">
                  <img class="img-circle img-bordered-sm" src="{{ $avatarimage->img }}" alt="user image">
                      <span class="username">
                        <a href="#">{{ Auth::user()->firstname }}</a>
                        <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                      </span>
                  <span class="description">Inició Capitulo 1 - 7:30 AM - 18/12/2018</span>
                </div>
                <!-- /.user-block -->
                <p>
                  (Descripcion Capitulo 1)
                </p>
                <ul class="list-inline">
                  <!-- <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li> -->
                  <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Me Gusta</a>
                  </li>
                  <li class="pull-right">
                    <!-- <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                      (5)</a></li> -->
                </ul>

                <!-- <input class="form-control input-sm" type="text" placeholder="Type a comment"> -->
              </div>
              <!-- /.post -->

              <!-- Post -->
              <!-- <div class="post clearfix">
                <div class="user-block">
                  <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                      <span class="username">
                        <a href="#">Sarah Ross</a>
                        <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                      </span>
                  <span class="description">Sent you a message - 3 days ago</span>
                </div> -->
                <!-- /.user-block -->
                <!-- <p>
                  Lorem ipsum represents a long-held tradition for designers,
                  typographers and the like. Some people hate it and argue for
                  its demise, but others ignore the hate as they create awesome
                  tools to help create filler text for everyone from bacon lovers
                  to Charlie Sheen fans.
                </p>

                <form class="form-horizontal">
                  <div class="form-group margin-bottom-none">
                    <div class="col-sm-9">
                      <input class="form-control input-sm" placeholder="Response">
                    </div>
                    <div class="col-sm-3">
                      <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Send</button>
                    </div>
                  </div>
                </form>
              </div> -->
              <!-- /.post -->

              <!-- Post -->
              <!-- <div class="post">
                <div class="user-block">
                  <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg" alt="User Image">
                      <span class="username">
                        <a href="#">Adam Jones</a>
                        <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                      </span>
                  <span class="description">Posted 5 photos - 5 days ago</span>
                </div> -->
                <!-- /.user-block -->
                <!-- <div class="row margin-bottom">
                  <div class="col-sm-6">
                    <img class="img-responsive" src="../../dist/img/photo1.png" alt="Photo">
                  </div> -->
                  <!-- /.col -->
                  <!-- <div class="col-sm-6">
                    <div class="row">
                      <div class="col-sm-6">
                        <img class="img-responsive" src="../../dist/img/photo2.png" alt="Photo">
                        <br>
                        <img class="img-responsive" src="../../dist/img/photo3.jpg" alt="Photo">
                      </div> -->
                      <!-- /.col -->
                      <!-- <div class="col-sm-6">
                        <img class="img-responsive" src="../../dist/img/photo4.jpg" alt="Photo">
                        <br>
                        <img class="img-responsive" src="../../dist/img/photo1.png" alt="Photo">
                      </div> -->
                      <!-- /.col -->
                    <!-- </div> -->
                    <!-- /.row -->
                  <!-- </div> -->
                  <!-- /.col -->
                <!-- </div> -->
                <!-- /.row -->

                <!-- <ul class="list-inline">
                  <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                  <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                  </li>
                  <li class="pull-right">
                    <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                      (5)</a></li>
                </ul>

                <input class="form-control input-sm" type="text" placeholder="Type a comment">
              </div> -->
              <!-- /.post -->
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="timeline">
              <!-- The timeline -->
              <ul class="timeline timeline-inverse">
                <!-- timeline time label -->
                <li class="time-label">
                      <span class="bg-red">
                        12 Dic. 2018 (Fecha actual desde el servidor)
                      </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>
                  <i class="fa fa-envelope bg-blue"></i>

                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 12:05 (Hora PC)</span>

                    <h3 class="timeline-header"><a href="#">Usuario Registrado</a> Se ha registrado como usuario en Evolución</h3>

                    <div class="timeline-body">
                      Bienvenido a la Evolución
                    </div>
                    <!-- <div class="timeline-footer">
                      <a class="btn btn-primary btn-xs">Read more</a>
                      <a class="btn btn-danger btn-xs">Delete</a>
                    </div> -->
                  </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline item -->
                <li>
                  <i class="fa fa-user bg-aqua"></i>

                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 12:15 (Hora PC)</span>

                    <h3 class="timeline-header no-border"><a href="#">Miguel Rodriguez</a> Ha aceptado tu reto.
                    </h3>
                  </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline item -->
                <li>
                  <i class="fa fa-comments bg-yellow"></i>

                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 12:45 (Hora PC)</span>

                    <h3 class="timeline-header"><a href="#">Evolución</a> Ha comentado tu actividad (Nombre Reto)</h3>

                    <div class="timeline-body">
                      Excelente, reto cumplido
                    </div>
                    <!-- <div class="timeline-footer">
                      <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                    </div> -->
                  </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline time label -->
                <!-- <li class="time-label">
                      <span class="bg-green">
                        3 Jan. 2014
                      </span>
                </li> -->
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <!-- <li>
                  <i class="fa fa-camera bg-purple"></i>

                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                    <div class="timeline-body">
                      <img src="http://placehold.it/150x100" alt="..." class="margin">
                      <img src="http://placehold.it/150x100" alt="..." class="margin">
                      <img src="http://placehold.it/150x100" alt="..." class="margin">
                      <img src="http://placehold.it/150x100" alt="..." class="margin">
                    </div>
                  </div>
                </li> -->
                <!-- END timeline item -->
                <li>
                  <i class="fa fa-clock-o bg-gray"></i>
                </li>
              </ul>
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" id="settings">
              <form class="form-horizontal">
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">Nombre de Usuario</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputName" placeholder="Nombre">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputExperience" class="col-sm-2 control-label">Información</label>

                  <div class="col-sm-10">
                    <textarea class="form-control" id="inputExperience" placeholder="Información"></textarea>
                  </div>
                </div>

                <!-- <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                      </label>
                    </div>
                  </div>
                </div> -->
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Enviar</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

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

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Create the tabs -->
  <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
    <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
    <!-- <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li> -->
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <!-- Home tab content -->
    <div class="tab-pane" id="control-sidebar-home-tab">

      <!-- /.control-sidebar-menu -->

      <h3 class="control-sidebar-heading">Progreso del Jugador</h3>
      <ul class="control-sidebar-menu">
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Capitulo 1 - Mision 1
              <span class="label label-success pull-right">90%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-success" style="width: 90%"></div>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Capitulo 1 - Mision 2
              <span class="label label-danger pull-right">5%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-danger" style="width: 5%"></div>
            </div>
          </a>
        </li>
        <!-- <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Laravel Integration
              <span class="label label-warning pull-right">50%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Back End Framework
              <span class="label label-primary pull-right">68%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
            </div>
          </a>
        </li> -->
      </ul>
      <!-- /.control-sidebar-menu -->

    </div>
    <!-- /.tab-pane -->
    <!-- Stats tab content -->
    <!-- <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div> -->
    <!-- /.tab-pane -->
    <!-- Settings tab content -->
    <!-- <div class="tab-pane" id="control-sidebar-settings-tab">
      <form method="post">
        <h3 class="control-sidebar-heading">General Settings</h3>

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Report panel usage
            <input type="checkbox" class="pull-right" checked>
          </label>

          <p>
            Some information about this general settings option
          </p>
        </div> -->
        <!-- /.form-group -->

        <!-- <div class="form-group">
          <label class="control-sidebar-subheading">
            Allow mail redirect
            <input type="checkbox" class="pull-right" checked>
          </label>

          <p>
            Other sets of options are available
          </p>
        </div> -->
        <!-- /.form-group -->

        <!-- <div class="form-group">
          <label class="control-sidebar-subheading">
            Expose author name in posts
            <input type="checkbox" class="pull-right" checked>
          </label>

          <p>
            Allow the user to show his name in blog posts
          </p>
        </div> -->
        <!-- /.form-group -->

        <!-- <h3 class="control-sidebar-heading">Chat Settings</h3>

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Show me as online
            <input type="checkbox" class="pull-right" checked>
          </label>
        </div> -->
        <!-- /.form-group -->

        <!-- <div class="form-group">
          <label class="control-sidebar-subheading">
            Turn off notifications
            <input type="checkbox" class="pull-right">
          </label>
        </div> -->
        <!-- /.form-group -->

        <!-- <div class="form-group">
          <label class="control-sidebar-subheading">
            Delete chat history
            <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
          </label>
        </div> -->
        <!-- /.form-group -->
      <!-- </form>
    </div> -->
    <!-- /.tab-pane -->
  </div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@endsection
