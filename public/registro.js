var username = document.querySelector('#registration_form_user_username');
var email = document.querySelector('#registration_form_user_email');
var contrasena = document.querySelector('#registration_form_user_plainPassword');
var dni = document.querySelector('#registration_form_persona_dni');
var nombre = document.querySelector('#registration_form_persona_nombre');
var apellidos = document.querySelector('#registration_form_persona_apellidos');
var telefono = document.querySelector('#registration_form_persona_telefono');
var fecha = document.querySelector('#registration_form_persona_FechaNacimiento');


var UsernameCorrecto = false;
var EmailCorrecto = false;
var contrasenaCorrecto = false;
var dniCorrecto = false;
var nombreCorrecto = false;
var apellidosCorrecto = false;
var telefonoCorrecto = false;
var fechaCorrecto = false;


function verificarFormulario() {
 verificarEmail(email.value);
 verificarUsername(username.value);
 verificarContrasena(contrasena.value);
 verificarNombre(nombre.value);
 verificarApellido(apellidos.value);
 /*verificarDni(dni.value);*/
 verificarFecha(fecha.value);
 verificarTelefono(telefono.value);

  if (UsernameCorrecto  === true &&  EmailCorrecto === true && contrasenaCorrecto === true && dniCorrecto === true && nombreCorrecto === true && apellidosCorrecto === true  && telefonoCorrecto === true && fechaCorrecto === true) {
      return false;
  } else {
      return false;
  }
}

function verificarEmail(email){

  let re = new RegExp("[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,5}");

  if(!re.test(email)){
     EmailCorrecto = false;
     mensajeError("Correo electronico no valido", "email")
  }else{
     EmailCorrecto = true;
  }
}


function verificarUsername(username){

  let re = new RegExp("^(?!.* $)[A-Za-z0-9]+$");

  if(!re.test(username)){
     UsernameCorrecto = false;
     mensajeError("Nombre de usuario no valido", "username")
  }else{
     UsernameCorrecto = true;
  }
}

function verificarContrasena(contrasena){

  let re = new RegExp("");

  if(!re.test(contrasena)){
     contrasenaCorrecto = false;
     console.log('error');
     mensajeError("La contraseña debe tener al entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula. Puede tener otros símbolos.", "contrasena")
  }else{
     contrasenaCorrecto = true;
  }
}

function verificarNombre(nombre){

  let re = new RegExp("^(?!.* $)[A-Z][a-z ]+$");

  if(!re.test(nombre)){
     nombreCorrecto = false;
     mensajeError("El nombre introducido no es valido", "nombre")
  }else{
     nombreCorrecto = true;
  }
}

function verificarApellido(apellidos){

  let re = new RegExp("^(?=.{3,36}$)[a-zñA-ZÑ](\s?[a-zñA-ZÑ])*$");

  if(!re.test(apellidos)){
     apellidosCorrecto = false;
     mensajeError("El apellido introducido no es valido", "apellidos")
  }else{
     apellidosCorrecto = true;
  }
}

function verificarDni(dni){

  var validChars = 'TRWAGMYFPDXBNJZSQVHLCKET';
  let re = new RegExp("/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i");

  if(!re.test(dni)){

     var letter = str.substr(-1);
     var charIndex = parseInt(re.substr(0, 8)) % 23;
     dniCorrecto = false;
     if (validChars.charAt(charIndex) === letter){

 dniCorrecto = true;
     }else{
  dniCorrecto = false;
  mensajeError("Dni no es valido", "dni");
     } 

  
}
}

function verificarFecha(fecha){

var hoy = new Date();
 var cumpleanos = new Date(fecha)
 var edad = hoy.getFullYear() - cumpleanos.getFullYear();
 var m = hoy.getMonth() - cumpleanos.getMonth();
  if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }
   
   if(edad >= 18){
     fechaCorrecto = true;
     }else{

fechaCorrecto = false;
 mensajeError("Debes ser mayor de 18 años", "fecha");
     }


}
 

function verificarTelefono(telefono){

  let re = new RegExp("^(\\+34|0034|34)?[6789]\\d{8}$");

  if(!re.test(telefono)){
     telefonoCorrecto = false;
     mensajeError("Telefono no es valido", "telefono")
  }else{
     telefonoCorrecto = true;
  }
}

 function mensajeError(mensaje, divId) {
  let div = document.getElementById(divId);
  /*if(document.getElementById('parrafo')){

   let p=document.getElementById('parrafo');
   p.remove();

  }*/
  let parrafo = document.createElement('p');
  parrafo.id="parrafo";
  parrafo.textContent = mensaje;
  parrafo.style.color = "red";
  div.appendChild(parrafo);
  setTimeout(() => {
    parrafo.remove();
}, 5000);

/*if(document.getElementById('alert')){
   let alert =document.getElementById('alert');
   setTimeout(() => {
     alert.remove();
 }, 5000);
}*/
}