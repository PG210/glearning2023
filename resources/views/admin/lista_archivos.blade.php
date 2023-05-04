
<!DOCTYPE html>
<html>
<head>
<style>
.button {
  display: inline-block;
  padding: 15px 25px;
  font-size: 12px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: black;
  background-color: #9ED9E2;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
  text-decoration: none;
}
.button2{
  display: inline-block;
  padding: 15px 25px;
  font-size: 12px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: black;
  background-color: #EC4857;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
  text-decoration: none;
}

.button:hover {background-color: #1ED5F4;text-decoration: none;}

.button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
  text-decoration: none;
}
.button2:hover {background-color: #1ED5F4;text-decoration: none;}

.button2:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
  text-decoration: none;
}
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<br>

@if (Session::get('mensaje'))
<div class="alert alert-success alert-block" id="men">
    <button type="button" class="cerrarse" id="cerrarse" name="cerrarse" data-dismiss="alert">×</button>
    <strong>{{Session('mensaje')}}</strong>
</div>
@endif
<!------------------------------------------------------------------------->
<!------------------------------------------------------------------------->
<br>
<!------>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">No</th>
      <th scope="col">Archivo</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Cargar Usuarios</th>
    </tr>
  </thead>
  <tbody>
  <?php
   $conta=1;
  ?>
  @foreach($listado as $p)
    <tr>
      <th scope="row">{{$conta++}}</th>
      <td>{{$p->ruta}}</td>
      <td>{{$p->descripcion}}</td>
      <td><a href="{{route('carga_usu', $p->ruta)}}" class="button">Guardar</a>
          <a href="{{route('eliminar_arch', $p->id)}}" class="button2">Eliminar</a>
      </td>
    </tr>
    @endforeach
    <tr>
      <th scope="row"><a href="{{url('/usuario')}}" class="btn btn-primary" type="button"><span>Volver</span></a>
    </th>
        <td></td>
        <td></td>
      <td></td>
    
    </tr>
  </tbody>
</table>
<!----->


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
</body>
</html>
<script>
 
const boton = document.querySelector("#cerrarse");
// Agregar listener
boton.addEventListener("click", function(evento){
	// Aquí todo el código que se ejecuta cuando se da click al botón
  location.reload();;
});
</script>