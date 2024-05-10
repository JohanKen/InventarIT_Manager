<?php 
    //este metodo es para filtar los dispoditivos por tipo en la viasta dispositivos.phps
    error_reporting(E_ALL);
    ini_set('display_errors',1);
    include_once __DIR__ . '/../../modelo/ModeloDispositivos.php';

    $buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';

    if(!empty($buscar)){
        $dispositivos  = ModeloDispositivos::buscarDispositivo($buscar);
        
        ?>
         <table class="tabla" id="inventario_dispositivos">
            <thead class="thead-dark">
                <tr>
                    <th>Id Dispositivo</th>
                    <th>Tipo de dispositivo</th>
                    <th>Modelo</th>
                    <th>Número de Serie</th>
                    <th>Marca</th>
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
                    ?>
                </tbody>
            </tabla> 
        <?php   
    } else {
        echo $tipoSeleccionado;
    }

?>