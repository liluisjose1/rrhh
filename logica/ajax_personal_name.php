<?php
ob_start();
include("../config/conexion.php");

$user_txt = strtoupper($_POST["user_txt"]);

$user = "SELECT CONCAT(nombres,' ',apellidos) FROM `personal` WHERE codigo='$user_txt'";
$ejecutar_user = $conexion->query($user);
$num_regs_user = $ejecutar_user->fetch_row();

$name_personal= $num_regs_user[0];
if ($name_personal!="") {
    echo json_encode(['name'=>$name_personal,"status"=>1]);

} else {
    echo json_encode(["status"=>2]);

}

?>