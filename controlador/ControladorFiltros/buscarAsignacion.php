<?php 
error_reporting(E_ALL);
ini_set('display_errors',1);

include_once __DIR_ .'/../../modelo/ModeloAsignaciones.php';

$buscar = isset($_GET['buscar']) ? $_GET['buscar'] :'';

if(!empty($buscar)){
    $Asignaciones = ModeloAsignaciones::buscarAsignacion($buscar);

    ?>
    <table class="tabla" id="asignaciones">
        <thead class="thead-dark">
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
        </thead>
        <tbody>
            <?php 
                foreach($Asignaciones as $item){
                    echo '
                        <tr>
                            <td>'.$item['id_colaborador'].'</td>
                            <td>'.$item['nombre_colaborador'].'</td>
                            <td>'.$item['apellido_paterno_colaborador'].'</td>
                            <td>'.$item['empresa'].'</td>
                            <td>'.$item['departamento'].'</td>
                            <td>'.$item['id_dispositivo'].'</td>
                            <td>'.$item['tipo'].'</td>
                            <td>'.$item['marca'].'</td>
                            <td>'.$item['modelo'].'</td>
                            <td>'.$item['numero_serie'].'</td>
                            <td>$'.number_format($item['precio'], 2, '.', ',').'</td>
                            <td>'.$item['fecha_asignacion'].'</td>
                            <td>
                                <a href="javascript:void(0);" onclick="confirmarBorrar('.$item[0].'); "id"="enlaceBorrar">Borrar</a>
                            </td>
                        </tr>
                    ';
                }
            ?>
        </tbody>
    </table>

<?php
}
?>