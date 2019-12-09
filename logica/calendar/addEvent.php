<?php

// Connexion à la base de données
include("../../config/conexion.php");

	
	$title = $_POST['title'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];

	$sql = "INSERT INTO events(title, start, end, color) values ('$title', '$start', '$end', '$color')";
	$ejecutar_consulta = $conexion->query(($sql));
	if ($ejecutar_consulta) {
		header("Location: ../../dashboard.php?error=no");
	} else {
		header("Localtion: ../../dashboard.php?error=si");
	}

?>
