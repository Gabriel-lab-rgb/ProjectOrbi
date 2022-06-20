 /*variables*/
 
  


 let hotel=document.querySelector('#Hotel');
 let hostal=document.querySelector('#Hostal');
 let albergue=document.querySelector('#albergue');
 let casaRural=document.querySelector('#CasaRural');
 let todos=document.querySelector('#all');

 let hoteles=document.querySelector("#infoHoteles");
 let info=hoteles.dataset.hotels;
 var array=JSON.parse(info);
 console.log(array);


var cambio=new Array();
 


hotel.addEventListener('click',function(){
filtrar(array,hotel.id);

});
hostal.addEventListener('click',function(){
 filtrar(array,hostal.id);
 
 
})
albergue.addEventListener('click',function(){
 filtrar(array,albergue.id);
 
})
casaRural.addEventListener('click',function(){
filtrar(array,casaRural.id);

})

todos.addEventListener('click',function(){
sessionStorage.removeItem('Regionactividad'); 
mostrarAlojamientos(array);
mostrarTodos();


})


document.addEventListener("DOMContentLoaded",function(){


if(window.sessionStorage){
 if(!sessionStorage.getItem('Regionactividad')){

mostrarAlojamientos(array)
 }else{
let actividad=sessionStorage.getItem("Regionactividad");
 console.log(actividad)
 filtrar(array,actividad);

 }
}
 
});

function filtrar(array,actividad){

sessionStorage.setItem('Regionactividad',actividad)
cambio=array.filter((element) => {
return( element.actividad.nombre == actividad )});
if(cambio!=undefined && cambio.length >0){
mostrarAlojamientos(cambio);
filterMarkers(actividad);
}else{
mostrarMensaje();
}

}


function mostrarMensaje(){

 let div=document.getElementById('alojamiento');
 let hijo=document.getElementById('hijo');
 div.removeChild(hijo);


 let divhijo=document.createElement('div');
 divhijo.id="hijo";

let parrafo=document.createElement('p');
parrafo.textContent="No hay alojamientos disponibles"
divhijo.appendChild(parrafo);
div.appendChild(divhijo);
}


const iconos={

 icon1:`<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
 <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
</svg>`
}


function mostrarAlojamientos(array){




 let div=document.getElementById('alojamiento');
 let hijo=document.getElementById('hijo');
 div.removeChild(hijo);


 let divhijo=document.createElement('div');
 divhijo.id="hijo";
 divhijo.classList="row p-2";
 

 for(let i=0;i<array.length;i++){

let principal=document.createElement('div');
principal.classList="col-sm-6 mb-3";

let item=document.createElement('div');
item.classList="packege__item";
let inner=document.createElement('div');
inner.classList="packege__inner";


let thumb=document.createElement('div');
thumb.classList="packege__thumb";
let enlace=document.createElement('a');
enlace.href="/alojamiento/" + array[i]['Nombre'];
let imagen=document.createElement('img');
imagen.setAttribute('src','/img/alojamientos/'+ array[i]['images'][0]['imageName']);
enlace.appendChild(imagen)
thumb.appendChild(enlace);

let content=document.createElement('div');
content.classList="packege__content";
let aContent=document.createElement('a');
aContent.href="/alojamiento/" + array[i]['Nombre'];
let h5=document.createElement('h5');
h5.textContent=array[i]['Nombre'];
let rivew=document.createElement('div');
rivew.classList="packege__rivew";
let left=document.createElement('div')
left.classList="left";
let p1=document.createElement('p');
p1.classList="gx-2 m-0";
let span1=document.createElement('span')
span1.textContent=array[i]['ubicacion']['provincia'];
p1.innerHTML=iconos.icon1 +span1.textContent

let span2=document.createElement('span');
span2.textContent= array[i]['caracteristicas'] ;

let right=document.createElement('div');
right.classList="right";
let span3=document.createElement('span');
span3.textContent=array[i]['precio'] + '€ por noche';
left.appendChild(p1);
left.appendChild(span2)
right.appendChild(span3);
rivew.appendChild(left);
rivew.appendChild(right);
aContent.appendChild(h5);
content.appendChild(aContent)
content.appendChild(rivew)




inner.appendChild(thumb);
inner.appendChild(content)
item.appendChild(inner);
principal.appendChild(item);


   divhijo.appendChild(principal)
 }

div.appendChild(divhijo);

let result=document.getElementById('result');
result.textContent=cambio.length;
 }
 





var map,i;
var infowindow=[];
var markers=[];
var gmarkers=[];


function initMap() {
 let lat=parseFloat(array[0]['ubicacion']['region'].latitud);
 let lng=parseFloat(array[0]['ubicacion']['region'].longitud); 



 const region = {
   lat: lat,
   lng: lng
 };
 map = new google.maps.Map(document.getElementById("map2"), {
   zoom: 8,
   center: region,
  
 });




 
 let image = {
   url: '/img/signo.png', //ruta de la imagen
   size: new google.maps.Size(60, 60), //tamaño de la imagen
   origin: new google.maps.Point(0,0), //origen de la iamgen
 //el ancla de la imagen, el punto donde esta marcando, en nuestro caso el centro inferior.
 anchor: new google.maps.Point(0, 0) 
  };

  for (i = 0; i < array.length; i++) {

     markers[i] = new google.maps.Marker({
     position: new google.maps.LatLng(array[i]['ubicacion'].latitud, array[i]['ubicacion'].longitud),
     map:map,
     actividad:array[i]['actividad']['nombre'],
     icon: image
   });

gmarkers.push(markers[i])
   infowindow[i] = new google.maps.InfoWindow({
     content:'<a href="/alojamiento/' +  array[i]['Nombre'] + '"><img src="/img/alojamientos/'+ array[i]['images'][1]['imageName'] + '"  style=" margin:0px;" width="250px"><div style="w-100"><div class="p-3" style="width:250px"><h5 class="fw-light">' + array[i]['Nombre']+'</h5><p>'+ array[i]['caracteristicas']+'</p><span class="">'+array[i]['precio']+ '€' +'</span></div></div></a>' });
 google.maps.event.addListener(markers[i], 'click', function(valor) { 
   return function(){ 
   infowindow[valor].open(map,markers[valor]); 
 }
 }(i));
 
}


 };

function filterMarkers(actividad){
  console.log(gmarkers)
 for(let i=0;i<gmarkers.length;i++){
   marker=gmarkers[i];
      if(marker.actividad==actividad || actividad.length ===0){
          marker.setVisible();
     }else{
          marker.setVisible(false);
     }
 }
}

function mostrarTodos(){
let result=document.getElementById('result');
result.textContent=array.length;
 for(let i=0;i<gmarkers.length;i++){

gmarkers[i].setVisible();
 }
}



function moveLocation(lat,lng){
const center=new google.maps.LatLng(lat,lng);
window.map.panto(center);

}