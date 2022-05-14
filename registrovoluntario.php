<?php 


include('serv.php');


$nom = $_POST['nom1'];
$app = $_POST['app1']; 
$apm = $_POST['apm1']; 
$rut = $_POST['rut1']; 
$edad = $_POST['edad1'];
$fecha = $_POST['fecha1']; 
$cargo = $_POST['tipo1']; 
$compania = $_POST['comp1'];



if (isset($nom) && !empty($nom)
&& isset($app) && !empty($app)
&& isset($apm) && !empty($apm)
&& isset($rut) && !empty($rut)
&& isset($edad) && !empty($edad)
&& isset($fecha) && !empty($fecha)
&& isset($cargo) && !empty($cargo)
&& isset($compania) && !empty($compania)) {
	
	
	$conexion = mysql_connect($servidor, $usuario, $clave) or die(mysql_error());
	$acentos = mysql_query("set NAMES 'utf8'");
    $query = "INSERT INTO voluntarios (rut_voluntario,nombres_voluntario,ap_pat_voluntario,ap_mat_voluntario,edad_voluntario,fecha_ingreso_compania,id_cargo,compania_funcionario) VALUES ('$rut','$nom','$app','$apm','$edad','$fecha','$cargo','$compania')";

	$db = mysql_select_db($db,$conexion)or die("problemas en conexion");


	if (!$db) {
		die("no se puede usar la base de datos".mysql_error($conexion));
	}
	else {
		mysql_query($query,$conexion);
		echo "Registro de Voluntario insertado con Exito!";
	}
}
else{
	echo "Registro de Voluntario Fallido";
}

?>