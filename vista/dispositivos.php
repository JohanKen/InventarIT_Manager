<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dispositivos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="estilos/estilosDispositivos.css">
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
    <div class="contentSeccion">
        <div class="up">
            <header class="headerTabla">
                <h1 style="font-size: 28px; margin-top:20px; font-weight: bold; color: #003363; text-transform: uppercase; border-bottom: 2px solid #003363;">Dispositivos</h1>
               
            </header>
            <div class="col-md-12 text-center d-flex">
            <div class="input-group input-group-sm mt-3" id="divBuscar" style="max-width: 300px; margin: auto;">
                <input type="text" class="buscarForm" name="buscar" id="buscar" style="border-radius: none;">
                <span class="input-group-text" id="clearSearch" style="cursor: pointer; display: none; border-radius: none;">&times;</span>
                <button type="submit" class="custom-btn1 btn-4" onclick="buscarDispositivo()">Buscar</button>
            </div>







                <div class="input-group input-group-sm mt-3" style="max-width: 300px; margin: auto; display: block !important; display: flex; flex-direction: column; align-items: flex-end;">
                    <img src="./images/lap.png" id="IMGlaptop" alt="IMAGEN">
                    <a href="index.php?seccion=nuevoDispositivo"><button class="custom-btn btn-3">AGREGAR NUEVO DISPOSITIVO</button></a>
                    
                    <a href="javascript:window.location.reload(true)" ><img src="images/reload.png" id="imgReload" alt="" style="width:25px; margin:2%;"></a>
                    </div>        
            </div>
        </div>
        
        <div class="container" style="margin-top: 10px !important;">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="inventario_dispositivos">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>TIPO</th>
                            <th>MODELO</th>
                            <th>NÚMERO DE SERIE</th>
                            <th>MARCA</th>
                            <th>PRECIO</th>
                            <th>ESTADO</th>
                            <th>FECHA DE COMPRA</th>
                            <th>NOTAS</th>
                            <th>IMAGEN</th>
                            <th></th>
                        </tr>BBBN
                    </thead>
                    <tbody>
                        <?php
                            $eliminar = new ControladorDispositivos();
                            $eliminado =  $eliminar->borrarDispositivos();

                            
                                

                            $lista = ControladorDispositivos::consultaDispositivos();
                            foreach ($lista as $row => $item) {
                                echo "
                                <tr>
                                    <td>{$item[0]}</td>
                                    <td>{$item[1]}</td>
                                    <td>{$item[2]}</td>
                                    <td>{$item[3]}</td>
                                    <td>{$item[4]}</td>
                                    <td>\${$item[5]}</td>
                                    <td>{$item[6]}</td>
                                    <td>{$item[7]}</td>
                                    <td>{$item[8]}</td>
                                    <td style='text-align:center; vertical-align:middle;'>
                                ";

                                if (empty($item[9])) {
                                    switch ($item[1]) {
                                        case "Laptop":
                                            echo "<img src='images/dis/laptop.png' alt='IMGlaptop' height='50'>";
                                            break;
                                        case "Descktop":
                                            echo "<img src='images/dis/desktop.png' alt='IMGdesktop' height='50'>";
                                            break;
                                        case "iMac":
                                            echo "<img src='images/dis/imac.png' alt='IMGimac' height='50'>";
                                            break;
                                        case "Teclado":
                                            echo "<img src='images/dis/teclado.png' alt='IMGteclado' height='50'>";
                                            break;
                                        case "Mouse":
                                            echo "<img src='images/dis/logi.png' alt='IMGmouse' height='50'>";
                                            break;
                                        case "Monitor":
                                            echo "<img src='images/dis/monitor.png' alt='IMGmonitor' height='50'>";
                                            break;
                                        case "Headset":
                                            echo "<img src='images/dis/headset.png' alt='IMGheadset' height='50'>";
                                            break;
                                        case "Celular":
                                            echo "<img src='images/dis/celular.png' alt='IMGcelular' height='50'>";
                                            break;
                                        case "Switches":
                                            echo "<img src='images/dis/switch.png' alt='IMGswitch' height='50'>";
                                            break;
                                        case "Impresora":
                                            echo "<img src='images/dis/hp.png' alt='IMGimpresora' height='50'>";
                                            break;
                                        case "otro":
                                            echo "<img src='images/dis/otros.png' alt='IMGotro' height='50'>";
                                            break;
                                    }
                                } else {
                                    echo "<img src='{$item[9]}' alt='' height='50'>";
                                }

                                echo "
                                    </td>
                                    <td>
                                        <div class='acciones'>
                                            <img src='images/editar.png' alt='Editar' style='max-width:40px;' class='imagen-editar' id='editar-{$item[0]}'>
                                            <img src='images/basura.png' alt='Borrar' style='max-width:40px; cursor:pointer;' onclick='confirmarBorrar({$item[0]});'>
                                        </div>
                                    </td>
                                </tr>
                                ";

                                // Agregar evento de clic para redireccionar al hacer clic en la imagen
                                echo "<script>
                                        document.getElementById('editar-{$item[0]}').addEventListener('click', function() {
                                            window.location.href = 'index.php?seccion=editarDispositivos&id_dispositivo={$item[0]}';
                                        });
                                </script>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function confirmarBorrar(id_dispositivo) {
            Swal.fire({
                title: '¿Estas seguro?',
                text: "El dispositivo se eliminará definitivamente.",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "index.php?seccion=dispositivos&accion=eliminarDispositivos&id_dispositivo=" + id_dispositivo;
                }
            });
        }

        function buscarDispositivo() {
            console.log("La función buscarDispositivo se está ejecutando");
            var buscarDispositivo = document.getElementById("buscar").value;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    console.log("Respuesta del servidor:", xhr.status, xhr.statusText);
                    if (xhr.status === 200) {
                        console.log("Contenido de la respuesta:", xhr.responseText);
                        document.querySelector("#inventario_dispositivos tbody").innerHTML = xhr.responseText;
                    } else {
                        console.error("Error en la respuesta del servidor");
                    }
                }
            };

            var url = "controlador/ControladorFiltros/buscadorDispositivos.php?buscar=" + encodeURIComponent(buscarDispositivo);
            xhr.open("GET", url, true);
            console.log("Solicitud AJAX enviada a: " + url);
            xhr.send();
        }

        document.addEventListener('DOMContentLoaded', function() {
            var headerTabla = document.querySelector('.headerTabla');
            headerTabla.classList.add('show');
        });

        function cerrarModal() {
            document.getElementById('confirmarBorrarModal').style.display = 'none';
        }

        function eliminarDispositivo() {
            cerrarModal();
        }
        document.getElementById('buscar').addEventListener('input', function() {
            const clearSearch = document.getElementById('clearSearch');
            if (this.value.length > 0) {
                clearSearch.style.display = 'flex';
            } else {
                clearSearch.style.display = 'none';
            }
            });

            document.getElementById('clearSearch').addEventListener('click', function() {
            const buscarInput = document.getElementById('buscar');
            buscarInput.value = '';
            this.style.display = 'none';
            window.location.reload(true);
            });


    </script>
</body>
</html>