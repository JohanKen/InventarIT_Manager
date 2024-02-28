<?php 
    error_reporting(E_ALL);
    ini_set('display_errors',1);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dispositivos</title>
    <link rel="stylesheet" href="estilos/estilosDispositivos.css">
    <style>
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: linear-gradient(0deg, rgba(0,22,249,0.24413515406162467) 14%, rgba(0,151,249,0.7819502801120448) 100%);            padding: 20px;
            border-radius: 10px;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            color: #fff;
        }

        .modal-content h4 {
            margin-bottom: 15px;
        }

        .modal-content p {
            margin-bottom: 20px;
        }

        .close-modal {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            color: #fff;
            font-size: 20px;
        }

        .btn-danger,
        .btn-secondary {
            padding: 10px 20px;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        .btn-danger {
            background: #ff6347;
            color: #fff;
        }

        .btn-secondary {
            background: #4169e1;
            color: #fff;
        }v

        .btn-danger:hover,
        .btn-secondary:hover {
            background: #d32f2f;
        }
    </style>
</head>

<body>
    <div class="contentSeccion">
        <div class="up">
            <header class="headerTabla">
                <h1>Dispositivos</h1>
                <form class="form-inline" id="searchBar">
                    <div class="input-group">
                        <!-- Agrega aquí elementos de búsqueda si es necesario -->
                    </div>
                </form>
            </header>
            <img src="./images/lap.png" id="IMGlaptop" alt="IMAGEN">
        </div>

        <a href="index.php?seccion=nuevoDispositivo"><button class="custom-button" onclick="nuevoDispositivo();">AGREGAR NUEVO DISPOSITIVO</button></a>
        <br><br>
        <div class="mb-3" id="formForm">
            <label for="tipo_dispositivo" class="form-label">Filtrar por Tipo: </label>
            <select name="tipo_dispositivo" class="form-control" id="tipo_dispositivo" onchange="cargarDispositivos()">
                <option value="100">Todos</option>
                <option value="1">Laptop</option>
                <option value="2">Desktop</option>
                <option value="3">iMac</option>
                <option value="4">Teclado</option>
                <option value="5">Mouse</option>
                <option value="6">Monitor</option>
                <option value="7">Headset</option>
                <option value="8">Celular</option>
                <option value="9">Switches</option>
                <option value="12">Otro</option>
            </select>
        </div>

        <div class="tabla">
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
                </thead>
                <tbody>
                    <?php
                    
                    $eliminar = new ControladorDispositivos;
                    $eliminar->borrarDispositivos();

                    $lista = ControladorDispositivos::consultaDispositivos();
                    foreach ($lista as $row => $item) {
                        
                        echo '
                            <tr>
                                <td>' . $item[0] . '</td>
                                <td>' . $item[1] . '</td>
                                <td>' . $item[2] . '</td>
                                <td>' . $item[3] . '</td>
                                <td>' . $item[4] . '</td>
                                <td>$' . number_format($item[5], 2, '.', ',') . '</td>
                                <td>' . $item[6] . '</td>
                                <td>' . $item[7] . '</td>
                                <td>' . $item[8] . '</td>
                                <td><img src="' . $item[9] . '" alt="" height="50"></td>
                                <td>
                                    <a href="index.php?seccion=editarDispositivos&id_dispositivo=' . $item[0] . '">Editar</a>
                                    <a href="javascript:void(0);" onclick="confirmarBorrar(' . $item[0] . ');">Borrar</a>
                                </td>
                            </tr>
                        ';
                    }
                    
                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal" id="confirmarBorrarModal">
        <div class="modal-content">
            <span class="close-modal" onclick="cerrarModal()">&times;</span>
            <h4>Confirmar Eliminación</h4>
            <p>¿Estás seguro de que deseas eliminar este dispositivo?</p>
            <button class="btn-danger" id="btnBorrarModal">Borrar</button>
            <button class="btn-secondary" onclick="cerrarModal()">Cancelar</button>
        </div>
    </div>
    

    <script>
        function confirmarBorrar(id_dispositivo) {
            document.getElementById('confirmarBorrarModal').style.display = 'flex';
            document.getElementById('btnBorrarModal').onclick = function () {
                window.location.href = "index.php?seccion=dispositivos&accion=eliminarDispositivos&id_dispositivo=" + id_dispositivo;
            };
        }

        function cerrarModal() {
            document.getElementById('confirmarBorrarModal').style.display = 'none';
        }

        function eliminarColaborador() {
            cerrarModal();
        }
        
    </script>

    <script>
        //cargarDispositivos();

        function cargarDispositivos() {
            console.log("La función cargarDispositivos se está ejecutando");
            var tipoSeleccionado = document.getElementById("tipo_dispositivo").value;
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    console.log("Respuesta del servidor:", xhr.status, xhr.statusText);
                    if (xhr.status === 200) {
                        console.log("Contenido de la respuesta:", xhr.responseText);
                        document.getElementById("inventario_dispositivos").innerHTML = xhr.responseText;
                    } else {
                        console.error("Error en la respuesta del servidor");
                    }
                }
            };

            var url = "controlador/ControladorFiltros/inventarioPorTipo.php?tipo="+ tipoSeleccionado;
            xhr.open("GET", url, true);
            console.log("Solicitud AJAX enviada a: " + url);
            xhr.send();
        }
    </script>

</body>

</html>
