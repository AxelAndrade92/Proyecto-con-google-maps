 <!DOCTYPE html>
 <html lang="es">
 <head>
   <meta charset="UTF-8">
   <title>Sistema de Comando de Incidentes</title>
   <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link href="css/estilos2.css" rel="stylesheet" type="text/css">       
    <link href="css/botonesCSS1.css" rel="stylesheet" type="text/css">  
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link href="css/estilos.css" rel="stylesheet" type="text/css">       
    <link href="css/botonesCSS1.css" rel="stylesheet" type="text/css"> 
    <script type="text/javascript" src="js/jquery.min.js"></script>
       

<?php
session_start();//para iniciar una sesion
include 'serv.php';//incluimos 
if(isset($_SESSION['user'])){//condicional de que si la sesion esta configurada, mostrara la siguiente pagina
  echo '<script> window.location="PagSCI.php"; </script>';
}
?>
 </head>

 <body class="body">

  <div class="login-page">
  <div class="form">
    <form class="register-form">

      <input type="text" placeholder="name"/>
      <input type="password" placeholder="password"/>
      <input type="text" placeholder="email address"/>
      <button>create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>

    <form class="login-form" action="validar.php" method="post">
      <h3>Ingrese Usuario y Contraseña</h3>
      <input type="text" placeholder="Usuario"/ name="user" style="text-align: center;">
      <input type="password" placeholder="Contrase&ntilde;a" name="pw" style="text-align: center;"/>
      <button type="submit" name="login">ingresar</button>
    </form>
  </div>
   
 </body>
 </html>

