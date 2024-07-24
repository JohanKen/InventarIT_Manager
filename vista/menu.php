<?php 
    $id = $_SESSION['usuario']['id_usuario'];
    $datosUsuario =  ObtenerDatosUsuarios($id);
    function ObtenerDatosUsuarios ($id){
        if ($id >= 0) {
            try {
                $UsuarioInfo = ControladorUsuarios::getUser($id);

                //verificar si se obtuvieron correctamente los datos

                if (empty($UsuarioInfo[0])) {
                    echo "Error no se pudieron obtener los datos del usuario";
                    return null;
                }

                return $UsuarioInfo[0];

            }catch (Exception $e) {
                // Manejar la excepción, por ejemplo, registrándola o mostrándola
                echo "Error al obtener datos del usuario: " . $e->getMessage();
                return null;
            }
        }else{
            echo "No se pudo obtener ningun ID de usuario";
            return null;
        }
    }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Menú Lateral con Bootstrap Responsivo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Montserrat|Montserrat+Alternates|Poppins&display=swap">
    <link rel="stylesheet" href="estilos/estilosMenu.css">
   
    

    <style>
    body {
        z-index: 15;
    }

    /* Ajusta el tamaño de la imagen de la campana */
    #imgCampana {
        width: 20px;
        height: 20px;
        margin-left: 10px;
        /* Ajusta el margen izquierdo */
    }

    /* Ajusta el tamaño del campo de búsqueda */
    #searchInput {
        width: 150px;
        margin-right: 10px;
        /* Ajusta el margen derecho */
    }
    </style>
</head>

<body>
    <header class="header">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="images/logoInventarit.png" alt="imgLogo" id="logoInventarit">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="link-1" href="index.php?seccion=inicio">Inicio</a>
                            </li>

                            <li class="nav-item">
                                <a class="link-1" href="index.php?seccion=asignaciones/asignaciones">Onboarding</a>
                            </li>
                            <li class="nav-item">
                                <a class="link-1" href="index.php?seccion=colaboradores">Colaboradores</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="link-1 dropdown-toggle" href="#" id="equiposLink" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Equipos
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="equiposLink">
                                    <li><a class="dropdown-item" href="index.php?seccion=dispositivos">Dispositivos</a>
                                    </li>
                                    <li><a class="dropdown-item" href="#">CCTV</a></li>
                                    <li><a class="dropdown-item" href="#">Herramientas</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="link-1" href="index.php?seccion=usuarios">Usuarios</a>
                            </li>
                            <hr>



                            <!--Esta parte del menu (barra de busqueda y notificaciones seran adaptadas en la segunda version del sistema)
                        <input type="text" id="searchInput" placeholder="Buscar" class="form-control">
                        <a href=""><img src="images/cam.png" id="imgCampana" alt=""></a>
                        </ul>
                        -->
                    </div>

                </div>
                <div class="d-flex justify-content-xl-end" style="margin: 15px !important;">

                   <div class="align-self-center">
                   <a class="link-2" href="index.php?seccion=perfil&id_usuario=<?php echo $_SESSION['usuario']['id_usuario']; ?>"
                        id="usuarioLink">
                        <img src="images/useer.png" alt="">
                        <?php echo $datosUsuario[3] . ' ' . $datosUsuario[1];?>
                    </a>

                        </div>
                        
                 
                        <div class="align-self-center">

                        <button id="btnCerrarSesion" type="button" class="btn btn-dark" onclick="cerrarSesion()">
                        <img src="images/imgclose.png" alt="" style="max-width:30px;">
                    </button>
                        </div>





                </div>
            </nav>
        </div>
    </header>

    <script>
    function cerrarSesion() {
        Swal.fire({
            text: "¿Seguro que quieres cerrar sesión?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, cerrar sesión",
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "logout.php";
            }
        });
    }
    </script>



</body>

</html>