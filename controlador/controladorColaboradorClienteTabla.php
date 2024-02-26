<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once __DIR__ . '/../modelo/ModeloAsignaciones.php';
//include_once __DIR__ . '/../controlador/ControladorAsignaciones.php';

// Obtener el cliente seleccionado
$clienteSeleccionado = isset($_GET['cliente']) ? $_GET['cliente'] : '';
// Obtener colaboradores según el cliente seleccionado
    
$listaAsignaciones = ModeloAsignaciones::selectAsignacionesPorCliente($clienteSeleccionado);
    
?>
    <table class="tabla" id="asignaciones">
                <thead class="thead-dark">
                    <tr>
                        <! Separacion de encabezados para hecer sub encabezados >
                        <th colspan="1"></th>
                        <th colspan="5">Asignado a</th>
                        <th colspan="7">Dispositivo Asignado</th>
                        <th colspan="1"></th>
                    </tr>
                    <tr>
                        <th>ID Asignacion</th>
                        <th>ID Colaborador</th>
                        <th>Nombre Colaaborador</th>
                        <th>Apellido Colaborador</th>
                        <th>Cliente</th>
                        <th>Departamento</th>
                        <th>ID Dispositivo</th>
                        <th>Tipo</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Numero de serie</th>
                        <th>Precio</th>
                        <th>Fecha de asignacion</th>
                        <th>Opciones</th>
                    </tr>    
                <thead>
                <tbody>
                    <?php  
                        //$eliminar = new ControladorAsignaciones;
                        //$eliminar -> borrarAsignacion();

                        //$listaAsignaciones = ControladorAsignaciones::consultarAsignaciones();
                        //$listaAsignaciones = ModeloAsignaciones::selectAsignacionesPorCliente($clienteSeleccionado);
                        foreach($listaAsignaciones as $item){
                            echo '
                                <tr>
                                    <td>'.$item['id_asignacion'].'</td>
                                    <td>'.$item['id_colaborador'].'</td>
                                    <td>'.$item['nombre_colaborador'].'</td>
                                    <td>'.$item['apellido_paterno_colaborador'].'</td>
                                    <td>'.$item['nombre_empresa'].'</td>
                                    <td>'.$item['departamento'].'</td>
                                    <td>'.$item['id_dispositivo'].'</td>
                                    <td>'.$item['tipo'].'</td>
                                    <td>'.$item['marca'].'</td>
                                    <td>'.$item['modelo'].'</td>
                                    <td>'.$item['numero_serie'].'</td>
                                    <td>'.$item['precio'].'</td>
                                    <td>'.$item['fecha_asignacion'].'</td>
                                    <td>
                                    <a href="javascript:void(0);" onclick="confirmarBorrar('.$item['id_asignacion'].'); "id"="enlaceBorrar">Borrar</a>
                                    </td>
                                </tr>
                            ';
                        }
                    ?>
                </tbody>
            </table>
<?php

?>