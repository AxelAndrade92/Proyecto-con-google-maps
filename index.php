<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Compañia de Bomberos de San Bernardo</title>
	<link rel="stylesheet" href="css/estilos.css">
	<style>
#fondo{
  background-image: url(fondo_logout.png);
  background-size: 100%;
}

a{
  font:bold 25px Verdana;
  text-decoration: none;
  color:#f2f2f2;
  border:4px solid #FF8000;
  padding: 15px 35px 15px 35px;
  border-radius: 5px;
  background-color:#FF0000;
  transition: background .5s,color .5s;
}
a:hover{
	background:#f2f2f2;
	color:#FF0000;
}


	</style>
</head>
<body id="fondo"><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<script>
		function Ingreso(){
					window.open("login.php");
					
			}

		function Cerrar(){
			window.close("");
		}
	</script>


	<center>
	
	  		<a href="" onclick="Ingreso(); Cerrar()">Ingresar</a>
	
	</center>
	
	
</body>
</html>