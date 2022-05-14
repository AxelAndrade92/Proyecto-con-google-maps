<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCy3sBztwbAWJn4_PuBTwdG5S67K4aliLE" ></script>
	 <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- <link href="css/estilos.css" rel="stylesheet" type="text/css"> -->
    <link href="css/EstilosGrados.css" rel="stylesheet" type="text/css">       
    <link href="css/botonesCSS1.css" rel="stylesheet" type="text/css">  
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>


	<style type="text/css">
/*
	.container{
	background-color: lightgrey;
    width: 1000px;
    border: 5px solid green;
    padding: 80px;
    margin: 70px;
    margin-top: 250px;
    border-radius: 20px;
	}*/

	.formulario{
		   float:left;
		   width:20%;
		   text-align:center;
		   border: 2px solid green;
		   padding-bottom: 5px;
		   margin-bottom: 5px;
	    }

	.mapa{
		  float:left;
		  width:70%;
		  padding:0 20px;
		  border: 5px solid green;
		  display: none;
		  margin-top: 50px;
		}

	#map{
		  width: 740px;
		  height: 512px;       
		  border-radius: 20px;
		  border-style: inset;
		  margin-left: 160px;
		  margin-top: 68px;
		  position: float;		  
		}

	.oculto{
		display: none;
	}
	.jumbotron{
		background-color: #A69896;
		height: 100px;
		background-image: url(../img/bomberos.jpg);
		background-size: cover;
		background-position: 0% 25%;
		text-shadow: white 0.3em 0.3em 0.3em;
		}

	.header{
		background-color:#A69896;
		padding:25px;text-align:center;
		background-image: url(../img/bomberos.jpg);
		height: 100px;
	}
	@media only screen and (max-width:620px) {
	  /* For mobile phones: */
	  .formulario, .mapa {
	    width:100%;
	    padding:0 20px;
		border: 5px solid green;
	  }
	@media (min-width: 1200px){
      .formulario, .mapa {
	    width:100%; 
	  } 
	  /* Escritorio pequeño o una tablet */
	@media (min-width: 768px) and (max-width: 979px){
	   .formulario, .mapa {
	    width:100%;
	  } 
	  /* Tablet o SmartPhone */
	@media (max-width: 767px){
	   .formulario, .mapa {
	    width:100%;
	 } 
	  /* SmartPhone */
    @media (max-width: 460px){
	   .formulario, .mapa {
	    width:440px;
	    height: 250px;
	    border-radius: 20px;
	    border-style: inset;
	    margin-left: 2px;
	    margin-top: 68px;
	 } 
	}
	
	</style>
</head>
<body onload="initMap()" >
	<div class="header">
	  
	</div>
	
	<div class="container"></div>
	
	<div class="formulario">
		<div class="w3-container w3-blue">
		  <h2>Formulario</h2>
		</div>
		<form action="registroincidente.php" method="POST">
      <div id="results"></div>
      <br>
      <input type="text" name="" id="horaobtenida" size="2"  readonly="true" style="display:none;">
      <input type="text" name="" id="minutoobtenida" size="2" readonly="true" style="display:none;">
      <br>
      <p>Dir. de Incidente:</p>
      <input type="text" name="direccion" id="direccion" maxlength="100" size="auto" readonly="true">
      <br>
      <p>Comuna:</p>
      <input type="text" name="comuna" id="comuna" size="auto" readonly="true">
      <br>
      <p>Region:</p>
      <input type="text" name="region" id="region" size="auto" disabled readonly="true">
      <br>
      <p>Encargado de realizar estrategia:<span class="glyphicon glyphicon-pencil"></span> </p>    
      <input type="text" name="nombreVoluntario" id="nombreVoluntario" maxlength="100" size="auauto" placeholder="Primer Nombre y Primer Apellido">
      <div id="suggesstion-box"></div>
      <br> 
      <p>Persona a cargo de incidente:</p>   
      <input type="text" name="nombreVoluntarioaCargo" id="nombreVoluntarioaCargo" maxlength="100" size="auto" placeholder="Primer Nombre y Primer Apellido">
      <div id="suggesstion-box"></div>
      <p>Cantidad de Voluntarios:</p>   
      <input type="phone" name="" id="" maxlength="100" size="5" placeholder="Estimada" maxlength="3">
      <br>
     
      <input class="form-btn" name="submit" type="submit" value="Registrar" onclick="Validar();" />
      <input type="button" class="button" id="go" value="Click M" onclick="Geo()">
      
    </form>
	</div>

	<div class="otro"></div>
 	
	<div id="map" class="mapa" style="display:none;"></div>

	<script type="text/javascript">

/*    $(document).ready(function(){
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
}*/
 

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
            '<input type="text/>' +
            '</br>'+
            '<div id="results"></div>' +
            '<input type="button" value="Ingresar" display="inline">'+
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

    	$("#go").click(function(){
    		$('#map').show();
    		/*$('#map').slideDown("slow");*/
    	})
    	

		
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
          /*document.getElementById("pais").value = pais;  */        

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
</body>
</html>