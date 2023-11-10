<?php

// Obtener el ID del dispositivo de la URL
$id = $_GET['id_dispositivo'];

// Obtener datos del dispositivo según el ID
$datosDispositivo = obtenerDatosDispositivo($id);

function obtenerDatosDispositivo($id) {
    // Aquí consultamos la info del dispositivo desde la BD con su ID
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
// Verificar el tipo de dispositivo y cargar el formulario correspondiente
switch ($datosDispositivo[1]) {
    case 1:
        include('./formularios/formularioLaptop.php');
        break;
    case 2:
        include('./formularios/formularioDesktop.php');
        break;
    case 3:
        include('./formularios/formularioImac.php');
        break;
    case 4:
        include('./formularios/formularioTeclado.php');
        break;
    case 5:
        include('./formularios/formularioMouse.php');
        break;
    case 6:
        include('./formularios/formularioMonitor.php');
        break;
    case 7:
        include('C:\laragon\www\InventaritManager\vista\formularios\formularioHeadset.php');
        break;
    case 8:
        include('./formularios/formularioCelular.php');
        break;
    case 9:
        include('./formularios/formularioSwitches.php');
        break;
    case 10:
        include('./formularios/formularioImpresora.php');
        break;
    case 12:
        include('./formularios/formularioOtro.php');
        break;
    case 13:
        include('./formularios/formularioHerramienta.php');
        break;
    case 14:
        include('./formularios/formularioCctv.php');
        break;
    default:
        // Tipo desconocido
        echo "Tipo de dispositivo desconocido.";
    }
} else {
    // Mostrar un mensaje de error
    echo "Error al obtener los datos del dispositivo.";
};
?>
