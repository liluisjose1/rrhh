<?php

include("../../config/conexion.php");
if (isset($_POST['delete']) && isset($_POST['id'])){
	
	
	$id = $_POST['id'];
	
	$sql = "DELETE FROM events WHERE id = $id";
	$ejecutar_consulta = $conexion->query(($sql));
	if ($ejecutar_consulta) {
		header("Location: ../../dashboard.php?error=no");
	} else {
		header("Localtion: ../../dashboard.php?error=si");
	}
	
}elseif (isset($_POST['title']) && isset($_POST['color']) && isset($_POST['id'])){
	
	$id = $_POST['id'];
	$title = $_POST['title'];
	$color = $_POST['color'];
	
	$sql = "UPDATE events SET  title = '$title', color = '$color' WHERE id = $id ";

	$ejecutar_consulta = $conexion->query(($sql));
	if ($ejecutar_consulta) {
		header("Location: ../../dashboard.php?error=no");
	} else {
		header("Localtion: ../../dashboard.php?error=si");
	}

}
	
?>
