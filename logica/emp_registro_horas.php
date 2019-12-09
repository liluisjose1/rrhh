<?php
ob_start();
include("../config/conexion.php");

$user_txt = strtoupper($_POST["user_txt"]);
$hora = ($_POST["hora"]);


$consulta = "SELECT * FROM `asistencia` WHERE id_personal='$user_txt' AND fecha=CURDATE()";
$ejecutar_consulta = $conexion->query($consulta);
$num_regs = $ejecutar_consulta->fetch_row();


$user = "SELECT codigo,CONCAT(nombres,' ',apellidos) FROM `personal` WHERE codigo='$user_txt'";
$ejecutar_user = $conexion->query($user);
$num_regs_user = $ejecutar_user->fetch_row();

$name_personal= $num_regs_user[1];
$actualizar='';
if ($num_regs_user[0]!==null) {
	if($num_regs==null){
		$actualizar = "INSERT INTO `asistencia` VALUES (NULL, '$user_txt',CURDATE(), '$hora', '00:00:00', '00:00:00', '00:00:00')";
		$exe_actualizada= $conexion->query(($actualizar));
		echo json_encode(['status'=>1,'name'=>$name_personal]);
		//header("Location: ../registro.php?error=ej1&hora=$hora");
	}
	else if($num_regs[3]!='00:00:00' && $num_regs[4]=='00:00:00'){
		$actualizar = "UPDATE `asistencia` SET `salida_t1`='$hora' WHERE  id_personal='$user_txt' AND fecha=CURDATE()";
		$exe_actualizada= $conexion->query(($actualizar));
		echo json_encode(['status'=>2,'name'=>$name_personal]);
		//header("Location: ../registro.php?error=sj1&hora=$hora");
	}
	else{
		echo json_encode(['status'=>3,'name'=>$name_personal]);
		//header("Location: ../registro.php?error=all_j&hora=$hora");
	}
} else {
	echo json_encode(['status'=>4]);
	//header("Location: ../registro.php?error=no_code&hora=$hora");
}


?>