<?php


include('serv.php');

$conexion = mysql_connect($servidor, $usuario, $clave) or die(mysql_error());
	$acentos = mysql_query("set NAMES 'utf8'");
    $query = "select id_incidente,descr_incidente from tipo_incidente";
    $result = mysql_query($query)
        or die("Ocurrio un error en la consulta SQL");

    echo '<option value="0">Seleccionar</option>';

    while (($fila = mysql_fetch_array($result)) != NULL) {
    	echo '<option value ="'.$fila["id_incidente"].'">'.$fila["descr_incidente"].'</option>';
    	# code...
    }

    mysql_free_result($result);

	$db = mysql_select_db($db,$conexion)or die("problemas en conexion");


	if (!$db) {
		die("no se puede usar la base de datos".mysql_error($conexion));
	}
	else {
		mysql_query($query,$conexion);
		echo "Registro de Incidente insertado con Exito!";
	}















?>
