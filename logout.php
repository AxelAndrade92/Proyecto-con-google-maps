<?php
session_start();
session_destroy();
echo 'Cerraste sesion';
echo '<script> window.location = "index.php"; </script>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Saliendo...</title>
</head>
<body >
	
</body>
</html>