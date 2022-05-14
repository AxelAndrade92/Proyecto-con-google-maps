<?php
session_start();//inicio la sesion
include 'serv.php';//incluyo archivo de la conexion
ob_start();//soluciona el manejo de las sesiones

if (isset($_SESSION['user']))//si se configuro la pagina con mi usuario anterior, me muestre la pagina {


{?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

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

    <p><b>N° de Incidente : </p>
    <script>
      var f = new Date();
        document.write(f.getDate() + "-" + (f.getMonth() +1) + "-" + f.getFullYear() + "<br><br>" + f.getHours()+":"+f.getMinutes()+":"+f.getSeconds()+"<b>");
         //funcion javascript de mostrar la fecha y hora actual
    </script>
    <br>
    <br>
    <br>
    <p><b>Grado de incendio: </p>
    <select class="right" name="grado">
      <option value="small">Grado 1</option>
      <option value="large">Grado 2</option>
      <option value="medium">Grado 3</option>
      <option value="small">Grado 4</option>
    </select>
    <br>

  </div>

   <div class="right">
      <br>
      <br>
      <br>
      <div id="map"></div>
      <input class="right" type="text" id="coords"/ id="map"> 
      <input class="right" type="text" id="coords2"/ id="map">
  </div>
    <script type="text/javascript">
    var marker,marker2;          //variable del marcador
    var coords = {}; 
    var map; 

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
   //
     
    var place2 = new google.maps.LatLng(coords.lat,coords.lng);
    var img2 = new google.maps.MarkerImage("carro3.png");
    var marker1 = new google.maps.Marker({
     position: place2
    , title: 'Carro Bombero'
    , map: map
    , draggable:true
    , icon:img2
     });
   
     //marker1.addListener('click', toggleBounce);
      marker1.addListener('dragend', function (event)
    {
      document.getElementById("coords2").value= this.getPosition().lat()+","+this.getPosition().lng();
    });

    var place = new google.maps.LatLng(coords.lat,coords.lng);
    var img3 = new google.maps.MarkerImage("ambulancia.png");

    var marker = new google.maps.Marker({
      position: place
      , title: 'Ambulancia'
      , map: map
      , draggable:true
      , icon:img3
        });

    var contentString="<input type='text' id='textoing'><br><br> <input type='button' class='button_shrink' position:relative value='Enviar' id='buttonrr'/>  <p id='parrafo'><p> "; 

    var contentString2="<input type='text' id='textoing'><br><br> <input type='button' class='button_shrink' position:relative value='Enviar' id='buttonrr'/>   <p><p>";

      $(document).ready(function(){
        $('#buttonrr').click(function(){
          $('#textoing').val($('#parrafo').val());
        });
      });


    var infowindow1 = new google.maps.InfoWindow({
    content: contentString,
    maxWidth: 200
    });
    var infowindow2 = new google.maps.InfoWindow({
      content: contentString2,
      maxWidth:200
    });

    google.maps.event.addListener(marker, 'click', function() {
       infowindow1.open(map,marker);
    });
    google.maps.event.addListener(map, 'click', function() {
    infowindow1.close();
    });

    google.maps.event.addListener(marker1, 'click', function() {
       infowindow2.open(map,marker1);
    });
    google.maps.event.addListener(map, 'click', function() {
    infowindow2.close();
    });

     //agregamos un evento al marcador junto con la funcion callback al igual que el evento dragend que indica 
      //cuando el usuario a soltado el marcador
      //marker.addListener('click', toggleBounce);
      marker.addListener( 'dragend', function (event){
        //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
        document.getElementById("coords").value = this.getPosition().lat()+","+ this.getPosition().lng();
          
      });
    }

    var lugar={lat: -33.45220895102853, lng: -70.6671677981476};

    function addMark(place){
      marker = new google.maps.Marker({
        position: lugar,
        map: map,
        draggable:true,
        icon:img2
      });  
    }
</script>

<!-- src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABUtwiQ6rHqrk4bvY6-FDPG9TInI27KV8" -->
<!-- src="http://maps.googleapis.com/maps/api/js?" -->
<!--https://maps.googleapis.com/maps/api/js?callback=initMap https://maps.googleapis.com/maps/api/js?key=AIzaSyCo6FUFiHoSntxqiveC0jNe_ajAabIlLQ8
 -->
   <a href="logout.php"><button>Salir</button></a>
  </body>
</html>
<?php
}else{
  echo '<script> window.location="index.php"; </script>';// si no se muestra la pagina, me direccione a la pagina index.php
}

// $profile  =   $_SESSION['user'];

?>