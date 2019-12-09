<?php
require('./fpdf/fpdf.php');
require('../config/conexion.php');

$id_personal = $_POST["id_personal"];
$f_desde = $_POST["f_desde"];
$f_hasta = $_POST["f_hasta"];
$sql = "SELECT s.nombre sucursal, CONCAT(p.nombres,' ',p.apellidos) as nombre, i.f_desde, i.f_hasta, DATEDIFF(i.f_hasta,i.f_desde) dias FROM `traslados` as i,sucursales s, personal p WHERE i.id_sucursal=s.id AND i.id_personal=p.codigo AND i.f_desde BETWEEN '$f_desde' AND '$f_hasta' AND i.id_personal='$id_personal' ORDER BY p.id_area";
$resultado = $conexion->query($sql);

//print($sql);
$sql1 = "SELECT CONCAT(p.nombres,' ',p.apellidos) AS nombre,a.nombre as area,SUM(DATEDIFF(i.f_hasta,i.f_desde)) total FROM traslados as i, personal as p, areas as a WHERE i.f_desde BETWEEN '$f_desde' AND '$f_hasta' AND i.id_personal = p.codigo AND p.id_area=a.id_area AND i.id_personal='$id_personal'";
$resultado1 = $conexion->query($sql1);
$array = $resultado1->fetch_row();
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
        $this->Cell(0,0, 'Reporte de Traslados de Personal',0,1,'C');
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
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0, utf8_decode($array[0]),0,1,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,0, utf8_decode($array[1]),0,1,'C');
$pdf->Ln(5);

$pdf->SetFillColor(232,232,232);
$pdf->SetX(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(10,6,'N',1,0,'C',1);
$pdf->Cell(85,6,'Nombre',1,0,'C',1);
$pdf->Cell(25,6,'Sucursal',1,0,'C',1);
$pdf->Cell(25,6,'Desde',1,0,'C',1);
$pdf->Cell(25,6,'Hasta',1,0,'C',1);
$pdf->Cell(20,6,'Dias',1,1,'C',1);


$pdf->SetFont('Arial','',10);
$cont = 1;
while($row = $resultado->fetch_assoc())
{
    $pdf->SetX(10);
    $pdf->Cell(10,6,$cont,1,0,'C');
    $pdf->Cell(85,6,utf8_decode($row['nombre']),1,0,'C');
    $pdf->Cell(25,6,utf8_decode($row['sucursal']),1,0,'C');
    $pdf->Cell(25,6,date("d-m-Y", strtotime(utf8_decode($row['f_desde']))),1,0,'C');
    $pdf->Cell(25,6,date("d-m-Y", strtotime(utf8_decode($row['f_hasta']))),1,0,'C');
    $pdf->Cell(20,6,utf8_decode($row['dias']),1,1,'C');
    $cont++;
}
$pdf->Cell(170,6,'Total',1,0,'R');
$pdf->Cell(20,6,utf8_decode($array[2]),1,1,'C',1);
$pdf->Output();
