<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Insignia</title>
  <!-- Aquí puedes agregar enlaces a tus archivos CSS y scripts JS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <!--<script src="{{asset('dist/js/estilo.js')}}"></script>-->
</head>
<body>
<div style="background-color:#1ED5F4;">
    <div class="container text-end" style="padding-top:5px; padding-bottom:5px;">
       <div class="container">
        <button class="btn btn-success" id="btnDownload" > <i class="bi bi-download"></i>&nbsp;Descargar</button>
      </div>
    </div>
</div>
<!--<button onclick="descargarPDF()">Descargar en PDF</button>-->
<br>
<div id="elementToCapture">
 <div class="container d-none d-lg-block" style="background-image: url('/dist/img/fondo2.png'); background-size: cover; background-position: center;  background-size: contain; background-size: 80% auto; background-repeat: no-repeat; padding-top:0px;">
 <br>
    <div class="container">
        <div class="row">
          <div class="col-8">
          </div>
          <div class="col-4">
            <br><br>
                <img src="/insigcap/{{$info[0]->imagen}}"  alt="Descripción de la imagen" style="width: 120px; height: auto; border-radius:80px;">
          </div>
        </div>
        <div class="row"> 
         <div class="col-12">
            <h3 class="text-center"><span style="color:blue; font-size:26px;"><b>Certifica que:</b></span> </h3>
            <br>
         </div>
        </div>
    </div>
     <div class="container">
      <h3 class="text-center">{{$info[0]->usuname}} {{$info[0]->usuape}}</h3>
      <h4 class="text-center">C.C {{$info[0]->cedula}}</h4>
      <br>
    </div>
    <div class="container">
        <div class="row">
        <div class="col-2">
        </div>
        <div class="col-8">
            <p> <h3 class="text-center"><span style="color:blue; font-size:26px; ">
               <b>Aprobó el programa:</b></span>
                @if(strlen($info[0]->name) > 25)
                   {{$info[0]->name}}
                 @else
                   {{$info[0]->name}}
                   <br>
                   <br>
                @endif
            </h3></p>
        </div>
        <div class="col-2">
        </div>
      </div>
    </div>
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-3">
            </div>
            <div class="col-5">
             <h3 ><span style="color:white; font-size:26px; "><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Intensidad horaria: {{$info[0]->horas}}</b></span> </h3>
            </div>
            <div class="col-4">
            </div>
      </div>
     </div>
        <br><br><br><br>
    <div class="container">
      <br>
      <br>
    </div>
  </div>
</div>
<?php
 $f = $info[0]->created_at;
 $fecha = substr($f, 0, 10);
