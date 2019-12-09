<?php
ob_start();
include("../config/conexion.php");

$dui = $_POST["dui"];
$nit = $_POST["nit"];
$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$genero = $_POST["genero"];
$fecha_nacimiento = $_POST["fecha_nacimiento"];
$direccion = $_POST["direccion"];
$fecha_ingreso = $_POST["fecha_ingreso"];
$id_sucursal = $_POST["id_sucursal"];
$id_area = $_POST["id_area"];
$estado = 1;
$fecha_creacion = Date("Y-m-d");

$consulta = "SELECT MAX(id) FROM personal";
$ejecutar_consulta = $conexion->query($consulta);
$num_regs = $ejecutar_consulta->fetch_row();

$codigo = $num_regs[0] + 1;


if (strlen($codigo) == 1) {
	$codigo = strtoupper(substr($nombres, 0, 1)) . strtoupper(substr($apellidos, 0, 1)) . '000' . $codigo;
} else if (strlen($codigo) == 2) {
	$codigo = strtoupper(substr($nombres, 0, 1)) . strtoupper(substr($apellidos, 0, 1)) . '00' . $codigo;
} else if (strlen($codigo) == 3) {
	$codigo = strtoupper(substr($nombres, 0, 1)) . strtoupper(substr($apellidos, 0, 1)) . '0' . $codigo;
}



$consulta = "INSERT INTO `personal` ( `codigo`, `dui`, `nit`, `nombres`, `apellidos`, `genero`, `fecha_nacimiento`, `fecha_ingreso`, `direccion`, `id_area`,`id_sucursal`, `estado`) VALUES ('$codigo','$dui','$nit','$nombres','$apellidos','$genero','$fecha_nacimiento','$fecha_ingreso','$direccion','$id_area','$id_sucursal','$estado')";
$ejecutar_consulta = $conexion->query(($consulta));
if ($ejecutar_consulta) {
	header("Location: ../emp.php?error=no");
} else {
	header("Localtion: ../emp.php?error=si");
}
