
let boton=document.querySelector('#boton');


boton.addEventListener('click',myFunction);

function myFunction() {
    var x = document.getElementById("divH");
    if (x.className === "divHoteles") {
      x.className += " responsive";
    } else {
      x.className = "divHoteles";
    }
  }