?>
  <!--#################################################################--->
       <!--visualizar en pantallas pequenias-->
  <div class="d-block d-sm-none" style="background-image: url('/dist/img/fondo2.png'); background-size: cover; background-position: center;  background-size: contain; background-size: 100% auto; background-repeat: no-repeat; padding-top:0px;">
    <br>
     <div class="text-start"  style="position: relative;  z-index: 1;">
        <img src="/insigcap/{{$info[0]->imagen}}"  class="img-thumbnail" alt="Descripción de la imagen" style="width: 50px; height: auto; border-radius:100px; padding-top:0px;">
    </div>
    <br>
     <div class="container" style="position: relative;  z-index: 2;">
      <div class="row"> 
         <div class="col-12">
            <h6 class="text-center"><span style="color:blue; "><b>Certifica que:</b></span> </h6>
         </div>
        </div>
      <h6 class="text-center">{{$info[0]->usuname}} {{$info[0]->usuape}}</h6>
      <h6 class="text-center">C.C {{$info[0]->cedula}}</h6>
    </div>
    <div class="container" style="position: relative;  z-index: 2;">
        <div class="row">
        <div class="col-2">
        </div>
        <div class="col-8">
            <p> <h6 class="text-center"><span style="color:blue;">
               <b>Aprobó el programa:</b></span>
                @if(strlen($info[0]->name) > 25)
                   {{$info[0]->name}}
                 @else
                   {{$info[0]->name}}
                @endif
            </h6></p>
        </div>
        <div class="col-2">
        </div>
      </div>
    </div>
    <div class="container" style="position: relative;  z-index: 2;">
        <div class="row">
            <div class="col-12">
             <h6 class="text-center"><span style="color:white;"><b>Intensidad horaria: {{$info[0]->horas}}</b></span> </h6>
            </div>
      </div>
     </div>
     <br>
    <div class="container" style="position: relative;  z-index: 2;">
    <br>
    <br>
    </div>
  </div>
  <h5 class="text-center" style="margin-top:8px;">Fecha emisión:  {{$fecha}}</h5>
  <!--eend visualiar en pantallas pequenias-->
  <!--################################################################-->
  <!--contenedor para compartir-->
    <div class="container">
        <div class="row">
            <div class="col-2"></div> 
            <div class="col-8 text-center">
            <!--describir insignia-->
            <button class="btn btn-warning  ms-2"  style="margin-top:10px;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Descripción Insignia
            </button>
            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                  {{$info[0]->description}}
                </div>
            </div>
            @auth
            <!--end describir inignia-->
           <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#comu{{$info[0]->id}}">
                Compartir en perfil <i class="bi bi-linkedin"></i>
            </button>-->
           <!-- <a  class="btn btn-primary" href="https://www.linkedin.com/sharing/share-offsite/?url=http://127.0.0.1:8000/ver/insignia/{{$info[0]->id}}" target="_blank">
                 Compartir en historia <i class="bi bi-linkedin"></i>
             </a>-->
             <!--boton-->
             <?php
                $fec = $info[0]->created_at;
                $anio = date("Y", strtotime($fec));
                $mes = date("m", strtotime($fec));
              ?>
             <a class="btn btn-primary ms-2" style="margin-top:10px;"  href="https://www.linkedin.com/profile/add?startTask=CERTIFICATION_NAME&name={{$info[0]->name}}&organizationId=35549462&issueYear=2023&issueMonth={{$mes}}&certUrl=https://glearning.com.co/ver/insignia/{{$info[0]->id}}&certId={{$info[0]->id}} ">
               Compartir en perfil <i class="bi bi-linkedin"></i>
             </a>
                          <!--end boton-->
             @endauth
              <!-- Modal -->
                <div class="modal" id="comu{{$info[0]->id}}">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content" style="border-radius:20px;">
                        <div class="modal-header">
                        <h5 class="modal-title">Compartir insignia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="text-align:left;">
                            <p>
                                Por favor, introduce la URL de tu perfil de LinkedIn en el campo correspondiente para poder agregar una insignia a tu perfil.
                            </p>
                            <p>
                                La URL debe seguir el siguiente formato: <b><br>https://www.linkedin.com/in/tu-nombre-de-perfil/</b></p>
                            <p>Para obtener esta URL, ve a LinkedIn, haz clic en ver perfil, copia la URL y pégala en el campo indicado.</p> 
                            <!--aqui debe ir-->
                             <!--colapsed-->
                             <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                              Información de insignia
                            </button>
                            
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                   <p>Nombre: {{($info[0]->name) }}</p> 
                                    <p>Empresa emisora: Evolución / Aprendizaje Divertido</p> 
                                    <p>Fecha expedición: {{$info[0]->created_at}}</p> 
                                    <p>Fecha caducidad: Indefinido</p> 
                                    <p>ID credencial: </p> 
                                    <p>Url de la credencial: </p>
                                </div>
                            </div>
                            <br><br>
                            <!--end colapsed-->
                            <label for="usuario">Url de LinkedIn:</label>
                            <input type="text" name="urlval"  id="urlval"  class="form-control" onInput="validarInput()" />
                            <br>
                        </div>
                       
                        <div class="modal-footer">
                          <button type="button" class="btn btn-warning"  data-bs-dismiss="modal" id="btncerrar">Cerrar</button>
                          <button onclick="compartirLinkedIn()" name="add_to_cart" id="btnCompartir" class="btn btn-info" style="display: none;">Compartir</button>
                        </div>
                    </div>
                    </div>
                </div>
                <!--end modal-->
                </div> 
            <div class="col-2"></div> 
        </div>
    </div>
    <br>
  <!--end compartir-->
  <!--#################################################################################--->
  <footer class="d-none d-lg-block">
  <div style="background-color:#1ED5F4;">
    <div class="container text-center">
       <br><p style="font-size:20px;">&copy; 2023 Evolución SAS. Todos los derechos reservados.</p>
       <br>
    </div>
    </div>
  </footer>
  <footer class="footer fixed-bottom d-block d-sm-none">
  <div style="background-color:#1ED5F4;">
    <div class="container text-center">
       <br><p style="font-size:18px;">&copy; 2023 Evolución SAS. Todos los derechos reservados.</p>
       <br>
    </div>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script>
    function validarInput() {
      var btnCompartir = document.getElementById("btnCompartir");
      var btncerrar = document.getElementById("btncerrar");
      var usuarioInput = document.getElementById("urlval");

      if (!usuarioInput.value.length) {
        btnCompartir.style.display = "none";
      } else if (usuarioInput.value.includes("https://www.linkedin.com/in/")) {
        //compartirLinkedIn();
        btncerrar.style.display = "none";
        btnCompartir.style.display = "block";

      } else {
        console.log('La URL no es válida');
      }
    }
    function compartirLinkedIn() {
        var usuarioInput = document.getElementById("urlval");
        var usuario = usuarioInput.value;
        var url = usuario + "edit/forms/certification/new/?profileFormEntryPoint=PROFILE_COMPLETION_HUB";
        window.open(url, "_blank");
      }
  </script>
  <!--aqui gener pdf-->
  <script>
        document.getElementById('btnDownload').addEventListener('click', function() {
            const elementToCapture = document.getElementById('elementToCapture');

            html2canvas(elementToCapture).then(function(canvas) {
                const imgData = canvas.toDataURL('image/png');

                const img = new Image();
                img.src = imgData;

                /*const pdf = new jsPDF();
                pdf.addImage(img, 'PNG', 15, 15, 180, 0);
                pdf.save('midiploma.pdf');*/

                const link = document.createElement('a');
                link.href = imgData;
                link.download = 'midiploma.png';
                link.click();
            });
        });
    </script>
</body>
</html>
