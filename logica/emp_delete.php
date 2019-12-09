<?php 
ob_start();
include("../config/conexion.php");

$id = $_POST["id_emp"];

$sql = "DELETE FROM `personal` WHERE `id`='$id'";
		$ejecutar_consulta = $conexion->query(($sql));
		print($sql);
			if($ejecutar_consulta){
				header("Location: ../emp.php?error=no_d");
			}
			else{
				header("Localtion: ../emp.php?error=si");
			}

 ?>