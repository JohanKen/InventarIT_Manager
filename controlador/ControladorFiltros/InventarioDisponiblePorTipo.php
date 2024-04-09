<?php 
    //este metodo es para la vista asignarPaso2.php que solo llamma los dispositivos disponibles 
    error_reporting(E_ALL);
    ini_set('display_errors',1);
    include_once __DIR__ . '/../../modelo/ModeloAsignaciones.php';

    $tipoSeleccionado = isset($_GET['tipo']) ? $_GET['tipo'] : '';
    $dispositivosOmitidos = isset($_GET['omitidos']) ? explode(',', $_GET['omitidos']) : [];;

    if(!empty($tipoSeleccionado)){
        
        $dispositivos  = ModeloAsignaciones::selectDispositivoTipo($tipoSeleccionado);
        
        ?>
        <table id="dispositivos2">
            <thead>
                <tr>
                    <th>Id Dispositivo</th>
                    <th>Tipo de dispositivo</th>
                    <th>Modelo</th>
                    <th>Número de Serie</th>
                    <th>Marca</th>
                    <?php
                    if($tipoSeleccionado == 1 or $tipoSeleccionado == 2 or $tipoSeleccionado == 3){
                        ?>
                            <th>Ram</th>
                            <th>Procesador</th>
                            <th>Sistema Operativo</th>
                        <?php
                        if($tipoSeleccionado == 3){
                           ?>
                                <th>Modelo Teclado</th>
                                <th>#NS Tecaldo</th>
                                <th>Modelo Mouse</th>
                                <th>#NS Mouse</th>
                           <?php
                        }
                    }
                    ?>
                    <th>Precio<th>
                    <th></th>
                </tr>
            </thead>
                <tbody>
                    <?php  
                    if ($tipoSeleccionado == 1 or $tipoSeleccionado == 2) {
                        foreach ($dispositivos as $item) {
                            // Verificar si el dispositivo actual no está en la lista de dispositivos omitidos
                            if (!in_array($item['id_dispositivo'], $dispositivosOmitidos)) {
                                echo '
                                    <tr id="fila_dispositivo_' . $item['id_dispositivo'] . '">
                                        <td>' . $item['id_dispositivo'] . '</td>
                                        <td>' . $item['tipo'] . '</td>
                                        <td>' . $item['modelo'] . '</td>
                                        <td>' . $item['numero_serie'] . '</td>
                                        <td>' . $item['marca'] . '</td>
                                        <td>' . $item['ram'].' GB'.'</td>
                                        <td>' . $item['procesador'].'</td>
                                        <td>' . $item['sistema_operativo'].'</td>
                                        <td>' . $item['precio'].'</td>
                                        <td><button type="button" onclick="agregarDesdeTabla(' . $item['id_dispositivo'] . ', \'' . $item['tipo'] . '\', \'' . $item['modelo'] . '\', \'' . $item['numero_serie'] . '\', \'' . $item['marca'] . '\', \'' . $item['precio'] . '\')">Agregar</button></td>
                                    </tr>
                                ';
                            }
                        }
                    }elseif($tipoSeleccionado >= 4 ){
                        foreach ($dispositivos as $item) {
                            if (!in_array($item['id_dispositivo'], $dispositivosOmitidos)) {
                                echo '
                                    <tr id="fila_dispositivo_' . $item['id_dispositivo'] . '">
                                        <td>' . $item['id_dispositivo'] . '</td>
                                        <td>' . $item['tipo'] . '</td>
                                        <td>' . $item['modelo'] . '</td>
                                        <td>' . $item['numero_serie'] . '</td>
                                        <td>' . $item['marca'] . '</td>
                                        <td>' . $item['precio'].'</td>
                                        <td><button type="button" onclick="agregarDesdeTabla(' . $item['id_dispositivo'] . ', \'' . $item['tipo'] . '\', \'' . $item['modelo'] . '\', \'' . $item['numero_serie'] . '\', \'' . $item['marca'] . '\', \'' . $item['precio'] . '\')">Agregar</button></td>

                                    </tr>
                                ';
                            }
                        }
                    }if($tipoSeleccionado == 3){
                        foreach ($dispositivos as $item) {
                            if (!in_array($item['id_dispositivo'], $dispositivosOmitidos)) {
                                echo '
                                    <tr id="fila_dispositivo_' . $item['id_dispositivo'] . '">
                                        <td>' . $item['id_dispositivo'] . '</td>
                                        <td>' . $item['tipo'] . '</td>
                                        <td>' . $item['modelo'] . '</td>
                                        <td>' . $item['numero_serie'] . '</td>
                                        <td>' . $item['marca'] . '</td>
                                        <td>' . $item['ram']. ' GB'.'</td>
                                        <td>' . $item['procesador'].'</td>
                                        <td>' . $item['sistema_operativo'].'</td>
                                        <td>' . $item['Keyboard_model'].'</td>
                                        <td>' . $item['keyboard_ns'].'</td>
                                        <td>' . $item['mouse_model'].'</td>
                                        <td>' . $item['mouse_ns'].'</td>
                                        <td>' . $item['precio'].'</td>
                                        <td><button type="button" onclick="agregarDesdeTabla(' . $item['id_dispositivo'] . ', \'' . $item['tipo'] . '\', \'' . $item['modelo'] . '\', \'' . $item['numero_serie'] . '\', \'' . $item['marca'] . '\', \'' . $item['precio'] . '\')">Agregar</button></td>
                                    </tr>
                                ';
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        <?php
    } else {
        echo 'Elige un tipo de dispositivo ';
    }

?>