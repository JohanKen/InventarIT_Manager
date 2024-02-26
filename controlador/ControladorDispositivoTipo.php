<?php 
    error_reporting(E_ALL);
    ini_set('display_errors',1);
    include_once __DIR__ . '/../modelo/ModeloAsignaciones.php';

    $tipoSeleccionado = isset($_GET['tipo']) ? $_GET['tipo'] : '';

    if(!empty($tipoSeleccionado)){
        $dispositivos  = ModeloAsignaciones::selectDispositivoTipo($tipoSeleccionado);

        $options = "";
        foreach ($dispositivos as $item){
            $options .= '<option value="' . $item['id_dispositivo'] . '">' .
            $item['id_dispositivo'] . ' ' . $item['tipo'] . ' ' .$item['modelo']. ' '.$item['numero_serie'].' '.$item['marca'].'</option>';
        }
        
        echo $options;
    } else {
        echo 'Error: tipo no seleccionado. ';
    }

?>