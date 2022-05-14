<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Seleccion de Incidente</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link href="css/Estilo_Seleccion_Categoria.css" rel="stylesheet" type="text/css"> 
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> 
</head>
<body style="background-color: #0c40c2">


	<div class="container" style="height: 200px; width: auto;">
      <div class="jumbotron" style="height: 200px;">     
        <h1 id="h1" align="center">Sistema de Comando de Incidentes</h1>            
        <h3 id="h3" align="center">Segunda Compañia de Bomberos de San Bernardo</h3>
      </div>
  </div>

	<script  type="text/javascript">

		$(document).ready(function() {
                    $.ajax({
                            type: "POST",
                            url: 'CargaSelectCargos.php',
                            success: function(response)
                            {
                                $('.selector-tipo select').html(response).fadeIn();
                            }
                    });

                    $.ajax({
                            type: "POST",
                            url: 'CargarSelectCompanias.php',
                            success: function(response)
                            {
                                $('.selector-compania select').html(response).fadeIn();
                            }
                    });
 
                });

		$(function () {
        $('#enviarDatos').click(function () {
        var nombres = $('#nombres').val();
        var app = $('#apellidoP').val();
        var apm = $('#apellidoM').val();
        var edad = $('#edad').val();
        var rut = $('#rut').val();
        var fecha = $('#fecha').val();
        var tipo = $('.selector-tipo option:selected').val();
				var comp = $('.selector-compania option:selected').val();     

        var dataString = 'nom1='+nombres+'&app1='+app+'&apm1='+apm+'&edad1='+edad+'&rut1='+rut+'&fecha1='+fecha+'&tipo1='+tipo+'&comp1='+comp;
        

        if (nombres==""||app==""||apm==""||edad==""||rut==""||fecha==""||tipo==""||comp=="") {

          alert("Por favor llene los campos del formulario");
        }
        else
        {
          $.ajax({
            type: 'POST',
            url: 'registrovoluntario.php',
            cache: false,
            data: dataString,
            success: function (result) {
              alert(result);             

            }
            });
            }
            return false;
            });
            });
		/*$(function () {
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
              //window.close("SeleccionCat.php");
              
            }
            });            
            return false;
            });
        });*/


		function Seleccion_combo(){

		var combo = document.getElementById("selTP");
		//var selectedTP = combo.options[combo.selectedIndex].value;
		//var selectedtxt1 = combo.options[combo.selectedIndex].text;

		var combo2 = document.getElementById("selGr");
		var selectedGR = combo2.options[combo2.selectedIndex].value;
		var selectedtxt2 = combo2.options[combo2.selectedIndex].text;

		   /* if (selectedTP == "" || selectedGR == "") {
		    	$('#MensajeCentro').show(1000);
		    	$('#mensaje').show(1000);
			}else{
				alert("Selecciono "+selectedtxt1+ " y grado "+selectedtxt2);
			}*/		
		}

		function ocultaMsj(){
			$('#mensaje').hide(1000);
		}
		function Ingreso_SCI(){

		


		}//fin function	


		
		
	</script>
	<style type="text/css">

	input[type=text]:focus {
      border: 3px solid #555;
	}

	input[type=text]{
	  border-radius: 5px;
	  text-align:center;
	  display: inline-block;
	  width: auto;
	}

	input[type=submit] {
	  cursor: pointer;
	}

	</style>
	<div class="left">
		<img src="logo_sci.png" style="border-radius: 8px;" id="imagenes" >
	</div>
	<div class="right">
		<img src="logo_sci.png" style="border-radius: 8px;" id="imagenes" >
	</div>
	<div class="center">
    </div>
			
	


	<div id="Contenedor_seleccion" >
		<div id="mensaje" hidden="hidden" ><h3>Informaci&oacuten</h3>
			<hr>
			<p>No debe dejar campos vacios</p>
			<br>
			<button id="Aceptar" type="submit" onclick="ocultaMsj()">Aceptar</button>		
		</div>
		<form autocomplete="off" style="background-color: #ffffff">
			<h2>Formulario de Registro de Voluntarios</h2>

	<p>Nombres: <span class="glyphicon glyphicon-user"></span></p>
	<input type="text" id="nombres" name="nombress" style="text-align:center;">
	<br>
	<p>Apellido Paterno :<span class="glyphicon glyphicon-user"></span></p>
	<input type="text" id="apellidoP" name="apellidoPp" style="text-align:center;">
	<br>	
	<p>Apellido Materno :<span class="glyphicon glyphicon-user"></span></p>
	<input type="text" id="apellidoM" name="apellidoMm" style="text-align:center;">
	<br>
	<p>Rut :<span class="glyphicon glyphicon-user"></span></p>
	<input type="text" id="rut" name="rutt" maxlength="9" style="text-align:center;">
	<br>
	<p>Edad :<span class="glyphicon glyphicon-user"></span></p>
	<input type="number" id="edad" name="edadd" maxlength="2" style="text-align:center;">
	<br>
	<p>Fecha de Ingreso a Compañia <span class="glyphicon glyphicon-calendar"></span></p>
	<input type="date" id="fecha" name="fechaa" step="1">
	<br>
	<p>Cargo <span class="glyphicon glyphicon-tower"></span></p>
	<div class="selector-tipo" >
		<select class="slc_tipo" style="text-align:center;"></select>
	</div>
	<br>
	<p>Compañia perteneciente</p>
	<div class="selector-compania" class="form-control form-control-lg">
		<select id="slc_tipo" style="text-align:center;"></select>
	</div>
	<br>
	<br>
	<button class="btn btn-primary btn-sm" id="enviarDatos" type="submit">Registrar <span class="glyphicon glyphicon-ok"></span></button>
	<br>
	<br>
	</form>
	<br>
	<br>
	<br>
	
</body>
</html>