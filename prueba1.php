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
    <script type="text/javascript" src="js/jquery.min.js"></script>
       
    
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
      <input type="button" class="button" id="go" value="Click M" onclick="Geo()">
      <a href="logout.php"><button>Salir</button></a>
    </form>
   
   </div>


   <div class="right">
      <div id="map"></div>
      <input class="right" type="text" id="coords"/ id="map" disabled="true" > 
      
  </div>
    <script type="text/javascript">
    var marker,marker2;          //variable del marcador
    var coords = {}; 
    var map; 
    
    //coordenadas obtenidas con la geolocalización

    //Funcion principal
    initMap = function () 
    {
        //usamos la API para geolocalizar el usuario
            navigator.geolocation.getCurrentPosition(
              function (position){
                coords={
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
    var img = new google.maps.MarkerImage("fuego2.gif");
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

    var contentString="<input type='text' id='textoing'><br><br> <input type='button' class='button_shrink' position:relative value='Enviar' id='buttonrr'/>  <p id='parrafo'><p> "; 

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

    var contentString="<input type='text' id='textoing'><br><br> <input type='button' class='button_shrink' position:relative value='Enviar' id='buttonrr'/>  <p id='parrafo'><p> "; 

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

     ///MARCADOR DE AMBULANCIA//
    var place3 = new google.maps.LatLng(coords.lat,coords.lng);
    var ambulancia = new google.maps.MarkerImage("ambulancia.png");
    var ambulancia1 = new google.maps.Marker({
      position: place3
      , title: 'Ambulancia'
      , map: map
      , draggable:true
      , icon:ambulancia
        });
    var contentString="<input type='text' id='textoing'><br><br> <input type='button' class='button_shrink' position:relative value='Enviar' id='buttonrr'/>  <p id='parrafo'><p> "; 

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


    //MARCADOR DEL CARRO numero 2

    var place4 = new google.maps.LatLng(coords.lat,coords.lng);
    var bomba2 = new google.maps.MarkerImage("carro3.png");
    var marcador2 = new google.maps.Marker({
     position: place4
    , title: 'Carro Bombero'
    , map: map
    , draggable:true
    , icon:bomba2
     });

    

     var contentString="<div><script>function mostrar(){alert('hola');} <button type='submit' onclick='mostrar()'/>Enviar </div>"

     /*"<script type='text/javascript'>function mostrar(){alert('Hola');}<script><input type='text' placeholder='Ingrese orden a Carro'></br></br><button type ='submit' class='btn btn-primary btn-xs' onclick='mostrar()'/>Enviar"; */

     var infowindow4 = new google.maps.InfoWindow({
    content: contentString,
    maxWidth: 200
    });
     google.maps.event.addListener(marcador2, 'click', function() {
       infowindow4.open(map,marcador2);
    });

      google.maps.event.addListener(map, 'click', function() {
    infowindow4.close();
    });
   
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

    

    function Geo(latitude, longitude){

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