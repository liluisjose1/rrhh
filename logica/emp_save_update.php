<?php
ob_start();
include("../config/conexion.php");

$id = $_POST["id"];
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



$consulta = "UPDATE `personal` SET `dui`='$dui',`nit`='$nit',`nombres`='$nombres',`apellidos`='$apellidos',`genero`='$genero',`fecha_nacimiento`='$fecha_nacimiento',`fecha_ingreso`='$fecha_ingreso',`direccion`='$direccion',`id_area`='$id_area',`id_sucursal`='$id_sucursal' WHERE `id`='$id'";
$ejecutar_consulta = $conexion->query(($consulta));
print($consulta);
if ($ejecutar_consulta) {
	header("Location: ../emp.php?error=no");
} else {
	header("Localtion: ../emp.php?error=si");
}
