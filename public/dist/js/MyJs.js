var currentTab = 0; // Seteo de tab numero 1

$(document).ready(function() {

showTab(currentTab); // Mostrar el Tab actual

//Cambio de Personaje
$("#avatar_id").on("change",function () {
    //$('.imagenAvtr img'); //Cambiar Imagen
    console.log("Cambio!!");
    console.log($(this).val());
    $(".DescAvtr").html("<strong> {{ $avatar_id->description }} </strong>"); //Cambiar Descripcion
  })


});

function showTab(n) {
  // Mostrar tab especifico del registro
  var x = document.getElementsByClassName("tab");

  x[n].style.display = "block";
  // Fix de botones anterior y siguiente
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    $("input[name='send']").prop("type", "button");
    document.getElementById("nextBtn").innerHTML = "Registrarse";
  } else {
    document.getElementById("nextBtn").innerHTML = "Siguiente";
  }
  // indicador de pasos
  fixStepIndicator(n)
}

function nextPrev(n) {
    // Saber en que tab se esta actualmente
  var x = document.getElementsByClassName("tab");
  // Se sale de la funcion si algun campo es invaido
  if (currentTab == 1 && !validateForm(n)) return false;
  // Esconder tab actual
  x[currentTab].style.display = "none";
  // Aumetar o disminuir el tab actual en 1
  currentTab = currentTab + n;
  // Cuando se llega al final del formulario
  if (currentTab >= x.length) {
    //Envio de formulario
    document.getElementById("regForm").submit();
    return false;
  }
  // Mostrar la tab actual
  showTab(currentTab);
}

function validateForm(n) {
  // Validaciones de los campos
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // Loop que chequea cada campo del formulario
  for (i = 0; i < y.length; i++) {
    // Si hay campo vacio
    if (y[i].value == "") {
      // Agrega un "invalid" a la clase
      y[i].className += " invalid";
      // Setea el valor actual como invalido
      valid = false;
    }
  }
  // Si el estatus es valido, lo marca como "true" y lo pone como valido
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // retorna el valor valido
}

function fixStepIndicator(n) {
  // Borra la clase "active" del elemento actual
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  // Agrega la clase "active" al siguiente elemento
  x[n].className += " active";
}
