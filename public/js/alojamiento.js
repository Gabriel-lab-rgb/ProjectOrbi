

var array=new Array();
var hoteles=document.querySelector("#infoHoteles");
  var info=hoteles.dataset.hotels;
  array=JSON.parse(info);
  hoteles.remove();
 


function initMap() {
   let lat=parseFloat(array['ubicacion'].latitud);
   let lng=parseFloat(array['ubicacion'].longitud); 
  const orbiTravel = {
    lat: lat,
    lng: lng
  };
  map = new google.maps.Map(document.getElementById("map3"), {
    zoom: 17,
    center: orbiTravel,
   
  });

  new google.maps.Circle({
    
    map,
    strokeColor:'#0b5345',
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: '#0b5345',
    fillOpacity: 0.35,
    center: orbiTravel,
    radius:50
  });
}

var fecha=new Date();
var anio=fecha.getFullYear();
var dia=fecha.getDate();
var _mes =fecha.getMonth();
_mes=_mes +1;

if(_mes < 10){
var mes= "0" + _mes;

}else{

  var mes= _mes.toString;
}

let fecha_minimo= anio + '-' + mes + '-' + dia;
fechallegada=document.getElementById("reservas_form_llegada");
fechallegada.setAttribute('min',fecha_minimo);
fechallegada.addEventListener('change',function(){

document.getElementById("reservas_form_salida").setAttribute('min',fechallegada.value);
})
document.getElementById("reservas_form_salida").setAttribute('min',fechallegada.value);


  