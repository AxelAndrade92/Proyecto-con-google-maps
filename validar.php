<?php
	session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php
		include 'serv.php';//lamamos al archivo de la conexion
		if (isset($_POST['login'])) {
			$hash_password = sha1($_POST[password]);
			$usuario = $_POST['user'];//asignamos las variables
			$pw = $_POST['pw']; //sha1($_POST['pw']); ////
			//$hashed_password = password_hash($pw,PASSWORD_DEFAULT);
			//var_dump($hashed_password);
			$log = mysql_query("SELECT * FROM admin WHERE user='$usuario' AND pw='$pw'");
			if (mysql_num_rows($log)>0) {//cuantos resultados salieron de la consulta
				$row = mysql_fetch_array($log);
				$_SESSION["user"] = $row['user'];
				echo 'Iniciando sesion para '.$_SESSION['user'].' <p>';
				echo '<script> window.location = "SeleccionCat.php"; </script>';

			}else{
				echo '<script> alert("usuario o contraseña incorrectos.");</script>';
				echo '<script> window.location="login.php"; </script>';
			}
		}
	?>
	
</body>
</html>