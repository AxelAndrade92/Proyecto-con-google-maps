<?php 
if(isset($_REQUEST))
{
        mysql_connect("localhost","root","");
mysql_select_db("voluntarios");
error_reporting(E_ALL && ~E_NOTICE);

$nombre=$_POST['nombre'];
$sql="INSERT INTO voluntarios(nombre) VALUES ('$nombre')";
$result=mysql_query($sql);
if($result){
echo "You have been successfully subscribed.";
}
}
?>