<?php 


include('serv.php');

var_dump($_POST['direccion']);

if (isset($_POST['direccion']) && !empty($_POST['direccion'])) {
	
	/*$con = mysqli_connect($servidor,$usuario,$clave)or die("problemas con la base de datos");*/

	$conexion = mysql_connect($servidor, $usuario, $clave) or die(mysql_error());
    $query = "INSERT INTO registro_incidente(direccion) VALUES ('$_POST[direccion]')";

	$db = mysql_select_db($db,$conexion)or die("problemas en conexion");


	if (!$db) {
		die("no se puede usar la base de datos".mysql_error($conexion));
	}
	else {
		mysql_query($query,$conexion);
		echo "Datos insertados";
	}
}
else{
	echo "Problemas al insertar datos";
}



































/*$servidor ="localhost"; // aqui colocar el nombre de tu servidor por default es localhost
$usuario = "root"; // aqui el usuario
$clave = ""; // aqui va la clave de acceso a tu servidor
$db = "clase_php";*/ // aqui el nombre de tu base de datos

/*/*/
/*   $host = "localhost";
    $user = "root";
    $password = "";
    $database = "clase_php";
include('dbcontroller.php');
*/
/*$dir = $_POST['direccion'];*/

/*if(isset($_POST['direccion']) || !empty($_POST['direccion']))*/
/*if ($conexion = mysqli_connect($host,$user,$password));*/

	/*$conexion = mysql_connect($servidor, $usuario, $clave) or die(mysql_error());*/// ahora con todos los datos en variables procedemos a validar la conexion
	/*mysql_select_db($db,$conexion)or die(mysql_error());*/ // seleccionamos la base de datos

/*	mysql_query("INSERT INTO registro_incidente (direccion) VALUES ('$_POST['direccion']')",$conexion);
	$conexion = mysqli_connect($host,$user,$password)or die("problemas al conectar");
	mysql_select_db($conexion.$database);

	$consulta = "INSERT INTO registro_incidente (direccion) VALUES ('$_POST[direccion]'))";

	$resultado = mysqli_query($conexion,$consulta);

	if ($resultado) {
		echo "Ingresado con Exito!";
	}
	else{
		echo "Error al ingresar";
	}

	if (mysql_close($conexion)) {
		echo "Desconectado";
	}else {
		echo "error en la desconexion";
	}
*/

	/*echo "<h2>Datos insertados</h2>
			<br>
		<p>Incidente registrado con Exito!</p>";

}else{
	echo "Problema al insertar datos";
	
}
*/
/*/*/
?>