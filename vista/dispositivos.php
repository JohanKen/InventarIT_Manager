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
    <style>
    .imagen-editar {
        cursor: pointer;
    }

    .acciones {
        display:flex;    
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
            <h1 style="font-size: 28px; font-weight: bold; color: #003363; text-transform: uppercase; border-bottom: 2px solid #003363; ">dispositivos</h1>
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
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>TIPO</th>
                            <th>MODELO</th>
                            <th>NUMERO DE SERIE</th>
                            <th>MARCA</th>
                            <th>PRECIO</th>
                            <th>ESTADO</th>
                            <th>FECHA DE COMPRA</th>
                            <th>NOTAS</th>
                            <th>IMAGEN</th>
                            <th></th>
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
                        }, 1500); </script>
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
                           <td>
                           ";
                           if ($item[1] == "Laptop" && empty($item[9]))  {
                            echo "
                                <img src='images/dis/laptop.png' alt='laptop' height='50'>
                            </td>";
                        }else{
                            echo "
                            <img src='{$item[9]}' alt='' height='50'>
                         </td>";

                        }
                        
                            echo"
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
        text: "El dispositivo se eliminara definitivamente.",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "index.php?seccion=dispositivos&accion=eliminarDispositivos&id_dispositivo=" + id_dispositivo;
        }
    });
}


    

        // Agrega un evento de clic a la imagen
    document.getElementById('editar-{$item[0]}').addEventListener('click', function() {
        // Redirige a la página deseada al hacer clic en la imagen
        window.location.href = 'index.php?seccion=editarDispositivos&id_dispositivo={$item[0]}';
    });
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
    </script>
</body>

</html>