<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilosColaboradores.css">
    <title>Colaboraodres</title>
    <style>
       
    </style>
</head>
    
<body>
<div class="contentSeccion">
        <div class="up">
            <header class="headerTabla">
                <h1>Colaboradores</h1>
                <form class="form-inline" id="searchBar">
                    <div class="input-group">
                        
                    </div>
                </form>
            </header>
        </div>

    <div class="tabla">
        <table class="tabla">
            <thead class ="thead-dark">
                <tr>
                    <th>Id Colaborador</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Cliente</th>
                    <th>Departamento</th>
                    <th>Estado</th>
                    <th>Fecha de Ingreso</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $eliminarCol = new ControladorColaboradores;
                    $eliminarCol -> borrarColaboradores();

                    $listaColaboradores = ControladorColaboradores::consultarColaboradores();
                    foreach ($listaColaboradores as $item){
                        echo'
                            <tr>
                                <td>'.$item[0].'</td>
                                <td>'.$item[1].'</td>
                                <td>'.$item[2].'</td>
                                <td>'.$item[3].'</td>
                                <td>'.$item[4].'</td>
                                <td>'.$item[5].'</td>
                                <td>'.$item[6].'</td>
                                <td>
                                <a href="index.php?seccion=editarColaborador&id_colaborador=' . $item[0] . '">Editar</a>
                                <a href="javascript:void(0);" onclick="confirmarBorrar(' . $item[0] . ');">Borrar</a>
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
                <p>¿Estás seguro de que deseas eliminar al colaborador?</p>
                <button class="btn-danger" id="btnBorrarModal">Eliminar</button>
                <button class="btn-secondary" onclick="cerrarModal()">Cancelar</button>
            </div>
        </div>

        <script>
        function confirmarBorrar(id_colaborador) {
            document.getElementById('confirmarBorrarModal').style.display = 'flex';
            document.getElementById('btnBorrarModal').onclick = function () {
                window.location.href = "index.php?seccion=dispositivos&accion=eliminarColaborador&id_colaborador=" + id_colaborador;
            };
        }

        function cerrarModal() {
            document.getElementById('confirmarBorrarModal').style.display = 'none';
        }

        function eliminarDispositivo() {
            cerrarModal();
        }
    </script>

</body>
</html>