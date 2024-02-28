<?php 
    //este metodo es para filtar los dispoditivos por tipo en la viasta dispositivos.phps
    error_reporting(E_ALL);
    ini_set('display_errors',1);
    include_once __DIR__ . '/../../modelo/ModeloDispositivos.php';

    $tipoSeleccionado = isset($_GET['tipo']) ? $_GET['tipo'] : '';

    if(!empty($tipoSeleccionado)){
        $dispositivos  = ModeloDispositivos::selectDispositivoTipo($tipoSeleccionado);
        
        ?>
         <table class="tabla" id="inventario_dispositivos">
            <thead class="thead-dark">
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
                    <th>Precio</th>
                    <th>Estado del Dispositivo</th>
                    <th>Fecha de Compra</th>
                    <th>Notas</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
            
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
                                    <td>$' . number_format($item['precio'], 2, '.', ',') . '</td>
                                    <td>' . $item['estado']. '</td>
                                    <td>' . $item['fecha_compra']. '</td>
                                    <td>' . $item['nota']. '</td>
                                    <td>' . $item['imagen'] .'</td>
                                    <td>
                                        <a href="index.php?seccion=editarDispositivos&id_dispositivo=' . $item['id_dispositivo'] . '">Editar</a>
                                        <a href="javascript:void(0);" onclick="confirmarBorrar(' . $item['id_dispositivo'] . ');">Borrar</a>
                                    </td>

                                </tr>
                            ';
                        }
                    }elseif($tipoSeleccionado >= 4 or $tipoSeleccionado == 100){
                        foreach ($dispositivos as $item) {
                            
                            echo '
                                <tr>
                                    <td>' . $item['id_dispositivo'] . '</td>
                                    <td>' . $item['tipo'] . '</td>
                                    <td>' . $item['modelo'] . '</td>
                                    <td>' . $item['numero_serie'] . '</td>
                                    <td>' . $item['marca'] . '</td>
                                    <td>$' . number_format($item['precio'], 2, '.', ',') . '</td>
                                    <td>' . $item['estado']. '</td>
                                    <td>' . $item['fecha_compra']. '</td>
                                    <td>' . $item['nota']. '</td>
                                    <td>' . $item['imagen'] .'</td>
                                    <td>
                                        <a href="index.php?seccion=editarDispositivos&id_dispositivo=' . $item['id_dispositivo'] . '">Editar</a>
                                        <a href="javascript:void(0);" onclick="confirmarBorrar(' . $item['id_dispositivo'] . ');">Borrar</a>
                                    </td>
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
                                    <td>' . $item['ram'].' GB'.'</td>
                                    <td>' . $item['procesador'].'</td>
                                    <td>' . $item['sistema_operativo'].'</td>
                                    <td>' . $item['Keyboard_model'].'</td>
                                    <td>' . $item['keyboard_ns'].'</td>
                                    <td>' . $item['mouse_model'].'</td>
                                    <td>' . $item['mouse_ns'].'</td>
                                    <td>$' . number_format($item['precio'], 2, '.', ',') . '</td>
                                    <td>' . $item['estado']. '</td>
                                    <td>' . $item['fecha_compra']. '</td>
                                    <td>' . $item['nota']. '</td>
                                    <td>' . $item['imagen'] .'</td>
                                    <td>
                                        <a href="index.php?seccion=editarDispositivos&id_dispositivo=' . $item['id_dispositivo'] . '">Editar</a>
                                        <a href="javascript:void(0);" onclick="confirmarBorrar(' . $item['id_dispositivo'] . ');">Borrar</a>
                                    </td>

                                </tr>
                            ';
                        }
                    }
                    ?>
                </tbody>
            </table>
        <?php
    } else {
        echo $tipoSeleccionado;
    }

?>