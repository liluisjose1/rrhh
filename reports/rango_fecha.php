<?php
require('./fpdf/fpdf.php');
require('../config/conexion.php');

$f_desde = $_POST["f_desde"];
$f_hasta = $_POST["f_hasta"];
$sql = "SELECT ar.nombre as area,CONCAT(p.nombres,' ',p.apellidos) AS nombre,a.fecha,SEC_TO_TIME(SUM(TIME_TO_SEC(a.h_extras))) as h_extras,SEC_TO_TIME(SUM(TIME_TO_SEC(a.total))) as total FROM `asistencia` as a, areas as ar, personal as p WHERE fecha BETWEEN '$f_desde' AND '$f_hasta' AND p.id_area=ar.id_area AND a.id_personal=p.codigo GROUP BY a.id_personal ORDER BY ar.id_area";
$resultado = $conexion->query($sql);

//print($sql);
class PDF extends FPDF
{
    function Header()
    {
        setlocale(LC_ALL,"es_SV");
        $f_desde = date("d/m/Y", strtotime($_POST["f_desde"]));
        $f_hasta = date("d/m/Y", strtotime($_POST["f_hasta"]));
        $this->Image('../assets/assets/img/icon2.png', 5, 5, 30 );
        $this->SetFont('Arial','B',15);
        $this->Cell(0,0, 'ACOGUADALUPANA DE R. L.',0,1,'C');
        $this->SetFont('Arial','B',8);
        $this->Ln(5);
        $this->SetFont('Arial','B',14);
        $this->Cell(0,0, 'Reporte de Asistencia de Personal',0,1,'C');
        $this->Ln(5);
        $this->SetFont('Arial','',12);
        $this->Cell(0,0, "Desde $f_desde Hasta $f_hasta",0,1,'C');
        $this->Ln(15);
    }
    
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I', 8);
        $this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
    }		
}

// $pdf = new PDF('L','mm','A4');
$pdf = new PDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFillColor(232,232,232);
$pdf->SetX(20);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(55,6,'Cargo',1,0,'C',1);
$pdf->Cell(150,6,'Nombre',1,0,'C',1);
$pdf->Cell(27,6,'Horas Extra',1,0,'C',1);
$pdf->Cell(25,6,'Total Horas',1,1,'C',1);


$pdf->SetFont('Arial','',10);
while($row = $resultado->fetch_assoc())
{
    $pdf->SetX(20);
    $pdf->Cell(55,6,utf8_decode($row['area']),1,0,'C');
    $pdf->Cell(150,6,utf8_decode($row['nombre']),1,0,'C');
    $pdf->Cell(27,6,utf8_decode($row['h_extras']),1,0,'C');
    $pdf->Cell(25,6,utf8_decode($row['total']),1,1,'C');
}

$pdf->Output();
?>