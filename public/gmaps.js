"use strict"

let hoteles=document.querySelector("#infoHoteles");
let info=hoteles.dataset.hotels;
console.log(info)
let array=JSON.parse(info);
console.log(array);

var map, marker, i;


function initMap() {
  const valencia = {
    lat: 39.4683179,
    lng: -0.3790023
  };
  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 13,
    center: valencia,
   
  });
  
  let image = {
    url: 'img/signo.png', //ruta de la imagen
    size: new google.maps.Size(60, 60), //tamaño de la imagen
    origin: new google.maps.Point(0,0), //origen de la iamgen
  //el ancla de la imagen, el punto donde esta marcando, en nuestro caso el centro inferior.
  anchor: new google.maps.Point(0, 0) 
   };

   for (i = 0; i < array.length; i++) {

      marker = new google.maps.Marker({
      position: new google.maps.LatLng(array[i]['ubicacion'].latitud, array[i]['ubicacion'].longitud),
      map:map,
      icon: image
    });

    var infowindow = new google.maps.InfoWindow({
      content:'<a href="#hola"><img style="margin:0px" src="img/tropical.png" width="250px" /><div style="w-100"><div class="p-4" style="width:250px"><h5 class="fw-light">Alojamiento entero: piso. Anfitrión: Paula</h5><span class=>250 €</span></span></div></a>' });
  google.maps.event.addListener(marker, 'click', (function() { 
  infowindow.open(map,marker); 
  }));
  
}


  };
  
  //agregamos los eventos para los botones
 /* const mostrar = document.getElementById("mostrar-marcardor")
  mostrar.addEventListener("click", mostrarMarcador);
  
  const ocultar = document.getElementById("ocultar-marcador")
  ocultar.addEventListener("click", ocultarMarcador);
  const eliminar = document.getElementById("eliminar-marcador")
  eliminar.addEventListener("click", borrarMarcador);
  // Añade un marcador al centro del mapa.*/




/*

// Establece el mapa en todos los marcadores del vector.
function setMapOnAll(map) {
  for (let i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

// Elimina los marcadores del mapa, pero los mantiene en el vector.
function ocultarMarcador() {
  setMapOnAll(null);
}

// Muestra los marcadores que se encuentran actualmente en el vector.
function mostrarMarcador() {
  setMapOnAll(map);
}

// Elimina todos los marcadores del vector eliminando las referencias a ellos.
function borrarMarcador() {
  ocultarMarcador();
  markers = [];
}*/