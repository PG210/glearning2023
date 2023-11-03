@extends('admingrupos.adminmenu')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ route('reportegeneral') }}"><i class="fa fa-dashboard"></i>Reporte</a></li>
    <li class="active">Porcentaje</li>
    </ol>
</section>
@endsection

@section('reporte')

<style>
  .scrollable-container {
      width: auto;
      height: 400px;
      border: 1px solid #ccc;
      overflow-y: scroll; /* Agregar scroll vertical */
    }
</style>

<div class="box box-default" style="margin-top: 5%;">
    <div class="box-header with-border">
          <!---####################################################---->
          
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#filtrarpor">Filtrar</button>
                    <!-- Modal -->
                    <div id="filtrarpor" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <!-- Contenido del modal -->
                        <div class="modal-content"  style="border-radius:20px;">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Filtrar Por Grupos</h4>
                          </div>
                          <form method="POST" action="{{route('AdminvalFormuPorcentaje')}}">
                          <div class="modal-body scrollable-container"  >
                            <!--filtro-->
                                  @csrf
                                  <div class="form-row">
                                    <div class="col-md-12">
                                    <!--seleccionar varios campos-->
                                    <!--end seleccionar campos-->
                                    <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                      <thead>
                                        <tr>
                                          <th>Elegir</th>
                                          <th>Nombre</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      @if(count($info) != 0)
                                      @foreach($info as $g)
                                          <tr>
                                              <td> 
                                                  <input type="radio" id="radio_{{$g->id}}" name="idfiltro" value="{{$g->id}}" required>
                                              </td>
                                              <td> 
                                                  <span>{{$g->descrip}}</span>
                                              </td>
                                          </tr>
                                      @endforeach
                                      @endif
                                        <!-- Agrega más filas según tus datos -->
                                      </tbody>
                                    </table>
                                  </div>
                                  <!--end table-->
                                    </div>
                                </div>
                            <!--end filtrar-->
                            <br>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                            <a href="{{route('porcentajeAdmin')}}" class="btn btn-primary float-right" type="submit">Deshacer</a>
                            @if(count($info) != 0)
                            <button class="btn btn-success float-right" type="submit">Filtrar</button>
                            @endif
                          </div>
                          </form>
                        </div>

                      </div>
                    </div>
                  <!--end modal-->
                
         <!---###################################################----->
        <div class="box-tools pull-right">
            <a href="{{route('reportegeneral')}}" class="btn btn-info">Volver</a>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
          @if(isset($nomgrupo))
            <div class="col-md-12">
                @if(isset($nomgrupo))
                <h1>PORCENTAJE DE AVANCE GRUPO: {{$nomgrupo->descrip}}</h1>
                @else
                <h1>PORCENTAJE DE AVANCE </h1>
                @endif
                <div class="box-body table-responsive no-padding">
                    <!--================================================-->  
                     <!---ver si mejora o automatiza--->
                     <table class="table table-hover">
                          <thead style="color:black; font-family:effortless;">
                              <tr>
                                  <th class="text-center">Capítulo</th>
                                  <th class="text-center">Total users</th>
                                  <th class="text-center">0%</th>
                                  <th class="text-center">Rango 1-15%</th>
                                  <th class="text-center">Rango 16-25%</th>
                                  <th class="text-center">Rango 26-50%</th>
                                  <th class="text-center">Rango 51-80%</th>
                                  <th class="text-center">Rango 81-99%</th>
                                  <th class="text-center">Rango 100%</th> <!--se agrego 28 - 08-2023-->
                                  <th class="text-center">Descripción</th>
                              </tr>
                          </thead>
                          <tbody style="background-color:#EFF4F1; color:black;">
                            @if(isset($var1) && isset($var2) && isset($var3) && isset($var4) && isset($var5) && isset($totPorCap) && isset($contar))
                              @php
                                  $groupedData = [];
                                  foreach([$var1, $var2, $var3, $var4, $var5, $var6] as $data) { /*Se agrego 28-08-2023 */
                                      foreach ($data as $item) {
                                          $capitulo = $item['capitulo'];
                                          if (!isset($groupedData[$capitulo])) {
                                              $groupedData[$capitulo] = [
                                                  'capitulo' => $capitulo,
                                                  'rangos' => array_fill(1, 6, ['total' => 0]), /*Se agrego 28-08-23 */
                                              ];
                                          }

                                          $groupedData[$capitulo]['rangos'][$item['ranid']] = [
                                              'total' => $item['total'],
                                          ];
                                      }
                                  }
                               /*Odenarde menor a mayor  */
                               usort($groupedData, function($a, $b) {
                                    return $a['capitulo'] - $b['capitulo'];
                                });
                               /* final orden */
                               //var_dump($groupedData);
                              @endphp
                            
                              @foreach ($groupedData as $capituloData)
                                  <tr>
                                      <td class="text-center">{{ $capituloData['capitulo'] }}</td>
                                      @foreach ($totPorCap as $item)
                                         @if($capituloData['capitulo'] == $item['capitulo'])
                                         <?php
                                            $percent = floor(($item['ceros']*100)/$contar);
                                           ?>
                                          <td class="text-center">{{$item['total']}}</td>
                                          <td class="text-center">{{$item['ceros']}} <br> {{$percent}}% </td> <!---Esta valida los ceros que no avanzaron-->
                                         @endif

                                      @endforeach
                        
                                      @for ($i = 1; $i <= 6; $i++) <!--se agrego 28-08-23-->
                                           <?php
                                           $por = round(($capituloData['rangos'][$i]['total'] * 100) / $contar, 0);
                                           ?>
                                          <td class="text-center">{{ $capituloData['rangos'][$i]['total'] }} <br> {{$por}}%</td>
                                      @endfor
                                      <!--manejo del modal-->
                                      <td class="text-center">
                                        <!-- Button to trigger the modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal{{ $capituloData['capitulo'] }}">Detalle</button>

                                        <!-- The Modal -->
                                        <div id="myModal{{ $capituloData['capitulo'] }}" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-lg">
                                                <!-- Modal content -->
                                                <div class="modal-content" style="border-radius:20px;">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Detalle del capítulo: {{ $capituloData['capitulo'] }}</h4>
                                                    </div>
                                                    <div class="modal-body scrollable-container">
                                                   <!--informacion de contenido-->
                                                   <div class="box-body table-responsive no-padding">
                                                        <!--================================================-->  
                                                        <!---ver si mejora o automatiza--->
                                                        <table class="table table-hover">
                                                              <thead style="color:black; font-family:effortless;">
                                                                  <tr>
                                                                      <th class="text-center">0%</th>
                                                                      <th class="text-center">Rango 1-15%</th>
                                                                      <th class="text-center">Rango 16-25%</th>
                                                                      <th class="text-center">Rango 26-50%</th>
                                                                      <th class="text-center">Rango 51-80%</th>
                                                                      <th class="text-center">Rango 81-99%</th>
                                                                      <th class="text-center">Rango 100%</th> <!-- agregado 28/08/2023-->
                                                                  </tr>
                                                              </thead>
                                                              <tbody style="background-color:#EFF4F1; color:black;">
                                                              <td class="text-left">
                                                               <!--aqui se puede imprimir los ceros-->
                                                               @php
                                                                  $varCorreos = [];
                                                               @endphp
                                                               @foreach($datacompleta as $dt)
                                                                 @if($capituloData['capitulo'] == $dt['capitulo'])
                                                                  @php
                                                                 
                                                                  $varCorreos[] = [
                                                                                      'email' => $dt['email'],
                                                                                      'nom' => $dt['nom'],
                                                                                      'rango' => "7",
                                                                                      'cap' => $dt['capitulo']
                                                                                  ];
                                                                   
                                                                  @endphp
                                                                  <p> {{$dt['nom']}} {{$dt['ape']}}</p> 
                                                                @endif
                                                               @endforeach
                                                               @if(!empty($varCorreos))
                                                                    @php
                                                                     // var_dump($varCorreos);
                                                                      $varCorreo = $varCorreos;
                                                                      $rango = "1";
                                                                    @endphp
                                                                    <p style="font-size:16px;">
                                                                    <button class="btn" id="boton{{ $capituloData['capitulo'] }}"  onclick='enviarCorreos(<?= json_encode($varCorreo) ?>, "<?= $rango ?>")'><i class="fa fa-envelope text-success"></i>&nbsp; Enviar</button>
                                                                  </p>
                                                                @endif
                                                               <!--end ceros-->
                                                              </td>
                                                              @php
                                                               $corr = [];
                                                              @endphp
                                                              @for ($i = 1; $i <= 6; $i++)
                                                                  <td class="text-left">
                                                                  @foreach($reporusu as $r)
                                                                  @if($i == $r['rango'] && $capituloData['capitulo'] == $r['capitulo']) 
                                                                  @php
                            
                                                                   $corr[$i] = [
                                                                                      'email' => $r['correo'],
                                                                                      'nom' => $r['nombre'],
                                                                                      'rango' => $r['rango'],
                                                                                      'cap' => $r['capitulo']

                                                                                  ];
                                                                    
                                                                  @endphp
                                                                    <p> {{$r['nombre']}} {{$r['apellido']}} </p> 
                                                                    <!--end modal =================================== -->
                                                                  @endif
                                                                @endforeach
                                                                @if(isset($corr[$i]))
                                                                @php
                                                                  $varCorreo1 = [$corr[$i]];
                                                                  //var_dump($varCorreo1);
                                                                  $rango1 = "1";
                                                                @endphp
                                                                  <p style="font-size:16px;">
                                                                  <button class="btn" id="boton{{ $capituloData['capitulo'] }}"  onclick='enviarCorreos(<?= json_encode($varCorreo1) ?>, "<?= $rango1 ?>")'><i class="fa fa-envelope text-success"></i>&nbsp; Enviar</button>
                                                                </p>
                                                                @endif
                                                                  </td>
                                                              @endfor
                                                              <!--===================================---->
                                                              </tbody>
                                                            
                                                           
                                                          </table>
                                                        <!--===============================================-->
                                                       
                                                        <!---==============================================-->
                                                    </div>
                                                   <!--en contenido--->
                                                  </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      </td>
                                      <!---end modal-->
                                  </tr>
                              @endforeach
                              @endif
                          </tbody>
                      </table>
                    <!--===============================================-->
                </div>
                        
            </div>
            <!-- /.col -->   
          @endif                             
        </div>
    </div>
    <!-- /.box-body -->
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function enviarCorreos(correos, rango) {
         console.log(correos);
        axios.post('/admin/enviar-correos/'+ rango, { correos: correos })
            .then(function(response) { 
                toastr.success('Correos enviados correctamente', 'Acción completada!', {timeOut:3000});
            })
            .catch(function(error) {
                toastr.error('Error al enviar correos', 'Lo sentimos!', {timeOut:3000});
             
            });
    }
</script>

@endsection
