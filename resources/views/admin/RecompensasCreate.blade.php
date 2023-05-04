@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>    
    <li><a href="{{ url('/reconocimientos') }}"><i class="fa fa-dashboard"></i> Reconocimientos</a></li>    
    <li class="active">Crear-Reconocimientos</li>
    </ol>
</section>
@endsection

@section('awardCreate')

<h2>AGREGAR NUEVA RECOMPENSA</h2>

@if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif


<div class="box box-default" style="margin-top: 5%;">
    <form method="POST" enctype="multipart/form-data" action="{{ route('reconocimientos.store') }}">
      @csrf
        <div class="box-header with-border">
            <div class="box-tools pull-right">
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="Nombre">
                    </div>
                    <!-- /.form-group -->                   
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="imagen">Imagen Recompensa</label>
                        <input type="file" class="form-control" name="imagen" id="imagen">
                      </div>
                    <!-- /.form-group -->                    
                </div>
                <!-- /.col -->                                
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="spoints">PUNTAJE S</label>
                        <input type="text" class="form-control" name="spoints" id="spoints" placeholder="spoints">
                    </div>
                    <!-- /.form-group -->
                   
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">                                            
                      <label for="ipoints">Puntaje I</label>
                      <input type="text" class="form-control" name="ipoints" id="ipoints" placeholder="ipoints">                    
                    </div>
                    <!-- /.form-group -->                    
                </div>
                <!-- /.col -->  
                <div class="col-md-4">
                    <div class="form-group">                         
                        <label for="gpoints">Puntaje G</label>
                        <input type="text" class="form-control" name="gpoints" id="gpoints" placeholder="gpoints">           
                    </div>
                    <!-- /.form-group -->                    
                </div>
                <!-- /.col -->                                
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="descripcion">Descripcion</label>
                        <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion">
                      </div>
                    <!-- /.form-group -->                   
                </div>
                <!-- /.col -->                              
            </div>
          <!--elegir avatar-->
          <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="descripcion">Avatar</label>
                        <select class="form-control" id="avatarid" name="avatarid">
                         @foreach($avatars as $a)
                          <option value="{{$a->id}}">{{$a->name}}</option>
                         @endforeach
                        </select>
                    </div>               
                </div>                       
            </div>
          <!--end avatar-->
            <div class="row">
                <div class="col-md-8" >
                    <div class="btn-group">
                        <button type="submit" class="btn btn-default">Guardar</button>
                    </div>
                    <div class="btn-group">
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </form>
</div>
@endsection
