let nombre=document.querySelector('#profile_form_Persona_nombre');
let apellidos=document.querySelector('#profile_form_Persona_apellidos');
let telefono=document.querySelector('#profile_form_Persona_telefono');
let FechaNacimiento=document.querySelector('#profile_form_Persona_FechaNacimiento');
let codPostal=document.querySelector('#profile_form_Persona_dni');
let boton=document.querySelector('#btnGuardar');

nombre.addEventListener('input',function(){
    let name=document.getElementById('profile_form_Persona_nombre');
    let surnames=document.getElementById('profile_form_Persona_apellidos');
    let phone=document.getElementById('profile_form_Persona_telefono');
    let date=  document.getElementById('profile_form_Persona_FechaNacimiento');
    let CodigoPostal=document.getElementById('profile_form_Persona_dni');
    if(name.value !=nombre.value ||  surnames.value!=apellidos.value 
    ||phone.value !=telefono.value || date.value != FechaNacimiento.value || CodigoPostal.value != codPostal.value){

      boton.disabled = true;

    }else{
      boton.disabled = false;

    }
})

apellidos.addEventListener('input',function(){
    let name=document.getElementById('profile_form_Persona_nombre');
    let surnames=document.getElementById('profile_form_Persona_apellidos');
    let phone=document.getElementById('profile_form_Persona_telefono');
    let date=  document.getElementById('profile_form_Persona_FechaNacimiento');
    let CodigoPostal=document.getElementById('profile_form_Persona_dni');
    if(name.value !=nombre.value ||  surnames.value!=apellidos.value 
    ||phone.value !=telefono.value || date.value != FechaNacimiento.value || CodigoPostal.value != codPostal.value){

      boton.disabled = true;

    }else{
     boton.disabled = false;

    }
})


telefono.addEventListener('input',function(){
    let name=document.getElementById('profile_form_Persona_nombre');
    let surnames=document.getElementById('profile_form_Persona_apellidos');
    let phone=document.getElementById('profile_form_Persona_telefono');
    let date=  document.getElementById('profile_form_Persona_FechaNacimiento');
    let CodigoPostal=document.getElementById('profile_form_Persona_dni');
    if(name.value !=nombre.value ||  surnames.value!=apellidos.value 
    ||phone.value !=telefono.value || date.value != FechaNacimiento.value || CodigoPostal.value != codPostal.value){

      boton.disabled = true;

    }else{
     boton.disabled = false;

    }
})

FechaNacimiento.addEventListener('input',function(){
    let name=document.getElementById('profile_form_Persona_nombre');
    let surnames=document.getElementById('profile_form_Persona_apellidos');
    let phone=document.getElementById('profile_form_Persona_telefono');
    let date=  document.getElementById('profile_form_Persona_FechaNacimiento');
    let CodigoPostal=document.getElementById('profile_form_Persona_dni');
    if(name.value !=nombre.value ||  surnames.value!=apellidos.value 
    ||phone.value !=telefono.value || date.value != FechaNacimiento.value || CodigoPostal.value != codPostal.value){

      boton.disabled = true;

    }else{
      boton.disabled = false;

    }
})

codPostal.addEventListener('input',function(){
    let name=document.getElementById('profile_form_Persona_nombre');
    let surnames=document.getElementById('profile_form_Persona_apellidos');
    let phone=document.getElementById('profile_form_Persona_telefono');
   let date=  document.getElementById('profile_form_Persona_FechaNacimiento');
   let CodigoPostal=document.getElementById('profile_form_Persona_dni');
    if(name.value !=nombre.value ||  surnames.value!=apellidos.value 
    ||phone.value !=telefono.value || date.value != FechaNacimiento.value || CodigoPostal.value != codPostal.value){

      boton.disabled = true;

    }else{
      boton.disabled = false;

    }
})
