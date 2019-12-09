<?php
require('./fpdf/fpdf.php');
require('../config/conexion.php');

//$id_personal = $_POST["id_personal"];
$f_desde = $_POST["f_desde"];
$f_hasta = $_POST["f_hasta"];
$sql = "SELECT CONCAT(p.nombres,' ',p.apellidos) as nombre, i.f_desde, i.f_hasta, DATEDIFF(i.f_hasta,i.f_desde) dias FROM `permisos` as i, personal p WHERE i.id_personal=p.codigo AND i.f_desde BETWEEN '$f_desde' AND '$f_hasta' ORDER BY p.id_area";
$resultado = $conexion->query($sql);

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
        $this->Cell(0,0, 'Reporte de Permisos de Personal',0,1,'C');
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
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFillColor(232,232,232);
$pdf->SetX(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(15,6,'N',1,0,'C',1);
$pdf->Cell(100,6,'Nombre',1,0,'C',1);
$pdf->Cell(25,6,'Desde',1,0,'C',1);
$pdf->Cell(25,6,'Hasta',1,0,'C',1);
$pdf->Cell(20,6,'Dias',1,1,'C',1);


$pdf->SetFont('Arial','',10);
$cont = 1;
while($row = $resultado->fetch_assoc())
{
    $pdf->SetX(10);
    $pdf->Cell(15,6,$cont,1,0,'C');
    $pdf->Cell(100,6,utf8_decode($row['nombre']),1,0,'C');
    $pdf->Cell(25,6,date("d-m-Y", strtotime(utf8_decode($row['f_desde']))),1,0,'C');
    $pdf->Cell(25,6,date("d-m-Y", strtotime(utf8_decode($row['f_hasta']))),1,0,'C');
    $pdf->Cell(20,6,utf8_decode($row['dias']),1,1,'C');
    $cont++;
}

$pdf->Output();
