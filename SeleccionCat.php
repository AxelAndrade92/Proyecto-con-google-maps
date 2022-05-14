<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Seleccion de Incidente</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link href="css/Estilo_Seleccion_Categoria.css" rel="stylesheet" type="text/css"> 

    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body style="background-color: #0c40c2">
<style type="text/css">

@media only screen  
and (min-width : 320px)  
and (max-width : 480px) {  
/* Styles */  
}  
/* Smartphones (landscape) ----------- */  
@media only screen  
and (min-width : 321px) {  
/* Styles */  
}  
/* Smartphones (portrait) ----------- */  
@media only screen  
and (max-width : 320px) {  
/* Styles */  
}  
/* iPads (portrait and landscape) ----------- */  
@media only screen  
and (min-width : 768px)  
and (max-width : 1024px) {  
/* Styles */  
}  
/* iPads (landscape) ----------- */  
@media only screen  
and (min-width : 768px)  
and (max-width : 1024px)  
and (orientation : landscape) {  
/* Styles */  
}  
/* iPads (portrait) ----------- */  
@media only screen  
and (min-width : 768px)  
and (max-width : 1024px)  
and (orientation : portrait) {  
/* Styles */  
}  
/* Desktops and laptops ----------- */  
@media only screen  
and (min-width : 1224px) {  
/* Styles */  
}  
/* Large screens ----------- */  
@media only screen  
and (min-width : 1824px) {  
/* Styles */  
}  
/* iPhone 4 ----------- */  
@media  
only screen and (-webkit-min-device-pixel-ratio : 1.5),  
only screen and (min-device-pixel-ratio : 1.5) {  
/* Styles */  
} 


</style>

	<div class="container">
      <div class="jumbotron">     
        <h1 id="h1" align="center">Sistema de Comando de Incidentes</h1>            
        <h3 id="h3" align="center">Segunda Compañia de Bomberos de San Bernardo</h3>
      </div>
  </div>

	<script  type="text/javascript">

		$(document).ready(function() {
                    $.ajax({
                            type: "POST",
                            url: 'CargaSelectTiposIncidentes.php',
                            success: function(response)
                            {
                                $('.selector-tipo select').html(response).fadeIn();
                            }
                    });
 
                });

		$(function () {
        $('#enviarDatos').click(function () {

       	var tipo = $('#selTP option:selected').text();
        var grado = $('#selGr option:selected').text();
        var dataString = 'tipo1='+tipo+'&grado1='+grado;
        

          $.ajax({
            type: 'POST',
            url: 'Grado1.php',
            cache: false,
            data: dataString,
            success: function (result) {
              //alert(result);
              window.close("SeleccionCat.php");
              
            }
            });            
            return false;
            });
        });


		function Seleccion_combo(){

		var combo = document.getElementById("selTP");
		//var selectedTP = combo.options[combo.selectedIndex].value;
		//var selectedtxt1 = combo.options[combo.selectedIndex].text;

		var combo2 = document.getElementById("selGr");
		var selectedGR = combo2.options[combo2.selectedIndex].value;
		var selectedtxt2 = combo2.options[combo2.selectedIndex].text;

		    /*if (selectedTP == "" || selectedGR == "") {
		    	$('#MensajeCentro').show(1000);
		    	$('#mensaje').show(1000);
			}else{
				alert("Selecciono "+selectedtxt1+ " y grado "+selectedtxt2);
			}*/		

			/*if ($('#slc_tipo').text() == "Seleccionar" || selectedGR == "Seleccione Grado...") {
				$('#MensajeCentro').show(1000);
		    	$('#mensaje').show(1000);
			}*/
			
			if ($('#slc_tipo option:selected').text() == "Seleccionar" || selectedGR == "Seleccione Grado...") {
				$('#MensajeCentro').show(1000);
		    	$('#mensaje').show(1000);
			}

		}

		function ocultaMsj(){
			$('#mensaje').hide(1000);
		}
		function Ingreso_SCI(){

		var combo = document.getElementById("selTP");
		//var selectedTP = combo.options[combo.selectedIndex].value;
		//var selectedtxt1 = combo.options[combo.selectedIndex].text;

		var combo2 = document.getElementById("selGr");
		var selectedGR = combo2.options[combo2.selectedIndex].value;
		var selectedtxt2 = combo2.options[combo2.selectedIndex].text;
			/*if (selectedTP == "tp1" && selectedGR == "g1") {
				window.open("Grado1.php");
			}
			//cat 1 y grado 2
			if (selectedTP == "tp1" && selectedGR == "g2") {
				window.open("Grado2.php");
			}
			//cat 1 y grado 3
			if (selectedTP == "tp1" && selectedGR == "g3") {
				window.open("Grado1.php");
			}
			//cat 1 y grado 4
			if (selectedTP == "tp1" && selectedGR == "g4") {
				window.open("Grado1.php");
			}*/

			if ($('#slc_tipo').val() =="1" && selectedGR == "g1") {
				window.open("Grado1.php");
			}

			


		}//fin function	


		
		
	</script>
	
	<div class="left">
		<img src="logo_sci.png" style="border-radius: 8px;" id="imagenes">
	</div>
	<div class="right">
		<img src="logo_sci.png" style="border-radius: 8px;" id="imagenes"  >
	</div>
	<div class="center"></div>

    <div id="Contenedor_seleccion">
		<div id="mensaje" hidden="hidden" ><h3>Informaci&oacuten</h3>
			<hr>
			<p>Debe seleccionar una Categoria de Incidente y un Grado</p>
			<br>
			<button id="Aceptar" type="submit" onclick="ocultaMsj()">Aceptar</button>		
		</div>
		<form autocomplete="off">
	<p>Seleccione el tipo de incidente</p>
	<div class="selector-tipo">
		<select id="slc_tipo" style="text-align:center;"></select>
	</div>
	
	<br>
	<br>

	<p>Seleccione grado del incidente</p>
	<select name="" id="selGr" style="text-align:center;">
		<option value="0">Seleccione Grado...</option>
		<option value="g1">1</option>
		<option value="g2">2</option>
		<option value="g3">3</option>
		<option value="g4">4</option>
	</select>
	
	<br>
	<br>
	<button id="enviarDatos" type="submit" onclick="Seleccion_combo();Ingreso_SCI();">Buscar</button>
	</form>
			
	</div>


	

</body>
</html>