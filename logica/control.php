<?php
	include("../config/conexion.php");

	$usuario = $_POST["user_txt"];
	$password = $_POST["password"];
	$consulta = "SELECT usuario, nombre FROM usuario WHERE usuario='$usuario' AND password=SHA1('$password')";
	$ejecutar_consultau = $conexion->query($consulta);
	$user = mysqli_fetch_row($ejecutar_consultau);

	$ejecutar_consulta = $conexion->query($consulta);

	$regs = $ejecutar_consulta->num_rows;
	if ($user>=0){
		session_start();
		$_SESSION["autentificado"]=true;
		$_SESSION["usuario"]=$user[0];
		$_SESSION["nombre"]=$user[1];
		setcookie("sesion",$_SESSION["autentificado"],time()+3600,"/");
		header("Location: ../dashboard.php");
	}
	else
	{
		header("Location: ../index.php?error=si");
	}

?>