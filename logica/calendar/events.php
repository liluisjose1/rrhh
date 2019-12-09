<?php

include("../../config/conexion.php");

$myArray = array();


$sql = "SELECT id, title, start, end, color FROM events ";
$result = $conexion->query($sql);

while($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $myArray[] = $row;
}
echo json_encode($myArray);
?>
