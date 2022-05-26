/*!
    * Start Bootstrap - SB Admin v7.0.5 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2022 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

var map, marker, i;


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

