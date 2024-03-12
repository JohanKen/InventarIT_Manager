<?php 
    require ('../../fpdf/fpdf.php');

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(40,10,utf8_decode('Imaginate la cara de responsiva'));
    $pdf->Output();
?>
