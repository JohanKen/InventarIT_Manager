<?php 
error_reporting(E_ALL);
ini_set('display_errors',1);

include_once '../../modelo/ModeloAsignaciones.php';

$buscar = isset($_GET['buscar']) ? $_GET['buscar'] :'';

if(!empty($buscar)){
    $Asignaciones = ModeloAsignaciones::buscarAsignacion($buscar);

    ?>
        <div class="container-fluid">
        <div class="table-responsive">
   <table class="table table-secondary table-straped table-hover" id="asignaciones">
   <thead class="table-dark">
            <tr>
                <th>ID Asignacion</th>
                <th>ID Colaborador</th>
                <th>Nombre Colaborador</th>
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
                
                //impresion de array como prueba para ver que es lo que se esta recibiendo desde la base de datos
                /*echo('<pre>');
                var_dump($Asignaciones);
                echo('</pre>');
*/
                foreach($Asignaciones as $item){
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
                            <td>$'.number_format($item['precio'], 2, '.', ',').'</td>
                            <td>'.$item['fecha_asignacion'].'</td>
                            <td>
                                    <img src="images/basura.png" alt="Borrar" style="max-width:40px; cursor:pointer;" onclick="confirmarBorrar('.$item['id_asignacion'].');">

                            </td>
                        </tr>
                    ';
                }
            ?>
        </tbody>
    </table>
    </div>
    </div>
    <script>
             function confirmarBorrar(id_asignacion) {
            Swal.fire({
                title: '¿Estas seguro?',
                text: "La asignación se elimiara completamente.",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "index.php?seccion=asignaciones/asignaciones&accion=eliminar&id_asignacion=" + id_asignacion;
             }});
             }
        </script>
<?php
}
?>

