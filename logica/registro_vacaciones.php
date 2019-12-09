<?php
ob_start();
include("../config/conexion.php");

$id_personal = strtoupper($_POST["id_personal"]);
$id_sucursal = ($_POST["id_sucursal"]);
$f_desde = ($_POST["f_desde"]);
$f_hasta = ($_POST["f_hasta"]);


$consulta = "INSERT INTO `vacaciones` (`id`, `id_personal`, `id_sucursal`, `f_desde`, `f_hasta`, `fecha_registro`) VALUES (NULL, '$id_personal', '$id_sucursal', '$f_desde', '$f_hasta', current_timestamp())";
$ejecutar_consulta = $conexion->query(($consulta));
if ($ejecutar_consulta) {
	header("Location: ../vacaciones.php?error=no");
} else {
	header("Localtion: ../vacaciones.php?error=si");
}
?>
