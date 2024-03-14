<?php
require('../../fpdf/fpdf.php');

$dispositivosSeleccionados = isset($_GET['dispositivos']) ? json_decode(urldecode($_GET['dispositivos']), true) : [];

class PDF extends FPDF{

    //Encabezado de la paguina
    function Header(){
        
        //SE inserta de logo de RTS
        //IMPORTANTE: se carga la imagen de la carpeta image si no esta al archivo no se pondra
        $this->Image('../../images/logoRemote.png', 1, 2, 65);//se daclara el echivo a insertar con su posicion en x ,y y el tamaño

        $this->AddFont('calibri-bold','',"calibri-bold.php");
        $this->SetFont('calibri-bold','',13);
        $this->Cell(70);//espacion desde el anterior posicion
        // Título
        $this->Cell(60,13,'CARTA DE RESGUARDO',0,0,'C');
        
    }

    //Pie de paguina
    function Footer(){
        
        //Se inserta de logo de RTS el pie de pagina
        //IMPORTANTE: se carga la imagen de la carpeta image si no esta al archivo no se pondra
        //se utiliza el mismo archivo que en el encabezado
        $this->SetXY(30,50);//cambio de ubicacion
        $this->Image('../../images/logoRemote.png',1,252,65);;//se daclara el echivo a insertar con su posicion en x ,y y el tamaño
        
        //direccion url de la paguina de RTS
        //se Cambia el color del texto a un azul marino
        $this->SetTextColor(7,7,255);
        $this->SetFont('Arial', 'u', 16);
        $this->SetXY(70,255);//cambio de ubicacion
        $this->Cell(85,10,utf8_decode('www.RemoteTeamSolutions.com'),0,0,'C');
        
        //Camnia el color a un azul claro para las siguientes 4 textos con cell
        $this->SetTextColor(85,127,201);
        $this->SetFont('Arial', '', 10);

        $this->SetXY(170,252);//cambio de ubicacion
        $this->Cell(18,5,utf8_decode('Toll Free:'),0,0,'C');

        $this->SetXY(170,257);//cambio de ubicacion
        $this->cell(25,5,utf8_decode('(800)449-0189'),0,0,'C');
        
        $this->SetXY(170,264);//cambio de ubicacion
        $this->cell(30,5,utf8_decode('Rest of the World:'),0,0,'C');
        
        $this->SetXY(170,269);//cambio de ubicacion
        $this->cell(28,5,utf8_decode('+1 880 449-0189'),0,0,'C');
    }
}

function fechaActual(){
    //se crea un array donde se compara el numero de mes para imprimir el mismo mes en español
    $mes=[
        "01"=>"Enero",
        "02" =>"Febrero",
        "03" => "Marzo",
        "04" => "Abril",
        "05" => "Mayo",
        "06" => "Junio",
        "07" => "Julio",
        "08" => "Agosto",
        "09" => "Septiembre",
        "10" => "Octubre",
        "11" => "Noviembre",
        "12" => "Diciembre"
    ];

    //Se declara el formato de la fecha lo devuelve
    $fecha = date("d").' de '.$mes[date("m")].' de '.date("Y");
    return $fecha;
}

    $pdf = new PDF('P','mm','Letter');// se daclara el archivo en pdf junto al formato en carta 
    $pdf->AddPage();

    $pdf->AddFont('calibri-bold','',"calibri-bold.php");//se carga la fuente que se incluyo aparta de la libreris fpdf
    $pdf->SetFont('calibri-bold','', 11);
    
    $pdf->SetXY(117,32);//cambio de ubicacion
    //imprimir la fecha en que se hiso la asignacion
    $fechaActual = fechaActual();//se utiliza la fuincion de fechaActual()
    $pdf->SetTextColor(103,103,103);
    $pdf->Cell(80, 6, utf8_decode('Torreón, Coahuila, a '.$fechaActual),0,0,'R',0);//muestra la localidad y la fecha

    $pdf->SetXY(26,50.4);
    $pdf->SetTextColor(0,0,0);//Cambio de color de texto a negro
    $pdf->Cell(30,6.5,utf8_decode('EQUIPO'),1,0,'C',0);
    $pdf->Cell(55,6.5,utf8_decode('MARCA'),1,0,'C',0);
    $pdf->Cell(45,6.5,utf8_decode('TIPO/MODELO'),1,0,'C',0);
    $pdf->Cell(45,6.5,utf8_decode('NÚMERO DE SERIE'),1,1,'C',0);

    $pdf->SetFont('calibri-bold','', 9);
    $pdf->SetTextColor(103,103,103);
    foreach ($dispositivosSeleccionados as $dispositivo) {
        $pdf->setX(26);
        $pdf->Cell(30, 6.2, isset($dispositivo['tipo']) ? utf8_decode($dispositivo['tipo']) : '', 1, 0, "L", 0);
        $pdf->Cell(55, 6.2, isset($dispositivo['marca']) ? utf8_decode($dispositivo['marca']) : '', 1, 0, "L", 0);
        $pdf->Cell(45, 6.2, isset($dispositivo['modelo']) ? utf8_decode($dispositivo['modelo']) : '', 1, 0, "L", 0);
        $pdf->Cell(45, 6.2, isset($dispositivo['serie']) ? utf8_decode($dispositivo['serie']) : '', 1, 1, "L", 0);
    }
    
    $pdf->SetX(26);
    $pdf->SetFillColor(217,217,217);//Cambio de color del fondo a gris claro
    $pdf->SetTextColor(0,0,0);//Cambio de color de texto a negro
    $pdf->Cell(130,6,utf8_decode('COSTO DEL EQUIPO'),1,0,"R",1);
    $pdf->Cell(45,6,utf8_decode('$ aqui va el costo'),1,0,"L",1);

    $pdf->SetXY(26,109);
    $pdf->AddFont('calibri','',"calibri.php");
    $pdf->SetFont('calibri','', 11);
    //$pdf->Cell(175,57,utf8_decode(''),1,0,'c',0);
    $txt = file_get_contents('Responsiva.txt');
    $pdf->MultiCell(0,5,utf8_decode($txt));

    $pdf->Output();

?>
