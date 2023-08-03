@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{ url('/reportcompletos') }}"><i class="fa fa-dashboard"></i>Reporte</a></li>
    <li class="active">Porcentaje</li>
    </ol>
</section>
@endsection

@section('usuarios')

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
                          <form method="POST" action="{{route('valFormuPorcentaje')}}">
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
                                          @foreach($info as $g)
                                            <tr>
                                              <td> <input type="checkbox" id="check_{{$g->id}}" name="idfiltro[]" value="{{$g->id}}"></td>
                                              <td> <span>{{$g->descrip}}</span></td>
                                            </tr>
                                          @endforeach
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
                            <a href="/reporte/view/porcentaje" class="btn btn-primary float-right" type="submit">Deshacer</a>
                            <button class="btn btn-success float-right" type="submit">Filtrar</button>
                          </div>
                          </form>
                        </div>

                      </div>
                    </div>
                  <!--end modal-->
                
         <!---###################################################----->
        <div class="box-tools pull-right">
            <a href="/reportcompletos" class="btn btn-info">Volver</a>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <h1>PORCENTAJE DE AVANCE</h1>
                <div class="box-body table-responsive no-padding">
                    <!--================================================-->  
                     <!---ver si mejora o automatiza--->
                     <table class="table table-hover">
                          <thead>
                              <tr>
                                  <th class="text-center">Grupo</th>
                                  <th class="text-center">Capítulo</th>
                                  <th class="text-center">Total users</th>
                                  <th class="text-center">0%</th>
                                  <th class="text-center">Rango 1-15%</th>
                                  <th class="text-center">Rango 16-25%</th>
                                  <th class="text-center">Rango 26-50%</th>
                                  <th class="text-center">Rango 51-80%</th>
                                  <th class="text-center">Rango 81-100%</th>
                              </tr>
                          </thead>
                          <tbody>
                              @php
                                  $groupedData = [];
                                  foreach([$var1, $var2, $var3, $var4, $var5] as $data) {
                                      foreach ($data as $item) {
                                          $capitulo = $item['capitulo'];
                                          if (!isset($groupedData[$capitulo])) {
                                              $groupedData[$capitulo] = [
                                                  'capitulo' => $capitulo,
                                                  'rangos' => array_fill(1, 5, ['total' => 0]),
                                              ];
                                          }

                                          $groupedData[$capitulo]['rangos'][$item['ranid']] = [
                                              'total' => $item['total'],
                                          ];
                                      }
                                  }
                              @endphp

                              @foreach ($groupedData as $capituloData)
                                  <tr>
                                      <td class="text-center">Grupo</td>
                                      <td class="text-center">{{ $capituloData['capitulo'] }}</td>
                                      <td class="text-center">20</td>
                                      <td class="text-center">0</td>
                                      @for ($i = 1; $i <= 5; $i++)
                                          <td class="text-center">{{ $capituloData['rangos'][$i]['total'] }}</td>
                                      @endfor
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                    <!--===============================================-->
                </div>
                        
            </div>
            <!-- /.col -->                                
        </div>
    </div>
    <!-- /.box-body -->
</div>







@endsection