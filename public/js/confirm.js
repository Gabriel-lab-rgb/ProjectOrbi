let fecha=new Date();
let anio=fecha.getFullYear();
let dia=fecha.getDate();
let _mes =fecha.getMonth();
_mes=_mes +1;

if(_mes < 10){
var mes= "0" + _mes;

}else{

  var mes= _mes.toString;
}

let fecha_minimo= anio + '-' + mes + '-' + dia;
let fechallegada=document.getElementById("reservas_form_llegada");
let fechaSalida=document.getElementById("reservas_form_salida");
let huespedes=document.getElementById("reservas_form_huespedes");
let days=document.getElementById("dias");

fechallegada.setAttribute('min',fecha_minimo);



fechallegada.addEventListener('change',function(){

document.getElementById("reservas_form_salida").setAttribute('min',fechallegada.value);
})
document.getElementById("reservas_form_salida").setAttribute('min',fechallegada.value);

  console.log(fechallegada);
fechallegada.addEventListener('blur',function(){

  let llegada=document.getElementById('llegada');
  console.log(llegada);
  llegada.textContent=fechallegada.value;
  cambiarDias(fechallegada.value,fechaSalida.value)
})

fechaSalida.addEventListener('blur',function(){

  let salida=document.getElementById('salida');
  console.log(llegada);
  salida.textContent=fechaSalida.value;
  cambiarDias(fechallegada.value,fechaSalida.value)
})

huespedes.addEventListener('blur',function(){

  let huesped=document.getElementById('huespedes');
  huesped.textContent=huespedes.value;
})
 /*let llegada=moment(fechaSalida.value);

 console.log(llegada);*/


function cambiarDias(fechallegada,fechaSalida){
  

var fecha_1 = new Date(fechallegada);
var fecha_2 = new Date(fechaSalida);

var day_as_milliseconds = 86400000;
var diff_in_millisenconds = fecha_2 - fecha_1;
var dias = diff_in_millisenconds / day_as_milliseconds;
let noches=document.getElementById("noches");
noches.textContent=dias;
days.textContent=dias;

cambiarPrecio(dias);

}

 function cambiarPrecio(dias){
console.log(dias)
let newPrice=0;
let base=document.getElementById("base");
let precio=document.getElementById("precio");
let total=document.getElementById("total");
newPrice=base.title*dias;

precio.textContent=newPrice;
precio.value=newPrice;
total.textContent=newPrice;
 
console.log(newPrice);

}