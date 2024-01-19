

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
            left: 0;            
            width: 100%;
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
        <div class="tabla">
            <table class="tabla">
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
                                <td>$' . number_format($item[5], 2, ',', '.') . '</td>
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

        function eliminarDispositivo() {
            cerrarModal();
        }
    </script>
</body>

</html>
