<?php 
    error_reporting(E_ALL);
    ini_set('display_errors',1);
    include_once __DIR__ . '/../modelo/ModeloAsignaciones.php';

    $tipoSeleccionado = isset($_GET['tipo']) ? $_GET['tipo'] : '';

    if(!empty($tipoSeleccionado)){
        $dispositivos  = ModeloAsignaciones::selectDispositivoTipo($tipoSeleccionado);
        /*
        $options = "";
        foreach ($dispositivos as $item){
            $options .= '<option value="' . $item['id_dispositivo'] . '">' .
            $item['id_dispositivo'] . ' ' . $item['tipo'] . ' ' .$item['modelo']. ' '.$item['numero_serie'].' '.$item['marca'].'</option>';
        }
        */
        ?>
        <table id="dispositivos2">
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
                    <th>Opciones</th>
                </tr>
                <tbody>
                    <?php  
                    //$dispositivos = ControladorDispositivos::consultaDispositivos();

                    if($tipoSeleccionado == 1 or $tipoSeleccionado == 2){
                        foreach ($dispositivos as $item) {
                            
                            echo '
                                <tr>
                                    <td>' . $item['id_dispositivo'] . '</td>
                                    <td>' . $item['tipo'] . '</td>
                                    <td>' . $item['modelo'] . '</td>
                                    <td>' . $item['numero_serie'] . '</td>
                                    <td>' . $item['marca'] . '</td>
                                    <td>' . $item['ram'].' GB'.'</td>
                                    <td>' . $item['procesador'].'</td>
                                    <td>' . $item['sistema_operativo'].'</td>
                                </tr>
                            ';
                        }
                    }elseif($tipoSeleccionado >= 4 ){
                        foreach ($dispositivos as $item) {
                            
                            echo '
                                <tr>
                                    <td>' . $item['id_dispositivo'] . '</td>
                                    <td>' . $item['tipo'] . '</td>
                                    <td>' . $item['modelo'] . '</td>
                                    <td>' . $item['numero_serie'] . '</td>
                                    <td>' . $item['marca'] . '</td>
                                </tr>
                            ';
                        }
                    }else{
                        foreach ($dispositivos as $item) {
                            
                            echo '
                                <tr>
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
                                </tr>
                            ';
                        }
                    }
                    ?>
                </tbody>
            </table>
        <?php
    } else {
        echo 'Error: tipo no seleccionado. ';
    }

?>