<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

include_once __DIR__ . '/../../modelo/ModeloColaboradores.php';

$buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';

if(!empty($buscar)){
    $Colaboradores = ModeloColaboradores::buscarColaborador($buscar);

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Resultados de la busqueda</title>
        <link rel="stylesheet" href="estilos/estilosColaboradores.css">
        <style>
     .imagen-editar {
            cursor: pointer;
        }

        .acciones {
            display: flex;
        }
        
        .acciones img {
            max-width: 40px;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .acciones img:hover {
            transform: scale(1.2);
        }
</style>
    </head>
    <body>
    <table class="table table-secondary table-straped table-hover" id="colaboradores">
    <thead class="table-dark">
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
                            <div class="acciones">

                            <td>
                                <a href="index.php?seccion=editarColaborador&id_colaborador=' . $item['id_colaborador'] .'"><img src="images/editColab.png" alt="Editar" style="max-width:40px;" class="imagen-editar"></a>
                                <a href="javascript:void(0);" onclick="confirmarBorrar(' . $item['id_colaborador'] . '); "id="enlaceBorrar" ><img src="images/basura.png" alt="Borrar" style="max-width:40px; cursor:pointer;" ></a>
                            </td>
                            </div> 
                        </tr>
                    ';
                }
            ?>
        </tbody>
    </table>
    </body>
    </html>
    
<?php
    }else{
        echo"<script>
            window.location.reload(true);
        </script>";
        exit;
    }
?>