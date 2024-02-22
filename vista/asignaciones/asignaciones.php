<?php
    include ("controlador/ControladorAsignaciones.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos/estilosColaboradores.css"><!se tien que quitar esta linea> 
</head>
<body>
    <div class="contentSeccion">
        <div class ="up">
            <header class="headerTabla">
                <h1>Asignaciones</h1>
            </header>
        </div>

        <a href="index.php?seccion=asignaciones/asignarPaso1"><button class="custom-button" onclick="newAsignacion();">CREAR NUEVA ASIGNACION</button></a>

        <div class="tabla">
            <table class="tabla">
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
                        $eliminar = new ControladorAsignaciones;
                        $eliminar -> borrarAsignacion();

                        $listaAsignaciones = ControladorAsignaciones::consultarAsignaciones();
                        foreach($listaAsignaciones as $item){
                            echo '
                                <tr>
                                    <td>'.$item[0].'</td>
                                    <td>'.$item[1].'</td>
                                    <td>'.$item[2].'</td>
                                    <td>'.$item[3].'</td>
                                    <td>'.$item[4].'</td>
                                    <td>'.$item[5].'</td>
                                    <td>'.$item[6].'</td>
                                    <td>'.$item[7].'</td>
                                    <td>'.$item[8].'</td>
                                    <td>'.$item[9].'</td>
                                    <td>'.$item[10].'</td>
                                    <td>'.$item[11].'</td>
                                    <td>'.$item[12].'</td>
                                    <td>
                                    <a href="javascript:void(0);" onclick="confirmarBorrar('.$item[0].'); "id"="enlaceBorrar">Borrar</a>
                                    </td>
                                </tr>
                            ';
                        }
                    ?>
                </tbody>
            </table>
        </div>

    <div class="modal" id="confirmarBorrarModal">
        <div class="modal-content">
            <span class="close-modal" onclick="cerrarModal()">&times;</span>
            <h4>Confirmar Eliminación</h4>
            <p>¿Estás seguro de que deseas eliminar la asignacion?</p>
            <button class="btn-danger" id="btnBorrarModal">Eliminar</button>
            <button class="btn-secondary" onclick="cerrarModal()">Cancelar</button>
        </div>
    </div>


    <script>
        function confirmarBorrar(id_asignacion) {
            document.getElementById('confirmarBorrarModal').style.display = 'flex';
            document.getElementById('btnBorrarModal').onclick = function () {
                window.location.href = "index.php?seccion=asignaciones/asignaciones&accion=eliminar&id_asignacion=" + id_asignacion;
            };
        }

        function cerrarModal() {
            document.getElementById('confirmarBorrarModal').style.display = 'none';
        }

        function eliminarDispositivo() {
            cerrarModal();
        }
    </script>

    </div>
</body>
</html>