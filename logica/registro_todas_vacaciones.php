<?php
ob_start();
include("../config/conexion.php");


$anio = $_POST["anio"];
$consulta = "SELECT CONCAT(nombres,' ',apellidos) as nombre ,MONTH(fecha_ingreso) mes,DAY(fecha_ingreso) dia ,codigo FROM `personal`";
$ejecutar_consulta = $conexion->query(($consulta));


$fecha='';
$id_personal='';
$ejecutar =False;
while ($rows = $ejecutar_consulta->fetch_assoc()) {
	$fecha = $anio.'-'.$rows["mes"].'-'.$rows["dia"];
	$fecha2 = date('Y-m-d', strtotime($fecha. ' + 15 days'));
	$id_personal = $rows["codigo"];
	$nombre = $rows["nombre"];

	$sql = "INSERT INTO `vacaciones` VALUES (NULL, '$id_personal', '$fecha', NULL, current_timestamp())";
	$ejecutar = $conexion->query(($sql));
	$sql2 = "INSERT INTO `events` VALUES (NULL, 'VACACIONES DE: $nombre', '#00ff00', '$fecha', '$fecha2' )";
	$ejecutar2 = $conexion->query(($sql2));
}
if ($ejecutar) {
	header("Location: ../vacaciones.php?error=no");
} else {
	header("Localtion: ../vacaciones.php?error=si");
}
?>