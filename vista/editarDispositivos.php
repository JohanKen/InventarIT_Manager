<?php

// Obtener e   l ID del dispositivo de la URL
$id = $_GET['id_dispositivo'];

// Obtener datos del dispositivo según el ID
$datosDispositivo = obtenerDatosDispositivo($id);

function obtenerDatosDispositivo($id) {
    // Aquí consultamos la información del dispositivo desde la BD con su ID
    $DispositivoInfo = ControladorDispositivos::detalleDispositivo($id);

    // Verificar si se obtuvieron datos
    if (!$DispositivoInfo || empty($DispositivoInfo[0])) {
        echo "Error: No se pudieron obtener los datos del dispositivo.";
        return null;
    }

    // Aquí solo devolvemos los datos
    return $DispositivoInfo[0];
}

// Verificar el tipo de dispositivo y cargar el formulario correspondiente
if ($datosDispositivo !== null) {
    switch ($datosDispositivo[1]) {
        case 'Laptop':
            include('formularios/formularioLaptop.php');
            break;
        case 'Descktop':
            include('formularios/formularioDesktop.php');
            break;
        case 'iMac':
            include('formularios/formularioImac.php');
            break;
        case 'Teclado':
            include('formularios/formularioTeclado.php');
            break;
        case 'Mouse':
            include('formularios/formularioMouse.php');
            break;
        case 'Monitor':
            include('formularios/formularioMonitor.php');
            break;
        case 'Headset':
            include('formularios/formularioHeadset.php');
            break;
        case 'Celular':
            include('formularios/formularioCelular.php');
            break;
        case 'Switches':
            include('formularios/formularioSwitches.php');
            break;
        case 'Impresora':
            include('formularios/formularioImpresora.php');
            break;
        case 'otro':
            include('formularios/formularioOtro.php');
            break;
        case 'Herramienta':
            include('formularios/formularioHerramienta.php');
            break;
        case 'cctv':
            include('formularios/formularioCctv.php');
            break;
        default:
            // Tipo desconocido
            echo "Tipo de dispositivo desconocido.";
    }
} else {
    // Mostrar un mensaje de error
    echo "Error al obtener los datos del dispositivo.";
}
?>
