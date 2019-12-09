<?php
ob_start();
include("../config/conexion.php");

$id_personal = strtoupper($_POST["id_personal"]);
$f_desde = ($_POST["f_desde"]);
$f_hasta = ($_POST["f_hasta"]);


$consulta = "INSERT INTO `permisos` (`id`, `id_personal`, `f_desde`, `f_hasta`, `fecha_registro`) VALUES (NULL, '$id_personal', '$f_desde', '$f_hasta', current_timestamp());";
$ejecutar_consulta = $conexion->query(($consulta));

$sqll = "SELECT CONCAT(nombres,' ',apellidos) as nombre FROM personal";
$ejecutarl = $conexion->query(($sqll));
$nombre = $ejecutarl->fetch_row();


$sql2 = "INSERT INTO `events` VALUES (NULL, 'PERMISO DE: $nombre[0]', '#e83e8c', '$f_desde', '$f_hasta' )";
$ejecutar2 = $conexion->query(($sql2));
if ($ejecutar_consulta) {
	header("Location: ../permisos.php?error=no");
} else {
	header("Localtion: ../permisos.php?error=si");
}
?>
