<?php
ob_start();
include("../config/conexion.php");

$user_txt = ($_POST["codigo"]);
$fecha = ($_POST["fecha"]);
$entrada_t1 = ($_POST["entrada_t1"]);
$salida_t1 = ($_POST["salida_t1"]);
$sql= '';
foreach ($user_txt as $key) {
	$sql="INSERT INTO `asistencia` VALUES (NULL, '$key','$fecha', '$entrada_t1', '$salida_t1',NULL,NULL);";
	echo ($sql."<br>");
	$exe_actualizada= $conexion->query(($sql));
}
if ($sql) {
	header("Location: ../registrar_jorn.php?error=no");
}else{
	header("Location: ../registrar_jorn.php?error=si");
}



// $consulta = "SELECT * FROM `asistencia` WHERE id_personal='$user_txt' AND fecha='$fecha'";
// $ejecutar_consulta = $conexion->query($consulta);
// $num_regs = $ejecutar_consulta->fetch_row();

// $user = "SELECT codigo FROM `personal` WHERE codigo='$user_txt'";
// $ejecutar_user = $conexion->query($user);
// $num_regs_user = $ejecutar_user->fetch_row();
// $actualizar='';

// if ($num_regs_user[0]!==null) {
// 	if($num_regs==null){
// 		$actualizar = "INSERT INTO `asistencia` VALUES (NULL, '$user_txt','$fecha', '$entrada_t1', '$salida_t1',NULL,NULL)";
// 		print ($actualizar);
// 		$exe_actualizada= $conexion->query(($actualizar));
// 		header("Location: ../registrar_jorn.php?error=no");
// 	}
// 	else{
// 		header("Location: ../registrar_jorn.php?error=si");
// 	}
// } else {
// 	header("Location: ../registrar_jorn.php?error=no_code");
// }


?>
