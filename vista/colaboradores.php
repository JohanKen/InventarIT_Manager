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

        <a href="index.php?seccion=nuevoColaborador" ><button class="custom-button" onclick="nuevoColaborador();">AGREGAR NUEVO COLANORADOR</button></a>

        <div>
            <label for="cliente">Filtrar por Cliente</label>
            <select name="cliente" id="cliente" onchange="cargarVistasColaboradores()">
                <option value="0">Todos</option>
                <option value="1">RTS</option>
                <option value="2">Saela</option>
                <option value="3">Nutiliti</option>
                <option value="4">Ranger Design</option>
                <option value="5">Mega Fleet Corp</option>
                <option value="6">Pro Movers</option>
                <option value="7">Union Supply Group</option>
                <option value="8">Intouch</option>
            </select>
        </div>

        <div class="tabla">
            <table class="tabla" id="colaboradores">
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
                                    <a href="javascript:void(0);" onclick="confirmarBorrar(' . $item[0] . '); "id="enlaceBorrar" >Borrar</a>
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
                window.location.href = "index.php?seccion=colaboradores&accion=eliminarColaborador&id_colaborador=" + id_colaborador;
            };
        }

        function cerrarModal() {
            document.getElementById('confirmarBorrarModal').style.display = 'none';
        }

        function eliminarDispositivo() {
            cerrarModal();
        }
    </script>

    <script>
        function cargarVistasColaboradores() {
            var clienteSeleccionado = document.getElementById("cliente").value;
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    console.log("Respuesta del servidor:", xhr.status, xhr.statusText);
                    if (xhr.status === 200) {
                        // Procesa la respuesta del servidor
                        console.log("Contenido de la respuesta:", xhr.responseText);
                        // Cambia el contenido de la tabla con el nuevo HTML recibido
                        document.getElementById("colaboradores").innerHTML = xhr.responseText;
                    } else {
                            console.error("Error en la respuesta del servidor");
                    }
                }
            };

            var url = "controlador/ControladorFiltros/ColaboradoresPorCliente.php?cliente=" + clienteSeleccionado;
            xhr.open("GET", url, true);
            console.log("Solicitud AJAX enviada a: " + url);
            xhr.send();
        }
    </script>

</body>
</html>