<?php
require('../../fpdf/fpdf.php');

$dispositivosSeleccionados = isset($_GET['dispositivos']) ? json_decode(urldecode($_GET['dispositivos']), true) : [];

class PDF extends FPDF{

    function Header(){
        
        $this->Image('../../images/logoRemote.png', 1, 2, 65);

        $this->SetFont('Arial','B',13);
        $this->Cell(70);
        // Título
        $this->Cell(60,13,'CARTA DE RESGUARDO',0,0,'C');
        // Salto de línea
        $this->Ln(20);
    }

    function Footer(){
        
        $this->SetXY(30,50);
        $this->Image('../../images/logoRemote.png',1,252,65);
        
        $this->SetTextColor(7,7,255);
        $this->SetFont('Arial', 'u', 16);
        
        $this->SetXY(70,255);
        $this->Cell(85,10,utf8_decode('www.RemoteTeamSolutions.com'),0,0,'C');
        
        
        $this->SetTextColor(85,127,201);
        $this->SetFont('Arial', '', 10);

        $this->SetXY(170,252);
        $this->Cell(18,5,utf8_decode('Toll Free:'),0,0,'C');

        $this->SetXY(170,257);
        $this->cell(25,5,utf8_decode('(800)449-0189'),0,0,'C');
        
        $this->SetXY(170,264);
        $this->cell(30,5,utf8_decode('Rest of the World:'),0,0,'C');
        
        $this->SetXY(170,269);
        $this->cell(28,5,utf8_decode('+1 880 449-0189'),0,0,'C');
    }
}



    $pdf = new PDF('P','mm','Letter');
    $pdf->AddPage();
    $pdf->AddFont('calibri-bold','',"calibri-bold.php");
    $pdf->SetFont('calibri-bold','', 16);
    $pdf->Cell(40, 30, utf8_decode('Imaginate la cara de responsiva'),1,0,'C',0);

    $pdf->Output();

?>
