<?php 

$servidor ='localhost'; // aqui colocar el nombre de tu servidor por default es localhost
$usuario = 'root'; // aqui el usuario
$clave =''; // aqui va la clave de acceso a tu servidor
$db='cliente_clon'; // aqui el nombre de tu base de datos

// ahora con todos los datos en variables procedemos a validar la conexion
$conexion = mysql_connect($servidor, $usuario, $clave) 
or die(mysql_error()); // devolvemos un mensaje de error si fallo la conexion

mysql_select_db($db, $conexion); // seleccionamos la base de datos



?>