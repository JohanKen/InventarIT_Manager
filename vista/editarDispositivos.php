<?php

// Obtener el ID del dispositivo de la URL
$id = $_GET['id_dispositivo'];
$tipo = 4;


// Obtener datos del dispositivo según el ID
$datosDispositivo = obtenerDatosDispositivo($tipo);

function obtenerDatosDispositivo($tipo) {
    // Aquí consultamos la información del dispositivo desde la BD con su ID
    $DispositivoInfo = ControladorDispositivos::detalleDispositivo($tipo);

    // Verificar si se obtuvieron datos
    if (!$DispositivoInfo || empty($DispositivoInfo[0])) {
        echo "Error: No se pudieron obtener los datos del dispositivo.";
        return null;
    }

    // Aquí solo devolvemos los datos
    return $DispositivoInfo[0];
}

// Verificar el tipo de dispositivo y cargar el formulario correspondiente

//hay que imprimir que trae el arreglo $datosDispositivo del modelo...
if ($datosDispositivo !== null) {
    

    //debug de arreglo que esta llegando desde la vista para decidir por la clave a que formulario sera enviado...
    //echo "ARREGLO DE editarDispositivos datosDispositivo...";
    //echo "<br>";
    //echo "<pre>";
    //var_dump($datosDispositivo);
    //echo "</pre>";

    
   

      // Verificar si la clave 1 existe en el array
      if (array_key_exists('tipo', $datosDispositivo)) {
    switch ($datosDispositivo['tipo']) {
        case "Laptop":
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
}else {
        echo "Error: La clave 1 no está presente en el array.";
    }
} else {
    // Mostrar un mensaje de error
    echo "Error al obtener los datos del dispositivo.";
}
?>
