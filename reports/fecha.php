<?php
require('./fpdf/fpdf.php');
require('../config/conexion.php');

$fecha = $_POST["f_desde"];
$sql = "SELECT ar.nombre as area,CONCAT(p.nombres,' ',p.apellidos) AS nombre,a.fecha,a.entrada_t1,a.salida_t1,a.h_extras,CONVERT(SUM(total),TIME) as total FROM `asistencia` as a, areas as ar, personal as p WHERE fecha='$fecha' AND p.id_area=ar.id_area AND a.id_personal=p.codigo GROUP BY a.id_personal ORDER BY ar.id_area";
$resultado = $conexion->query($sql);

//print($sql);
class PDF extends FPDF
{
    function Header()
    {
        setlocale(LC_TIME, "spanish");
        $fecha = $_POST["f_desde"];
        $this->Image('../assets/assets/img/icon2.png', 5, 5, 30 );
        $this->SetFont('Arial','B',15);
        $this->Cell(0,0, 'ACOGUADALUPANA DE R. L.',0,1,'C');
        $this->SetFont('Arial','B',8);
        $this->Ln(5);
        $this->SetFont('Arial','B',14);
        $this->Cell(0,0, 'Reporte de Asistencia de Personal',0,1,'C');
        $this->Ln(5);
        $this->SetFont('Arial','',12);
        $this->Cell(0,0, strftime('%A %d de %B de %Y', strtotime($fecha)),0,1,'C');
        $this->Ln(15);
    }
    
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I', 8);
        $this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
    }		
}

$pdf = new PDF('L','mm','A4');
//$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(55,6,'Cargo',1,0,'C',1);
$pdf->Cell(150,6,'Nombre',1,0,'C',1);
$pdf->Cell(17,6,'Entrada',1,0,'C',1);
$pdf->Cell(17,6,'Salida',1,0,'C',1);
$pdf->Cell(17,6,'Extra',1,0,'C',1);
$pdf->Cell(17,6,'Total',1,1,'C',1);


$pdf->SetFont('Arial','',10);

while($row = $resultado->fetch_assoc())
{
    $pdf->Cell(55,6,utf8_decode($row['area']),1,0,'C');
    $pdf->Cell(150,6,utf8_decode($row['nombre']),1,0,'C');
    $pdf->Cell(17,6,utf8_decode($row['entrada_t1']),1,0,'C');
    $pdf->Cell(17,6,utf8_decode($row['salida_t1']),1,0,'C');
    $pdf->Cell(17,6,utf8_decode($row['h_extras']),1,0,'C');
    $pdf->Cell(17,6,utf8_decode($row['total']),1,1,'C');
}

$pdf->Output();
?>