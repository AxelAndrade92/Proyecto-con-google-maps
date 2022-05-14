<?php
session_start();//inicio la sesion
include 'serv.php';//incluyo archivo de la conexion
ob_start();//soluciona el manejo de las sesiones

if (isset($_SESSION['user']))//si se configuro la pagina con mi usuario anterior, me muestre la pagina {


{?>
<!DOCTYPE html>
<html>
  <head> 
    <meta charset="utf-8" viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <title>Sistema de Comando de Incidentes</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link href="css/estilos.css" rel="stylesheet" type="text/css">       
    <link href="css/botonesCSS1.css" rel="stylesheet" type="text/css">  
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCy3sBztwbAWJn4_PuBTwdG5S67K4aliLE" ></script>    
    
  </head>

  <body class="body" onload="initMap()">

<script> 
  if(navigator.onLine){
      alert('En Linea');
      }else {
      alert('Debe tener Conexion a Internet para el uso del Sistema de Comando de Incidente')
      }
</script>


  <div class="container">
      <div class="jumbotron">     
        <h1 id="h1" align="center">Sistema de Comando de Incidentes</h1>            
        <h3 id="h3" align="center">Segunda Compañia de Bomberos de San Bernardo</h3>
      </div>
  </div>
                                        
      <br>
      <br>
                                       
  <div class="left">

    <p><b>N° de Incidente : </p> <script>var f = new Date();
   
      //funcion javascript de mostrar la fecha y hora actual
      var f = new Date();
        document.write(f.getDate() + "-" + (f.getMonth() +1) + "-" + f.getFullYear() + "<br><br>" + f.getHours()+":"+f.getMinutes()+":"+f.getSeconds()+"<b>");
         
    </script>
    <form action="">
      <div id="results"></div>
      <p><b>Ingrese Ubicacion de Incidente :</p>     
      <input type="text" name="" id="" maxlength="100" size="35">
      <br>
      <p><b>Cantidad de Voluntarios :</p>   
      <input type="text" name="" id="" maxlength="3" size="10">
      <p><b>Cantidad de Voluntarios :</p>   
      <input type="text" name="" id="" maxlength="100" size="35">
      <br>
      <br>
    </form>
    <input type="button" class="button" id="go" value="Click M" onclick="Geo()">
   <a href="logout.php"><button>Salir</button></a>
   </div>


   <div class="right">
      <div id="map"></div>
      <input class="right" type="text" id="coords"/ id="map" disabled="true" > 
      <input class="right" type="text" id="coords2"/ id="map" disabled="true">
      <input class="right" type="text" id="coords3"/ id="map" disabled="true">
      <input class="right" type="text" id="coords4"/ id="map" disabled="true">
  </div>
    <script type="text/javascript">
    var marker,marker2;          //variable del marcador
    var coords = {}; 
    var map; 
    var direccion = "";
    //coordenadas obtenidas con la geolocalización

    //Funcion principal
    initMap = function () 
    {
        //usamos la API para geolocalizar el usuario
            navigator.geolocation.getCurrentPosition(
              function (position){
                coords =  {
                  lng: position.coords.longitude,
                  lat: position.coords.latitude

                };
                 
                setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa            
                
              },function(error){console.log(error);});
    } 
     
    function setMapa (coords){ 
    //Se crea una nueva instancia del objeto mapa
    var map = new google.maps.Map(document.getElementById('map'),
    {
      zoom: 18,
      center:new google.maps.LatLng(coords.lat,coords.lng),
      mapTypeControl: true,
      streetViewControl: true,
      scrollwheel: true,
      setCompassEnabled:true,
      //mapTypeId:google.maps.MapTypeId.Terrain,
      mapTypeId:google.maps.MapTypeId.Terrain,
      elementType: "labels",
    });
                       
    //Creamos el marcador en el mapa con sus propiedades
    //para nuestro objetivo tenemos que poner el atributo draggable en true
    //position pondremos las mismas coordenas que obtuvimos en la geolocalización
    var img = new google.maps.MarkerImage("fuego.gif");
    marker = new google.maps.Marker({
      map: map,
      draggable: true,
      animation: google.maps.Animation.DROP,
      position: new google.maps.LatLng(coords.lat,coords.lng),
      icon:img,
      title:"INCENDIO",
      visible:true,
    });

    //VENTANA DEL MARCADOR
    var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="firstHeading" class="firstHeading">Incendio Estructural</h3>'+
            '<div id="bodyContent">'+
            '<p>Grado 2' +
            '<div id="results">'+direccion+'</div>' +
            '<input type="button" value="Ingresar" />'+
            '</div>'+
            '</div>';

     var infowindow1 = new google.maps.InfoWindow({
    content: contentString,
    maxWidth: 200
    });

      google.maps.event.addListener(marker, 'click', function() {
       infowindow1.open(map,marker);
    });

      google.maps.event.addListener(map, 'click', function() {
    infowindow1.close();
    });
        google.maps.event.addListener(marker, 'dblclick', function() {
       marker.setMap(null);
      
    });

   
    ///////// MARCADORES DEL CARRO BOMBERO numero 1//////////////
    var place2 = new google.maps.LatLng(coords.lat,coords.lng);
    var img1 = new google.maps.MarkerImage("carro3.png");
    var bomba1 = new google.maps.Marker({
     position: place2
    , title: 'Carro Bombero'
    , map: map
    , draggable:true
    , icon:img1
     });

    var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="firstHeading" class="firstHeading">Carro de Bomberos</h3>'+
            '<div id="bodyContent">'+
            '<input type="text/>' +
            '</br>'+
            '<div id="results">'+direccion+'</div>' +
            '<input type="button" value="Ingresar/>'+
            '</div>'+
            '</div>';

     var infowindow2 = new google.maps.InfoWindow({
    content: contentString,
    maxWidth: 200
    });
     google.maps.event.addListener(bomba1, 'click', function() {
       infowindow2.open(map,bomba1);
    });

      google.maps.event.addListener(map, 'click', function() {
    infowindow2.close();
    });
        google.maps.event.addListener(bomba1, 'dblclick', function() {
       bomba1.setMap(null);
      
    });

     ///MARCADOR DE AMBULANCIA n° 1//
    var place3 = new google.maps.LatLng(coords.lat,coords.lng);
    var ambulancia = new google.maps.MarkerImage("ambulancia.png");
    var ambulancia1 = new google.maps.Marker({
      position: place3
      , title: 'Ambulancia'
      , map: map
      , draggable:true
      , icon:ambulancia
        });
   var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="firstHeading" class="firstHeading">Ambulancia</h3>'+
            '<div id="bodyContent">'+
            '<input type="text/>' +
            '</br>'+
            '<div id="results">'+direccion+'</div>' +
            '<input type="button" value="Ingresar"/>'+
            '</div>'+
            '</div>';

     var infowindow3 = new google.maps.InfoWindow({
    content: contentString,
    maxWidth: 200
    });
     google.maps.event.addListener(ambulancia1, 'click', function() {
       infowindow3.open(map,ambulancia1);
    });

      google.maps.event.addListener(map, 'click', function() {
    infowindow3.close();
    });
      google.maps.event.addListener(ambulancia1, 'dblclick', function() {
       ambulancia1.setMap(null);
      
    });

       ///MARCADOR DE AMBULANCIA n° 2//
    var place3 = new google.maps.LatLng(coords.lat,coords.lng);
    var ambulancia = new google.maps.MarkerImage("ambulancia.png");
    var ambulancia2 = new google.maps.Marker({
      position: place3
      , title: 'Ambulancia'
      , map: map
      , draggable:true
      , icon:ambulancia
        });
   var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="firstHeading" class="firstHeading">Ambulancia</h3>'+
            '<div id="bodyContent">'+
            '<input type="text/>' +
            '</br>'+
            '<div id="results">'+direccion+'</div>' +
            '<input type="button" value="Ingresar"/>'+
            '</div>'+
            '</div>';

     var infowindowamb2 = new google.maps.InfoWindow({
    content: contentString,
    maxWidth: 200
    });
     google.maps.event.addListener(ambulancia2, 'click', function() {
       infowindowamb2.open(map,ambulancia2);
    });

      google.maps.event.addListener(map, 'click', function() {
    infowindowamb2.close();
    });
       google.maps.event.addListener(ambulancia2, 'dblclick', function() {
       ambulancia2.setMap(null);
      
    });

///MARCADOR DE AMBULANCIA n° 3//
    var place3 = new google.maps.LatLng(coords.lat,coords.lng);
    var ambulancia = new google.maps.MarkerImage("ambulancia.png");
    var ambulancia3 = new google.maps.Marker({
      position: place3
      , title: 'Ambulancia'
      , map: map
      , draggable:true
      , icon:ambulancia
        });
   var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="firstHeading" class="firstHeading">Ambulancia</h3>'+
            '<div id="bodyContent">'+
            '<input type="text/>' +
            '</br>'+
            '<div id="results">'+direccion+'</div>' +
            '<input type="button" value="Ingresar"/>'+
            '</div>'+
            '</div>';

     var infowindowamb3 = new google.maps.InfoWindow({
    content: contentString,
    maxWidth: 200
    });
     google.maps.event.addListener(ambulancia3, 'click', function() {
       infowindowamb3.open(map,ambulancia3);
    });

      google.maps.event.addListener(map, 'click', function() {
    infowindowamb3.close();
    });
       google.maps.event.addListener(ambulancia3, 'dblclick', function() {
       ambulancia3.setMap(null);
      
    });

    //MARCADOR DEL CARRO numero 2

    var place4 = new google.maps.LatLng(coords.lat,coords.lng);
    var bomberos = new google.maps.MarkerImage("carro3.png");
    var bomba2 = new google.maps.Marker({
     position: place4
    , title: 'Carro Bombero'
    , map: map
    , draggable:true
    , icon:bomberos
     });

    var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="firstHeading" class="firstHeading">Carro de Bomberos</h3>'+
            '<div id="bodyContent">'+
            '<input type="text/>' +
            '</br>'+
            '<div id="results">'+direccion+'</div>' +
            '<input type="button" value="Ingresar"/>'+
            '</div>'+
            '</div>';


     var infowindow4 = new google.maps.InfoWindow({
    content: contentString,
    maxWidth: 200
    });
     google.maps.event.addListener(bomba2, 'click', function() {
       infowindow4.open(map,bomba2);
    });

      google.maps.event.addListener(map, 'click', function() {
    infowindow4.close();
    });
       google.maps.event.addListener(bomba2, 'dblclick', function() {
       bomba2.setMap(null);
      
    });
/////////////////////////////////////////////////////////////////////////////////////////////////////
  //MARCADOR DEL CARRO numero 3

    var place4 = new google.maps.LatLng(coords.lat,coords.lng);
    var bomberos = new google.maps.MarkerImage("carro3.png");
    var bomba3 = new google.maps.Marker({
     position: place4
    , title: 'Carro Bombero'
    , map: map
    , draggable:true
    , icon:bomberos
     });

     var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="firstHeading" class="firstHeading">Carro de Bomberos</h3>'+
            '<div id="bodyContent">'+
            '<input type="text/>' +
            '</br>'+
            '<div id="results">'+direccion+'</div>' +
            '<input type="button" value="Ingresar"/>'+
            '</div>'+
            '</div>';


     var infowindowbmb3 = new google.maps.InfoWindow({
    content: contentString,
    maxWidth: 200
    });
     google.maps.event.addListener(bomba3, 'click', function() {
       infowindowbmb3.open(map,bomba3);
    });

      google.maps.event.addListener(map, 'click', function() {
    infowindowbmb3.close();
    });
      google.maps.event.addListener(bomba3, 'dblclick', function() {
       bomba3.setMap(null);
      
    });
/////////////////////////////////////////////////////////////////////////////////////////////////////
//MARCADOR DEL CARRO numero 4

    var place4 = new google.maps.LatLng(coords.lat,coords.lng);
    var bomberos = new google.maps.MarkerImage("carro3.png");
    var bomba4 = new google.maps.Marker({
     position: place4
    , title: 'Carro Bombero'
    , map: map
    , draggable:true
    , icon:bomberos
     });

    var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="firstHeading" class="firstHeading">Carro de Bomberos</h3>'+
            '<div id="bodyContent">'+
            '<input type="text/>' +
            '</br>'+
            '<div id="results">'+direccion+'</div>' +
            '<input type="button" value="Ingresar"/>'+
            '</div>'+
            '</div>';


     var infowindowbmb4 = new google.maps.InfoWindow({
    content: contentString,
    maxWidth: 200
    });
     google.maps.event.addListener(bomba4, 'click', function() {
       infowindowbmb4.open(map,bomba4);
    });

      google.maps.event.addListener(map, 'click', function() {
    infowindowbmb4.close();
    });
      google.maps.event.addListener(bomba4, 'dblclick', function() {
       bomba4.setMap(null);
      
    });
/////////////////////////////////////////////////////////////////////////////////////////////////////
      //MARCADOR DEL carabinero n°1

    var place4 = new google.maps.LatLng(coords.lat,coords.lng);
    var carabinero = new google.maps.MarkerImage("carabineros.png");
    var carabinero1 = new google.maps.Marker({
     position: place4
    , title: 'Carro Bombero'
    , map: map
    , draggable:true
    , icon:carabinero
     });

     var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="firstHeading" class="firstHeading">Patrulla Carabineros de Chile</h3>'+
            '<div id="bodyContent">'+
            '<input type="text/>' +
            '</br>'+
            '<div id="results">'+direccion+'</div>' +
            '<input type="button" value="Ingresar"/>'+
            '</div>'+
            '</div>';


     var infowindowcarab1 = new google.maps.InfoWindow({
    content: contentString,
    maxWidth: 200
    });
     google.maps.event.addListener(carabinero1, 'click', function() {
       infowindowcarab1.open(map,carabinero1);
    });

      google.maps.event.addListener(map, 'click', function() {
    infowindowcarab1.close();
    });
       google.maps.event.addListener(carabinero1, 'dblclick', function() {
       carabinero1.setMap(null);
      
    });
   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////7
    //MARCADOR DEL carabinero n°2

    var place4 = new google.maps.LatLng(coords.lat,coords.lng);
    var carabinero = new google.maps.MarkerImage("carabineros.png");
    var carabinero2 = new google.maps.Marker({
     position: place4
    , title: 'Carro Bombero'
    , map: map
    , draggable:true
    , icon:carabinero
     });

     var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="firstHeading" class="firstHeading">Patrulla Carabineros de Chile</h3>'+
            '<div id="bodyContent">'+
            '<input type="text/>' +
            '</br>'+
            '<div id="results">'+direccion+'</div>' +
            '<input type="button" value="Ingresar"/>'+
            '</div>'+
            '</div>';


     var infowindowcarab2 = new google.maps.InfoWindow({
    content: contentString,
    maxWidth: 200
    });
     google.maps.event.addListener(carabinero2, 'click', function() {
       infowindowcarab2.open(map,carabinero2);
    });

      google.maps.event.addListener(map, 'click', function() {
    infowindowcarab2.close();
    });
       google.maps.event.addListener(carabinero2, 'dblclick', function() {
       carabinero2.setMap(null);
      
    });
   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////7
    //MARCADOR DEL carabinero n°3

    var place4 = new google.maps.LatLng(coords.lat,coords.lng);
    var carabinero = new google.maps.MarkerImage("carabineros.png");
    var carabinero3 = new google.maps.Marker({
     position: place4
    , title: 'Carro Bombero'
    , map: map
    , draggable:true
    , icon:carabinero
     });

     var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="firstHeading" class="firstHeading">Patrulla Carabineros de Chile</h3>'+
            '<div id="bodyContent">'+
            '<input type="text/>' +
            '</br>'+
            '<div id="results">'+direccion+'</div>' +
            '<input type="button" value="Ingresar"/>'+
            '</div>'+
            '</div>';


     var infowindowcarab3 = new google.maps.InfoWindow({
    content: contentString,
    maxWidth: 200
    });
     google.maps.event.addListener(carabinero3, 'click', function() {
       infowindowcarab3.open(map,carabinero3);
    });

      google.maps.event.addListener(map, 'click', function() {
    infowindowcarab3.close();
    });
      google.maps.event.addListener(carabinero3, 'dblclick', function() {
       carabinero3.setMap(null);
      
    });
   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////7
   //MARCADOR DEL carabinero n°4

    var place4 = new google.maps.LatLng(coords.lat,coords.lng);
    var carabinero = new google.maps.MarkerImage("carabineros.png");
    var carabinero4 = new google.maps.Marker({
     position: place4
    , title: 'Carro Bombero'
    , map: map
    , draggable:true
    , icon:carabinero
     });

    var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="firstHeading" class="firstHeading">Patrulla Carabineros de Chile</h3>'+
            '<div id="bodyContent">'+
            '<input type="text/>' +
            '</br>'+
            '<div id="results">'+direccion+'</div>' +
            '<input type="button" value="Ingresar"/>'+
            '</div>'+
            '</div>';

     var infowindowcarab4 = new google.maps.InfoWindow({
    content: contentString,
    maxWidth: 200
    });
     google.maps.event.addListener(carabinero4, 'click', function() {
       infowindowcarab4.open(map,carabinero4);
    });

      google.maps.event.addListener(map, 'click', function() {
    infowindowcarab4.close();
    });
      google.maps.event.addListener(carabinero4, 'dblclick', function() {
       carabinero4.setMap(null);
      
    });
   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////7
    //MARCADOR DEL camion aljibe

    var place4 = new google.maps.LatLng(coords.lat,coords.lng);
    var aljibe = new google.maps.MarkerImage("camion_algibe.png");
    var aljibe1 = new google.maps.Marker({
     position: place4
    , title: 'Carro Bombero'
    , map: map
    , draggable:true
    , icon:aljibe
     });

    var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="firstHeading" class="firstHeading">Camion Aljibe</h3>'+
            '<div id="bodyContent">'+
            '<input type="text/>' +
            '</br>'+
            '<div id="results">'+direccion+'</div>' +
            '<input type="button" value="Ingresar"/>'+
            '</div>'+
            '</div>';


     var infowindowalj = new google.maps.InfoWindow({
    content: contentString,
    maxWidth: 200
    });
     google.maps.event.addListener(aljibe1, 'click', function() {
       infowindowalj.open(map,aljibe1);
    });

      google.maps.event.addListener(map, 'click', function() {
    infowindowalj.close();
    });
      google.maps.event.addListener(aljibe1, 'dblclick', function() {
       aljibe1.setMap(null);
      
    });
   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////7
   //MARCADOR DEL camion aljibe n° 2

    var place4 = new google.maps.LatLng(coords.lat,coords.lng);
    var aljibe = new google.maps.MarkerImage("camion_algibe.png");
    var aljibe2 = new google.maps.Marker({
     position: place4
    , title: 'Carro Bombero'
    , map: map
    , draggable:true
    , icon:aljibe
     });

     var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="firstHeading" class="firstHeading">Camion Aljibe</h3>'+
            '<div id="bodyContent">'+
            '<input type="text/>' +
            '</br>'+
            '<div id="results">'+direccion+'</div>' +
            '<input type="button" value="Ingresar"/>'+
            '</div>'+
            '</div>';


     var infowindowalj2 = new google.maps.InfoWindow({
    content: contentString,
    maxWidth: 200
    });
     google.maps.event.addListener(aljibe2, 'click', function() {
       infowindowalj2.open(map,aljibe2);
    });

      google.maps.event.addListener(map, 'click', function() {
    infowindowalj2.close();
    });
      google.maps.event.addListener(aljibe2, 'dblclick', function() {
       aljibe2.setMap(null);
      
    });
   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////7
     //marker1.addListener('click', toggleBounce);
     // aqui el input contiene el valor de las coordenadas del marcador al desplazarlo
      marker.addListener('dragend', function (event)
    {
      document.getElementById("coords2").value= this.getPosition().lat()+","+this.getPosition().lng();
    });

      bomba1.addListener( 'dragend', function (event){
        //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
        document.getElementById("coords").value = this.getPosition().lat()+","+ this.getPosition().lng();
          
      });    

      ambulancia1.addListener('dragend', function (event)
    {
      document.getElementById("coords3").value= this.getPosition().lat()+","+this.getPosition().lng();
    });
    
      marcador2.addListener('dragend', function (event)
    {
      document.getElementById("coords4").value= this.getPosition().lat()+","+this.getPosition().lng();
    });
    
    }

    

    function Geo(){

      navigator.geolocation.getCurrentPosition(
              function (position){
                coords={
                  lng: position.coords.longitude,
                  lat: position.coords.latitude
                  };
                setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa            
                
              },function(error){console.log(error);});

      var geocoder = new google.maps.Geocoder();

    geocoder.geocode({ 'latLng': coords }, function (results, status) {

    if(status == google.maps.GeocoderStatus.OK) {
      if(results[0]) {
        $('#results').fadeOut(function() {
          $(this).html('<p class="parrafo"></b>la Direccion del incidente es :</p><p class="parrafo">'+results[0].formatted_address+'</p>').fadeIn();
          //alert(""+results[0].formatted_address);
         var direccion = results[0].formatted_address;
         alert(""+direccion);
        })
      } else {
        error('Google no ha retornado ningun resultado.');
      }
      } else {
      error("Geocodificacion Inversa a fallado por: " + status);
      }
     });

    }
    function error(msg) {
    alert(msg);
    }


  
   
</script>

<!-- src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABUtwiQ6rHqrk4bvY6-FDPG9TInI27KV8" -->
<!-- src="http://maps.googleapis.com/maps/api/js?" -->
<!--https://maps.googleapis.com/maps/api/js?callback=initMap https://maps.googleapis.com/maps/api/js?key=AIzaSyCo6FUFiHoSntxqiveC0jNe_ajAabIlLQ8
 -->
   
  </body>
</html>
<?php
}else{
  echo '<script> window.location="index.php"; </script>';// si no se muestra la pagina, me direccione a la pagina index.php
}

// $profile  =   $_SESSION['user'];

?>