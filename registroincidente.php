<?php 
include('serv.php');

/*var_dump($_POST['direccion']);
var_dump($_POST['comuna']);
var_dump($_POST['nombreVoluntario']);
var_dump($_POST['nombreVoluntarioaCargo']);*/
$dir = $_POST['dir1'];
$num = $_POST['num1'];
$com = $_POST['com1'];
/*$nomVol = isset($_POST['nombreVoluntario']) ? $_POST['nombreVoluntario'];*/
$nomVol = $_POST['enc1'];
$nomVolCar = $_POST['pcar1'];
$fechaActual = date("D-M-Y");


/*var_dump($fechaActual);
var_dump($dir);
var_dump($com);
var_dump($nomVol);
var_dump($nomVolCar);*/

if (isset($dir) && !empty($dir)
&& isset($com) && !empty($com)
&& isset($fechaActual) && !empty($fechaActual)
&& isset($nomVol) && !empty($nomVol)
&& isset($nomVolCar) && !empty($nomVolCar)) {
	
	/*$con = mysqli_connect($servidor,$usuario,$clave)or die("problemas con la base de datos");*/

	$conexion = mysql_connect($servidor, $usuario, $clave) or die(mysql_error());
	$acentos = mysql_query("set NAMES 'utf8'");
    $query = "INSERT INTO registro_incidente (direccion,numero_direccion,comuna,fecha,nombre_estrategia,nombre_a_cargo) VALUES ('$_POST[dir1]','$_POST[num1]','$_POST[com1]',NOW(),'$_POST[enc1]','$_POST[pcar1]')";

	$db = mysql_select_db($db,$conexion)or die("problemas en conexion");


	if (!$db) {
		die("no se puede usar la base de datos".mysql_error($conexion));
	}
	else {
		mysql_query($query,$conexion);
		echo "Registro de Incidente insertado con Exito!";
	}
}
else{
	echo "Registro de Incidente Fallido";
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