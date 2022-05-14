<?php
include ("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["keyword"])) {
$query ="SELECT nombres_voluntario FROM voluntarios WHERE nombres_voluntario like '" . $_POST["keyword"] . "%' ORDER BY nombres_voluntario LIMIT 0,6";
$result = $db_handle->runQuery($query);
if(!empty($result)) {
?>
<ul id="lista-nombres">
<?php
foreach($result as $nombre) {
?>
<li onClick="seleccionNombre('<?php echo $nombre["nombres_voluntario"]; ?>');"><?php echo $nombre["nombres_voluntario"]; ?></li>
<?php } ?>
</ul>
<?php } } ?>