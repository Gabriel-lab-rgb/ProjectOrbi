window.addEventListener('load',function(){
 
    let icono=document.querySelector('.loader-page');
 
    setTimeout(function(){ icono.style.visibility="hidden";icono.style.opacity="0" }, 1000);
})

var alojamientos=new Array();

var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
 try {
                let filas = JSON.parse(this.responseText);

                for(let i=0;i<filas.length;i++){
                alojamientos.push(filas[i].Nombre);

                }
               console.log(alojamientos);
              
               
            } catch (ex) {
               
               console.log( "no hay nada")
               
            }
        }
    };
    xhttp.open("GET",'/responseExplore' , true);
    xhttp.send();


    const buscador = document.querySelector('#search')
    const sugerencias = document.querySelector('#sugerencias')
    const boton=document.querySelector('#buscar');

   
    boton.addEventListener("click",function(){

        for (let i = 0; i < alojamientos.length; i++) {
        if(buscador.value=="" || buscador.value !=alojamientos[i]){

        buscador.style.border ="2px solid red";
        }else{
            window.location.href = "/alojamiento/"+ buscador.value;

        }
    }
        
    })
    buscador.addEventListener('input', e => {
        //constante query
        const q = e.target.value.toUpperCase().trim();
        //si no escribimos nada no muestra nada
        if (q == '') mostrarSugerencias([], q);
        //en una variable guardamos un filtrado del objeto db. Si lo que escribimos coincide con algo del db 
        //devuelve el item, que es un array de caracteres
        //la coincidencia se hace con if. si 'q' coincide con item, sus indices coincidiran y seran >-1
        const res = alojamientos.filter(item => {
            if (item.indexOf(q) > -1) return item;
        });
        console.log(q);
        console.log(res);
        //muestra sugerencia
        mostrarSugerencias(res, q);
    
    });
    
    //le pasamos los valores que son las sugerencias y la query como tal
    function mostrarSugerencias(valores, q) {
        //borra contenido previo
        sugerencias.innerHTML = '';
        //valida, si no existe q, no se muestra sugerencia, de lo contrario, si
        if (q == '') {
            sugerencias.style.display = 'none';
            return false;
        } else {
            sugerencias.style.display = 'block';
        }
        //itera entre los elementos del objeto db para mostrar todos los que vayan 
        //coincidiendo y crear el elemento html con su formato
        valores.forEach(valor => {
            const elemento = document.createElement('a');
            elemento.href = '#';
            let texto = valor.replace(q, `<strong>${q}</strong>`);
            elemento.innerHTML = texto;
            sugerencias.appendChild(elemento);
    
            elemento.addEventListener('click', e => {
                buscador.value = e.target.textContent;
                sugerencias.innerHTML = '';
                sugerencias.style.display = 'block';
    
            });
        });
    }
  
/*
    function buscar() {


        var pal = campo.value;
        var tam = pal.length;
    let elementosLista = sugerencias.querySelectorAll("li");
    if (elementosLista!=null && elementosLista!=undefined){
        elementosLista.forEach(elemento=>{
            lista.removeChild(elemento);
        })
    }
        for (let i = 0; i < alojamientos.length; i++) {
            var alojamiento = alojamientos[i];
            var str = alojamiento.substring(0, tam);
            if (pal.length <= alojamiento.length && pal.length != 0 && alojamiento.length != 0) {
                if (pal.toLowerCase() == str.toLowerCase()) {
                    
                    let enlace = document.createElement('a')
                    enlace.href = `/alojamiento/${alojamientos[i]}`
                    var textnode = document.createTextNode(alojamientos[i]);
                    enlace.appendChild(textnode);
                    sugerencias.appendChild(enlace);
                }
            }
        }
    
    }*/