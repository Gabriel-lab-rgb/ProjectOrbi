

var map, marker, i;
var asunto = document.querySelector('#contacto_form_asunto');
var mensaje = document.querySelector('#contacto_form_mensaje');
var AsuntoCorrecto = false;
var MensajeCorrecto = false;


function verificarAsunto(asunto){

  let re = new RegExp("[A-Za-z0-9]{10,50}");

if(!re.test(asunto)){

   AsuntoCorrecto = false;
   mensajeError("El asunto debe tener entre 10 y 50 caracteres", "asunto")
}else{

   AsuntoCorrecto = true;
}

}

function verificarMensaje(mensaje){

  let re = new RegExp("^[A-Za-z0-9]{0,250}$");

  if(!re.test(mensaje)){
     MensajeCorrecto = false;
     mensajeError("El mensaje debe tener como máximo 250 caracteres", "mensaje")
  }else{
     MensajeCorrecto = true;
  }
}

function verificarFormulario() {
  verificarAsunto(asunto.value);
  verificarMensaje(mensaje.value);
  if (AsuntoCorrecto  == true &&  MensajeCorrecto == true) {
      return true;
  } else {
      return false;
  }
}


function mensajeError(mensaje, divId) {
  let div = document.getElementById(divId);
  if(document.getElementById('parrafo')){

   let p=document.getElementById('parrafo');
   p.remove();

  }
  let parrafo = document.createElement('p');
  parrafo.id="parrafo";
  parrafo.textContent = mensaje;
  parrafo.style.color = "red";
  div.appendChild(parrafo);
  setTimeout(() => {
    parrafo.remove();
}, 5000);
}

if(document.getElementById('alert')){
  let alert =document.getElementById('alert');
  setTimeout(() => {
    alert.remove();
}, 5000);
}




function initMap() {
  const orbiTravel = {
    lat: 37.3819684,
    lng: -5.9950962
  };
  map = new google.maps.Map(document.getElementById("map-contact"), {
    zoom: 17,
    center: orbiTravel,
   
  });

  new google.maps.Marker({
    position: orbiTravel,
    map,
    title: "!Estamos Aqui!",
  });
}

