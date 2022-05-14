<?php
session_start();//inicio la sesion
include 'serv.php';//incluyo archivo de la conexion
ob_start();//soluciona el manejo de las sesiones

if (isset($_SESSION['user']))//si se configuro la pagina con mi usuario anterior, me muestre la pagina {


{?>
<!DOCTYPE HTML>
<html>
  <head> 
    <meta charset="utf-8" viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <title>Sistema de Comando de Incidentes</title>

    <!--<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">-->
    <!-- <link href="css/estilos.css" rel="stylesheet" type="text/css"> -->
    <link href="css/EstilosGrados.css" rel="stylesheet" type="text/css">       
    <link href="css/botonesCSS1.css" rel="stylesheet" type="text/css">  
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
     <link href="css/bootstrap.icon-large.min.css" rel="stylesheet">    
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> 

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5A9jIHwkvIj-SiJhffuVFwg7wPj5YhKA" ></script>    

    
  </head>
  <style>    
  .frmSearch {border: 1px solid #a8d4b1;background-color: #c6f7d0;margin: 2px 0px;padding:40px;border-radius:4px;}
  #lista-nombres{float:center;list-style:none;margin-top:-3px;padding:0;width:190px;position: absolute;}
  #lista-nombres li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
  #lista-nombres li:hover{background:#ece3d2;cursor: pointer;}
  #search-box{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}


@media (min-width: 576px) { ... }

// Medium devices (tablets, 768px and up)
@media (min-width: 768px) { ... }

// Large devices (desktops, 992px and up)
@media (min-width: 992px) { ... }

// Extra large devices (large desktops, 1200px and up)
@media (min-width: 1200px) { ... }

  </style>


  <body class="body" style="background-color: #0c40c2" onload="initMap();Geo();">

<!-- <script> 
  if(navigator.onLine){
      alert('En Linea');
      }else {
      alert('Debe tener Conexion a Internet para el uso del Sistema de Comando de Incidente')
      }
</script> -->


  <div class="container" style="height: 200px; width: auto;">
      <div class="jumbotron" style="height: 200px;">     
        <h1 id="h1" align="center">Sistema de Comando de Incidentes</h1>            
        <h3 id="h3" align="center">Segunda Compañia de Bomberos de San Bernardo</h3>
    <input class="btn btn-primary btn-lg btn-block" type="submit" id="go" value="Geolocalizar" onclick="Geo()">
        

      </div>
  </div>
                                        
      <br>
      <br>
                                 
  <div class="left">

  <?php
  
  $Grado_incidente = isset($_GET['grado1']) ? $_GET['grado1']:null;
 
  $Tipo_incidente = isset($_GET['tipo1']) ? $_GET['tipo1'] :null;

  //$pw ='aaa';
  //$hashed_password = password_hash($pw,PASSWORD_BCRYPT);
  //var_dump($hashed_password);

  //echo password_hash("rasmuslerdorf", PASSWORD_DEFAULT)."\n";

  //var_dump($Grado_incidente);
  //var_dump($Tipo_incidente);
 
  ?>
    
    <script> 

        var f = new Date();
        var dd = f.getDate();
        var mm = f.getMonth()+1; 
        var yyyy = f.getFullYear();
        if(dd<10){
            dd='0'+dd;
        } 
        if(mm<10){
            mm='0'+mm;
        } 
        var f = dd+'/'+mm+'/'+yyyy;

        document.getElementById("fechaobtenida").value = f;     

    </script>
  
     
    
     <div style="border-radius: 5px; background-color: #f2f2f2; padding: 50px; height: auto ; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

    <form  autocomplete="off" method="POST">
      <h3 style="text-align: center;">Datos del Incidente</h3>

      <div id="results"></div>
      
      
      <input type="text" name="" id="horaobtenida" size="2"  readonly="true" style="display:none;">
      <input type="text" name="" id="minutoobtenida" size="2" readonly="true" style="display:none;">
      <p>Grado de Incidente</p>
      <input type="text" name="gradoDiv">
      <br>
      <br>

      
      <p>Dir. de Incidente:<span class="glyphicon glyphicon-road"></span></p>
      <input type="text" name="direccion" id="direccion" maxlength="100"  style="display: inline-block;">

      <p>Nº:<span class="glyphicon glyphicon-pencil"></span> </p>
      <input type="text" name="numero" id="numero" maxlength="100"  style="display: inline-block;">
      
    
      <p>Comuna:<span class="glyphicon glyphicon-pencil"></span> </p>
      <input type="text" name="comuna" id="comuna"  readonly="true">
      
      
      <p>Region:<span class="glyphicon glyphicon-pencil"></span> </p>
      <input type="text" name="region" id="region"  disabled readonly="true">
     
      
      <p>Pais:</p>
      <input type="text" name="pais" id="pais"  disabled readonly="true">
     
      <p>Encargado de realizar estrategia:<span class="glyphicon glyphicon-user"></span> </p>    
      <input type="text" name="nombreVoluntario" id="nombreVoluntario" maxlength="100">
      <div id="suggesstion-box"></div>
      
      <p>Persona a cargo de incidente:<span class="glyphicon glyphicon-user"></span></p>   
      <input type="text" name="nombreVoluntarioaCargo" id="nombreVoluntarioaCargo" maxlength="100">
      <div id="suggesstion-box"></div>
      <p>Cantidad de Voluntarios:</p>   
      <input type="phone" name="" id="" maxlength="100" >
      <br>
      
     
     
      
    </form>
    </div>
    </div>
    
    <div class="right">  
      <img src="logo_sci.png" style="border-radius: 8px;" id="imagenes" >    
      <!--<input class="right" type="text" id="coords"/ id="map" disabled="true" > 
      <br>
      <br>
      <input class="right" type="text" id="coords2"/ id="map" disabled="true">
      <br>
      <br>
      <input class="right" type="text" id="coords3"/ id="map" disabled="true">
      <br>
      <br>
      <input class="right" type="text" id="coords4"/ id="map" disabled="true">-->
  </div>
   
    <div class="center" id="center" >
      <div id="map" style="margin-top: 20px;"></div>

      <div class="btn-group" style="margin-left: 200px; display: inline-block;">
      <button class="btn btn-primary btn-lg" id="registrar" name="submit" type="submit" value="Registrar">Registrar&nbsp;<span class="glyphicon glyphicon-floppy-disk"></span></button>

       <!-- <button><input  class="btn btn-primary btn-lg" id="registrar" name="submit" type="submit" value="Registrar" /><span class="glyphicon glyphicon-floppy-disk"></button>-->
        
        <a href="logout.php" aria-hidden="true"><button class="btn btn-primary btn-lg">Salir&nbsp;<span class="glyphicon glyphicon-share-alt"></span></span>        
        </button></a>
      </div>
     
    </div>   



   
 <script type="text/javascript">

   $(function () {
        $('#registrar').click(function () {

        var dir = $("#direccion").val();
        var num = $("#numero").val();
        var com = $("#comuna").val();        
        var enc = $("#nombreVoluntario").val();
        var pcar = $("#nombreVoluntarioaCargo").val();

        var dataString = 'dir1='+dir+'&num1='+num+'&com1='+com+'&enc1='+enc+'&pcar1='+pcar;

        if (dir==""||num==""||com==""||enc==""||pcar=="") {

          alert("Por favor llene los campos del formulario");
        }
        else
        {
          $.ajax({
            type: 'POST',
            url: 'registroincidente.php',
            cache: false,
            data: dataString,
            success: function (result) {
              alert(result);
              $("#direccion").prop('disabled',true);
              $("#numero").prop('disabled',true);
              $("#comuna").prop('disabled',true);
              $("#nombreVoluntario").prop('disabled',true)
              $("#nombreVoluntarioaCargo").prop('disabled',true)
            }
            });
            }
            return false;
            });
            });

    $(document).ready(function(){
  $("#nombreVoluntario").keyup(function(){
    $.ajax({
    type: "POST",
    url: "sugerenciaNombre.php",
    data:'keyword='+$(this).val(),
    beforeSend: function(){
      $("#nombreVoluntario").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
    },
    success: function(data){
      $("#suggesstion-box").show();
      $("#suggesstion-box").html(data);
      $("#nombreVoluntario").css("background","#FFF");
    }
    });
  });
});

//seleccionar nombre sugerido y setearlo en el input
function seleccionNombre(val) {
$("#nombreVoluntario").val(val);
$("#suggesstion-box").hide();
}
 

 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////7
 
    
    var marker,marker2;          //variable del marcador
    var coords = {}; 
    var map; 
    
    function llamaFunciones(){
      initMap();
      Geo();
    }
    
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
            '<div id="results"></div>' +
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
            '<input type="text/> id="campo1"' +
            '</br>'+
            '<div id="campo2"></div>' +
            '<input type="button" value="Ingresar" display="inline">'+
            '</div>' +
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
            '<div id="results"></div>' +
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
            '<div id="results"></div>' +
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
            '<div id="results"></div>' +
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
            '<div id="results"></div>' +
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
            '<div id="results"></div>' +
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
            '<div id="results"></div>' +
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
            '<div id="results"></div>' +
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
            '<div id="results"></div>' +
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
    
   /*   marcador2.addListener('dragend', function (event)
    {
      document.getElementById("coords4").value= this.getPosition().lat()+","+this.getPosition().lng();
    });
    */
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
           var address = "", city = "", state = "", country = "";

            for (var i = 0; i < results[0].address_components.length; i++) {
                          var addr = results[0].address_components[i];
                          // check if this entry in address_components has a type of country
                          if (addr.types[0] == 'country')
                              country = addr.long_name;
                          else if (addr.types[0] == 'street_address') // address 1
                              address = address + addr.long_name;
                          else if (addr.types[0] == 'establishment')
                              address = address + addr.long_name;
                          else if (addr.types[0] == 'route')  // address 2
                              address = address + addr.long_name;
                          else if (addr.types[0] == ['administrative_area_level_1'])       // State
                              state = addr.long_name;
                          else if (addr.types[0] == ['locality'])       // City
                              city = addr.long_name;
                      }
          //$(this).html('<p class="parrafo"></b>la Direccion del incidente es :</p><p class="parrafo">'+results[0].formatted_address+'</p>').fadeIn();
          //alert(""+results[0].formatted_address);          
          var direccion =  results[0].formatted_address;
          console.log(address);
          console.log(city);
          console.log(state);
          console.log(country); 

          var d = new Date();
          var h = d.getHours();
          var m = d.getMinutes();
                 
          var direccionn = address;
          var comuna = city;
          var region = state;
          var pais = country;

          document.getElementById("direccion").value = direccion;
          document.getElementById("comuna").value = comuna;
          document.getElementById("region").value = region;
          document.getElementById("pais").value = pais;          

          document.getElementById("direccion").value = direccionn;
          document.getElementById("fechaobtenida").value = f;
          
          document.getElementById("horaobtenida").value = h;
          document.getElementById("minutoobtenida").value = m;

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