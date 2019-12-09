<?php

// Connexion à la base de données
include("../../config/conexion.php");

if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])){
	
	
	$id = $_POST['Event'][0];
	$start = $_POST['Event'][1];
	$end = $_POST['Event'][2];

	$sql = "UPDATE events SET  start = '$start', end = '$end' WHERE id = $id ";

	$ejecutar_consulta = $conexion->query(($sql));
	if ($ejecutar_consulta) {
		header("Location: ../../dashboard.php?error=no");
	} else {
		header("Localtion: ../../dashboard.php?error=si");
	}
}
//header('Location: '.$_SERVER['HTTP_REFERER']);

	
?>
