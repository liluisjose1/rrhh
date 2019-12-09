<?php
require('./fpdf/fpdf.php');
require('../config/conexion.php');

$id_personal = $_POST["id_personal"];
$f_desde = $_POST["f_desde"];
$f_hasta = $_POST["f_hasta"];
$sql = "SELECT a.fecha,a.entrada_t1,a.salida_t1,a.h_extras,a.total FROM `asistencia` as a, areas as ar, personal as p WHERE a.id_personal = '$id_personal' AND a.fecha BETWEEN '$f_desde' AND '$f_hasta'AND p.id_area=ar.id_area AND a.id_personal=p.codigo ORDER BY a.fecha ASC";
$resultado = $conexion->query($sql);

$sql1 = "SELECT CONCAT(p.nombres,' ',p.apellidos) AS nombre,ar.nombre as area,CONVERT(SUM(a.h_extras),TIME) as h_extras,SEC_TO_TIME(SUM(TIME_TO_SEC(a.total))) as total FROM `asistencia` as a, areas as ar, personal as p WHERE a.id_personal = '$id_personal' AND fecha BETWEEN '$f_desde' AND '$f_hasta' AND p.id_area=ar.id_area AND a.id_personal=p.codigo GROUP BY a.id_personal ORDER BY ar.id_area";
$resultado1 = $conexion->query($sql1);
//print($sql);
$array = $resultado1->fetch_row();
//print_r($array);
class PDF extends FPDF
{
    function Header()
    {
        setlocale(LC_TIME, "spanish");
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
        $this->Ln(10);
    }
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I', 8);
        $this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
    }
}

// $pdf = new PDF('L','mm','A4');
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0, utf8_decode($array[0]),0,1,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,0, utf8_decode($array[1]),0,1,'C');
$pdf->Ln(5);

$pdf->SetX(17);
$pdf->SetFont('Arial','B',14);
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(10,6,'N',1,0,'C',1);
$pdf->Cell(46,6,'Fecha',1,0,'C',1);
$pdf->Cell(30,6,'Entrada',1,0,'C',1);
$pdf->Cell(30,6,'Salida',1,0,'C',1);
$pdf->Cell(30,6,'Horas Extra',1,0,'C',1);
$pdf->Cell(30,6,'Total Horas',1,1,'C',1);


$pdf->SetFont('Arial','',10);
$cont=1;
while($row = $resultado->fetch_assoc())
{
    $pdf->SetX(17);
    $pdf->Cell(10,6,$cont,1,0,'C');
    $pdf->Cell(46,6,utf8_decode(date("d/m/Y", strtotime($row['fecha']))),1,0,'C');
    $pdf->Cell(30,6,utf8_decode($row['entrada_t1']),1,0,'C');
    $pdf->Cell(30,6,utf8_decode($row['salida_t1']),1,0,'C');
    $pdf->Cell(30,6,utf8_decode($row['h_extras']),1,0,'C');
    $pdf->Cell(30,6,utf8_decode($row['total']),1,1,'C');
    $cont++;
}
$pdf->SetX(17);
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(116,6,'Total',1,0,'R');
$pdf->Cell(30,6,utf8_decode($array[2]),1,0,'C',1);
$pdf->Cell(30,6,utf8_decode($array[3]),1,1,'C',1);

$pdf->Output();
