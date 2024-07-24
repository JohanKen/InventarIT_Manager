<?php
//Metodo para la vista colaboradores.php en el que se cambia el contenido de la tabla dependiendo del cliente seleccionado 
error_reporting(E_ALL);
ini_set('display_errors',1);

include_once __DIR__ . '/../../modelo/ModeloColaboradores.php';

$clienteSeleccionado = isset($_GET['cliente']) ? $_GET['cliente'] : '';

$Colaboradores = ModeloColaboradores::selectColaboradoresPorCliente($clienteSeleccionado);

?>

<table class="tabla" id="colaboradores">
    <thead class="thead-dark">
        <tr>
            <th>ID Colaborador</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Cliente</th>
            <th>Depatamento</th>
            <th>Estado</th>
            <th>Fecha de Ingreso</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($Colaboradores as $item){
                echo '
                    <tr>
                        <td>' . $item['id_colaborador']. '</td>
                        <td>' . $item['nombre_colaborador']. '</td>
                        <td>' . $item['apellido_paterno_colaborador']. '</td>
                        <td>' . $item['empresa']. '</td>
                        <td>' . $item['departamento']. '</td>
                        <td>' . $item['estado']. '</td>
                        <td>' . $item['fecha_ingreso_colaborador']. '</td>
                        <td>
                            <a href="index.php?seccion=editarColaborador&id_colaborador=' . $item['id_colaborador'] . '">Editar</a>
                            <a href="javascript:void(0);" onclick="confirmarBorrar(' . $item['id_colaborador'] . '); "id="enlaceBorrar" >Borrar</a>
                        </td>
                    </tr>
                ';
            }
        ?>
    </tbody>
</table>