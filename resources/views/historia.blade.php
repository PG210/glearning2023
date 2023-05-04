@extends('layouts.app')
<style>
  .imagi{
    width: 49% !important;
    height: auto !important;
    float: inherit !important;
    padding: 2%;
  }
</style>
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

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">

        <h2>HISTORIA</h2>
        <!-- <p>vista para todos los capitulos, los datos se cargan dinamicamente</p> -->

        <h3>Evolución</h3>
        <p>
          Aqui podras concer la historia del juego Evolución
        </p>


      </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
      <!-- About Me Box -->
      <!-- <div class="box box-primary">
        <h2>Acciones de Recompensas</h2>


      </div> -->
    </div>
    <!-- /.row -->

    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#activity" data-toggle="tab">Historia</a></li>
          <li><a href="#timeline" data-toggle="tab">Personajes</a></li>
          <li><a href="#settings" data-toggle="tab">Glosario</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="activity">
            <!-- Post -->
            <div class="post">
              <div class="user-block">

                <iframe width="100%" height="640" src="https://www.youtube.com/embed/HSEvsaWQS8g" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

              </div>


            </div>
            <!-- /.post -->
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="timeline">
            <div class="post">
              <div class="user-block">
                <?php
                    $avatars = DB::table('avatars')->get();
                ?>

                <span class="description col-md-8">
                  Existen 4 clases de ciborg, todos somos iguales en sí, pero según nuestra alteración en el cuerpo se nos brinda una categoría, estos implantes son únicos para cada categoría, pero el que nos caracteriza es nuestro implante principal, los implantes secundarios son modificaciones que tomamos con el tiempo, mientras aprendemos y mejoramos:
                  <br><br>
                  <ul>
                    <li>
                      <h3>Memorex</h3>
                      <div>
                        <img class="imagi" src="{{ $avatars[0]->img }}" alt="personajes">
                        <img class="imagi" src="{{ $avatars[4]->img }}" alt="personajes">
                      </div>
                      Especialistas en el manejo de cualquier tipo de información, eficientes en recolectar información, cuentan con una capacidad de memoria muy alta, al igual que su capacidad de analizar las cosas. Eran usados en el campo abierto para recolectar información vital que no podían perder en la tierra.
                      <br><br>
                      <h4>Implante Principal</h4>
                      Los Memorex tienen un implante especial ubicado en el rostro, un brazo especial, con el cual puede interactuar y abrir cualquier tipo de cerradura tanto física como digital y manejan un implante en la cabeza, es un dispositivo que puede almacenar datos el cual está conectado al lóbulo frontal (sección de concentración y pensamiento) y al lóbulo temporal del cerebro (sección de la memoria) con lo que mejora un 200% el campo de la memoria y la capacidad de analizar información.
                      <br><br>
                      <h4>Implantes Secundarios</h4>
                      <ul>
                        <li>Ojo cibernético InfoTech: Este es un ojo robótico que se conecta directamente al implante principal del memorex, mejora su forma de tomar información de lo que ve y se almacena directamente en la memoria.</li>
                        <li>Muñequera de codificación techno: Es un aparato que se pone en la muñeca y parte del antebrazo derecho,este se conecta directamente al lóbulo frontal, con este aparato mejora su campo en detalles digitales, hackea y maneja datos de forma más fácil que otros.</li>
                        <li>Muñequera de codificación liver: Es un aparato que se pone en la muñeca y parte del antebrazo izquierdo,este se conecta directamente al lóbulo frontal, con este aparato mejora su campo en detalles sociales, la vida también se puede hackear, puedes conseguir información de los individuos o seres vivientes, datos más profundos de ellos que ha simple vista son difíciles de obtener.</li>
                      </ul>
                      <h4>Estilo del personaje</h4>
                      Los memorex son personas que llevan poco tiempo en esta generación, rondan la edad de entre 22 a 30 años, crecieron junto a la tecnología y son muy afines a esta. Su somatotipo normalmente es Ectomorfo (Delgado, débil, nivel de musculatura baja, pecho plano). Su color representativo es el amarillo.
                    </li>
                    <br><br>
                    <li>
                      <h3>Linguo</h3>
                      <div>
                        <img class="imagi" src="{{ $avatars[1]->img }}" alt="personajes">
                        <img class="imagi" src="{{ $avatars[5]->img }}" alt="personajes">
                      </div>
                      Especialistas en interacciones sociales, su enfoque es  el relacionamiento con las personas u otros seres vivientes, tiene un gran manejo de los lenguajes y de la empatía, eran los más efectivos para interactuar con humanos en la tierra.
                        <br><br>
                        <h4>Implante Principal</h4>
                        Los Linguo tienen un implante especial, un brazo robótico sensitive, este implante toma información de lo que toca, posee maquinaria que toma muestras de objetos, células y una pequeña muestra indolora e imperceptible de sangre, la procesa y obtienes la información del usuario, hábitos, que ha hecho últimamente y hasta estados de ánimo del usuario. Como dijo un profesor en la época del 2000 “En la sangre pueden detectar prácticamente todo lo que sucede en tu cuerpo - Guy Carpenter”.
                        <br><br>
                        <h4>Implantes Secundarios</h4>
                        <ul>
                          <li>Visor BioSensitive: Este visor captura y toma informacion corporal, se puede sacar mucha información solo con ver a alguien, este dispositivo mejora notoriamente tu campo social obteniendo información más enfocada al campo emocional sólo con observar detalladamente a los usuarios.</li>
                          <li>Auricular LT (oído derecho): Este es un dispositivo enfocado al entendimiento de jergas y lenguajes, tienes mayor facilidad para entender dialectos, el habla de los usuarios y sus expresiones. Este dispositivo va en el odio y a su vez se conecta al lóbulo temporal (sección lenguaje y audición).</li>
                          <li>Implante Idiom: Es un implante que se ubica cerca o prácticamente al lado del oído derecho junto al auricular, este dispositivo, mejora tu comprensión de los idiomas tanto los conocidos como en el entendimiento de lenguas nuevas. Este dispositivo se conecta al lobulo parietal (seccion lenguaje) y al Área de Wernicke (Parte del cerebro dedicada al entendimiento del lenguaje).</li>
                        </ul>
                        <h4>Estilo del personaje</h4>
                        Los linguo son personas que llevan un poco más de tiempo en esta generación, rondan la edad de entre 30 a 40 años, crecieron junto a la tecnología presente pero siguen su enfoque a lo social, interactuar con la sociedad y ser parte de la comunidad. Su somatotipo normalmente es Mesomorfo (Atlético, cuerpo firme y simétrico). Su color representativo es el violeta.
                    </li>
                    <br><br>
                    <li>
                      <h3>Maker</h3>
                      <div>
                        <img class="imagi" src="{{ $avatars[2]->img }}" alt="personajes">
                        <img class="imagi" src="{{ $avatars[6]->img }}" alt="personajes">
                      </div>
                      Hacia dónde este se dirige todos lo siguen. Tiene gran visión de saber que es lo que se debe hacer, que información recolectar, cómo liderar y trabajar en equipo, con quien adquirir nuevos conocimientos, tiene un gran compromiso para hacer que las cosas sucedan. Eran los cyborgs perfectos para sacar, liderar proyectos y sus personas.
                        <br><br>
                        <h4>Implante Principal</h4>
                        Los maker tienen un implante especial, un ojo cibernético ParametricTech, este ojo robótico captura la información de todo lo que ve, incluyendo información métrica, física y atmosférica, así se le facilita la toma de decisiones al momento de guiar un conjunto, llevar a cabo un proyecto establecido o crear un proyecto. Este dispositivo conecta directamente con el frontal (sección de pensamiento y concentración).
                        <br><br>
                        <h4>Implantes Secundarios</h4>
                        <ul>
                          <li>Implante Enginer: Es un dispositivo que va en la cabeza y se conecta al lóbulo occipital (visión y percepción) y frontal (sector de resolución de problemas), con ello el usuario tiene un mejor entendimiento de los problemas y facilita su deducción de soluciones viables y guiables.</li>
                          <li>Implante Muscular 3.0: Es un dispositivo que se pone en los brazos se conectan a los músculos del brazo y antebrazo, también tienen vínculo con el área motora del cerebro, con ello el usuario tiene una mejora en su fuerza (fuerza de 2 hombres) para estar mucho más presente en los desarrollos de los proyectos, como un líder, aquel que guía siendo parte de la manada.</li>
                          <li>Muñequera Holográfica: Es un aparato que se pone en la muñeca y parte del antebrazo, este se conecta directamente al lóbulo temporal (sección de lenguaje) y al área de Broca (control del habla), este es un elemento eficiente para convencer y mostrar más facilmente lo que quieres decir o crear, una forma de comunicación con hologramas, muy eficiente para manejar temas poco conocidos en el entorno social.</li>
                        </ul>
                        <h4>Estilo del personaje</h4>
                        Los linguo son personas que llevan un poco más de tiempo en esta generación, rondan la edad de entre 30 a 40 años, crecieron junto a la tecnología presente pero siguen su enfoque a lo social, interactuar con la sociedad y ser parte de la comunidad. Su somatotipo normalmente es Mesomorfo (Atlético, cuerpo firme y simétrico). Su color representativo es el violeta.
                    </li>
                    <br><br>
                    <li>
                      <h3>Sabius</h3>
                      <div>
                        <img class="imagi" src="{{ $avatars[3]->img }}" alt="personajes">
                        <img class="imagi" src="{{ $avatars[7]->img }}" alt="personajes">
                      </div>
                      Lo ha vivido todo y con su sabiduría aconseja, guia, cuestiona para bien lo que se debe hacer. Enseña a través del ejemplo, entiende el porqué de las cosas y no habla por hablar, fueron grandes consejeros en la tierra, aquellos que estaban más conectados al mundo como humanos que como máquinas, normalmente son personas mayores que se han negado a la muerte.
                        <br><br>
                        <h4>Implante Principal</h4>
                        Los sabius tienen un implante especial, un auricular ???, este se pone en la oreja y toma una pequeña parte de la cara, este dispositivo se conecta directamente al lóbulo temporal (sección de lenguaje y audición) y al área de Wernicke, con esto ellos tienen un alto nivel para comprender y escuchar a los usuarios, se les facilita entender sus problemas y responder con consejo gracias a su gran trayectoria de vida.
                        <br><br>
                        <h4>Implantes Secundarios</h4>
                        <ul>
                          <li>Implante Hearer: Es un implante que se pone en la cabeza, este se conecta directamente en el lobulo parietal (seccion lenguaje y atencion) y occipital (sección de percepción), este dispositivo mejora notoriamente la concentración del usuario, se vuelven grandes oyentes para entender los problemas, incluso pueden detectar emociones según la voz, así pueden ser mejores consejeros y detectar lo que no dicen pero si sienten. Más conexión a lo social y emocional.</li>
                          <li>Implante Muscular 1.0: Es un dispositivo que se pone en los brazos y piernas, se conectan a los músculos y tienen vínculo con el área motora del cerebro, con ello el usuario tiene una mejora en su fuerza (fuerza de una hombre estándar), la edad deteriora y un sabio sabe que la mejor forma de enseñar y aconsejar no es solo hablando sino también dando el ejemplo y siendo parte del movimiento.</li>
                          <li>Implante GB con respirador: Este implante se pone en el cuello, principalmente se conecta al Tronco del encéfalo, el dispositivo tiene datos informáticos que codifica la información y reconoce las soluciones buenas o malas en el enfoque de la conciencia, esto facilita a los sabius tener todas las opciones que puede sugerir, a veces el camino equivocado puede no serlo o viceversa. Adicionalmente el dispositivo mejora el ritmo cardíaco y también está conectado a los pulmones, mejora el sistema respiratorio y el dispositivo puede procesar y sacar oxígeno del aire y de los líquidos y envía el oxígeno directamente a los pulmones, esta es una función de emergencia que posee el dispositivo.</li>
                        </ul>
                        <h4>Estilo del personaje</h4>
                        Los maker son personas que llevan mucho tiempo de vida, esta generación y hasta la anterior, tienen más de 65 años, ha vivido lo que otros no y su experiencia de vida se nota, al verlos destaca su sabiduría, que son aquellos que te ayudan y saben aconsejar. Su somatotipo normalmente es Ectomorfo (Cuerpo de naturaleza frágil, un poco deteriorado). Sus colores representativos son el blanco y el dorado.
                    </li>
                  </ul>

                </span>
              </div>


            </div>

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
