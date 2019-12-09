<?php 
ob_start();
include("../config/conexion.php");

$id = $_POST["id_user"];

$sql = "DELETE FROM `usuario` WHERE `usuario`='$id'";
		$ejecutar_consulta = $conexion->query(($sql));
		print($sql);
			if($ejecutar_consulta){
				header("Location: ../usuarios.php?error=no_d");
			}
			else{
				header("Localtion: ../usuarios.php?error=si");
			}

 ?>