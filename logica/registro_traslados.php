<?php
ob_start();
include("../config/conexion.php");

$id_personal = strtoupper($_POST["id_personal"]);
$id_sucursal = ($_POST["id_sucursal"]);
$f_desde = ($_POST["f_desde"]);
$f_hasta = ($_POST["f_hasta"]);


$consulta = "INSERT INTO `traslados` (`id`, `id_personal`, `id_sucursal`, `f_desde`, `f_hasta`, `fecha_registro`) VALUES (NULL, '$id_personal', '$id_sucursal', '$f_desde', '$f_hasta', current_timestamp());";
$ejecutar_consulta = $conexion->query(($consulta));

$sqll = "SELECT CONCAT(nombres,' ',apellidos) as nombre FROM personal";
$ejecutarl = $conexion->query(($sqll));
$nombre = $ejecutarl->fetch_row();


$sql2 = "INSERT INTO `events` VALUES (NULL, 'TRASLADO DE: $nombre[0]', '#ffc107', '$f_desde', '$f_hasta' )";
$ejecutar2 = $conexion->query(($sql2));
if ($ejecutar_consulta) {
	header("Location: ../traslados.php?error=no");
} else {
	header("Localtion: ../traslados.php?error=si");
}
?>
