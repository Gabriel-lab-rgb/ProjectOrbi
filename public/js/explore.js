/*variables*/
let hotel=document.querySelector('#Hotel');
let hostal=document.querySelector('#Hostal');
let albergue=document.querySelector('#albergue');
let casaRural=document.querySelector('#CasaRural');
let todos=document.querySelector('#all');



var array=new Array();
var cambio=new Array();

var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
try {
              let filas = JSON.parse(this.responseText);
              array=filas
            
             
          } catch (ex) {
             
             console.log( "no hay nada")
             
          }
      }
  };
  xhttp.open("GET",'/responseExplore' , true);
  xhttp.send();


hotel.addEventListener('click',function(){

filtrar(array,hotel.id);
sessionStorage.setItem('actividad',hotel.id);
});
hostal.addEventListener('click',function(){
filtrar(array,hostal.id);
sessionStorage.setItem('actividad',hostal.id);
})
albergue.addEventListener('click',function(){
filtrar(array,albergue.id);

})
casaRural.addEventListener('click',function(){
filtrar(array,casaRural.id);

})

todos.addEventListener('click',function(){
sessionStorage.removeItem('actividad'); 
mostrarAlojamientos(array);

})


document.addEventListener("DOMContentLoaded",function(){

let vector=new Array();


var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
try {
              let filas = JSON.parse(this.responseText);
        
              vector=filas;

              if(window.sessionStorage){
if(!sessionStorage.getItem('actividad')){
mostrarAlojamientos(vector)
}else{
let actividad=sessionStorage.getItem("actividad");
filtrar(vector,actividad);

}
}
                    
          } catch (ex) {
             
             console.log( "no hay nada")
             
          }
      }
  };
  xhttp.open("GET",'/responseExplore' , true);
  xhttp.send()


})

function filtrar(array,actividad){

sessionStorage.setItem('actividad',actividad);
cambio=array.filter((element) => {
return( element.actividad.nombre == actividad )});
if(cambio!=undefined && cambio.length >0){
mostrarAlojamientos(cambio);

}else{
mostrarMensaje();
}

}


function mostrarMensaje(){

let div=document.getElementById('alojamiento');
let hijo=document.getElementById('hijo');
div.removeChild(hijo);


let divhijo=document.createElement('div');
divhijo.classList="row g-4 row-cols-xxl-5 row-cols-xl-4  row-cols-sm-2 row-cols-1 ";
divhijo.id="hijo";
divhijo.style="padding-bottom: 50px;";

let parrafo=document.createElement('p');
parrafo.textContent="No hay alojamientos disponibles"
divhijo.appendChild(parrafo);
div.appendChild(divhijo);
}


function mostrarAlojamientos(array){

let div=document.getElementById('alojamiento');
let hijo=document.getElementById('hijo');
div.removeChild(hijo);


let divhijo=document.createElement('div');
divhijo.classList="row g-4 row-cols-xxl-5 row-cols-xl-4  row-cols-sm-2 row-cols-1 ";
divhijo.id="hijo";
divhijo.style="padding-bottom: 50px;";

console.log(array);
for(let i=0;i<array.length;i++){

let principal=document.createElement('div');
principal.classList="col mb-3";

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
/*imagen.setAttribute('alt','https://www.vinccihoteles.com/blog/wp-content/uploads/2019/10/vincci-seleccion-la-plantacion-del-sur-tenerife-1024x683.jpg')*/
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
let span1=document.createElement('span');
span1.textContent=array[i]['ubicacion']['provincia'];
let span2=document.createElement('span');
span2.textContent=array[i]['caracteristicas'] ;
let right=document.createElement('div');
right.classList="right";
let span3=document.createElement('span');
span3.textContent=array[i]['precio'] + '€ por noche';
left.appendChild(span1);
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


}