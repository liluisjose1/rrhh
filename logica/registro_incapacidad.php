<?php
ob_start();
include("../config/conexion.php");

$id_personal = strtoupper($_POST["id_personal"]);
$f_desde = ($_POST["f_desde"]);
$f_hasta = ($_POST["f_hasta"]);


$consulta = "INSERT INTO `incapacidad` (`id`, `id_personal`, `f_desde`, `f_hasta`, `fecha_registro`) VALUES (NULL, '$id_personal', '$f_desde', '$f_hasta', current_timestamp());";
$ejecutar_consulta = $conexion->query(($consulta));
print($consulta);

$sqll = "SELECT CONCAT(nombres,' ',apellidos) as nombre FROM personal";
$ejecutarl = $conexion->query(($sqll));
$nombre = $ejecutarl->fetch_row();


$sql2 = "INSERT INTO `events` VALUES (NULL, 'INCAPACIDAD DE: $nombre[0]', '#20c997', '$f_desde', '$f_hasta' )";
$ejecutar2 = $conexion->query(($sql2));
if ($ejecutar_consulta) {
	header("Location: ../incapacidad.php?error=no");
} else {
	header("Localtion: ../incapacidad.php?error=si");
}
?>
