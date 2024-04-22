<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dispositivos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="estilos/estilosDispositivos.css">

</head> 

<body>
    <div class="contentSeccion">
        <div class="up">
            <header class="headerTabla">
                <h1>Dispositivos</h1>
                <form class="form-inline" id="searchBar">
                  

                </form>
            </header>
            <div class="col-md-12 text-center d-flex">
            <div class="input-group input-group-sm mt-3" id="divBuscar" style="max-width: 300px; margin: auto;">
                <input class="form-control border border-dark bg-white text-dark" type="search" name="busquedaDispositivos" placeholder="Buscar" aria-label="Search">
                <button class="btn btn-primary" type="submit">Buscar</button>
            </div>

                <div class="input-group input-group-sm mt-3 "  style=" max-width: 300px; margin: auto; display: block !important; display: flex; flex-direction: column; align-items: flex-end;">
                    <img src="./images/lap.png" id="IMGlaptop" alt="IMAGEN">
                    <a href="index.php?seccion=nuevoDispositivo"><button id="btnAgregarNuevo" class="btn btn-primary" >AGREGAR NUEVO DISPOSITIVO</button></a>
                </div>        
                
            </div>
        </div>
        
        <a href="index.php?seccion=nuevoDispositivo">

        </a>
        <div class="container" style="margin-top: 10px !important;">
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-dark">
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
                    $eliminado =  $eliminar->borrarDispositivos();

                    if ($eliminado) {
                        echo "
                        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                        <script>
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Dispositivo eliminado con exito',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        setTimeout(function() {
                            window.location.href='index.php?seccion=dispositivos';
                        }, 3000); </script>
                        ";
                    }


                 
                    

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
                            <td><img src='{$item[9]}' alt='' height='50'></td>
                            <td>
                                <button type='button' class='btn btn-info' onclick=\"window.location.href='index.php?seccion=editarDispositivos&id_dispositivo={$item[0]}'\">Editar</button>
                                <button type='button' class='btn btn-danger' onclick='confirmarBorrar({$item[0]});'>Borrar</button>
                            </td>
                        </tr>
                    ";
                    
                    }
                    ?>
                    </tbody>
                </table>
            </div>
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
    document.addEventListener('DOMContentLoaded', function() {
        var headerTabla = document.querySelector('.headerTabla');
        headerTabla.classList.add('show');
    });

    function confirmarBorrar(id_dispositivo) {
        document.getElementById('confirmarBorrarModal').style.display = 'flex';
        document.getElementById('btnBorrarModal').onclick = function() {
            window.location.href = "index.php?seccion=dispositivos&accion=eliminarDispositivos&id_dispositivo=" +
                id_dispositivo;
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