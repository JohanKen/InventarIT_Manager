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
        <div class="container-fluid p-0 m-0" >
            <nav class="navbar navbar-expand-lg  bg-dark border border-secondary-subtle rounded-0 m-0 p-0">
                <div class="container-fluid"> 
                    <a class="navbar-brand" href="#">
                        <img src="images/logoInventarit.png" alt="imgLogo" id="logoInventarit">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="container-fluid p-0 m-0">
                        <div class="collapse navbar-collapse p-0 m-0" id="navbarNav">
                            <ul class="navbar-nav">

                                <li>
                                    <div class="link-container">
                                        <a class="link-three" href="index.php?seccion=inicio">Inicio</a>
                                    </div>
                                </li>
                                
                                <li class="nav-item">
                                    <div class="link-container">
                                        <a class="link-three" href="index.php?seccion=asignaciones/asignaciones">Onboarding</a>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="link-container">
                                        <a class="link-three" href="index.php?seccion=colaboradores">Colaboradores</a>
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <div class="link-container">
                                        <a class="link-three dropdown-toggle" href="#" id="equiposLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Equipos</a>
                                        <ul class="dropdown-menu" aria-labelledby="equiposLink">
                                            <li><a class="dropdown-item" href="index.php?seccion=dispositivos">Dispositivos</a></li>
                                            <li><a class="dropdown-item" href="#">CCTV</a></li>
                                            <li><a class="dropdown-item" href="#">Herramientas</a></li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="link-container">
                                        <a class="link-three" href="index.php?seccion=usuarios">Usuarios</a>
                                    </div>
                                </li>

                                <hr>



                                <!--Esta parte del menu (barra de busqueda y notificaciones seran adaptadas en la segunda version del sistema)
                                <input type="text" id="searchInput" placeholder="Buscar" class="form-control">
                                    <a href=""><img src="images/cam.png" id="imgCampana" alt=""></a>
                                
                                -->
                                </ul>
                            </div>
                    </div>
                </div>
                <div class="d-flex justify-content-xl-end" style="margin: 15px !important;">

                   <div class="link-container align-self-center">
                   <a class="link-two" href="index.php?seccion=perfil&id_usuario=<?php echo $_SESSION['usuario']['id_usuario']; ?>" id="usuarioLink">
                        <img src="images/adminn.png" alt="">
                        <span class="nombre-usuario"><?php echo $datosUsuario[3] . '&nbsp;' . $datosUsuario[1]; ?></span>
                        </a>

                        </div>
                        
                 
                        <div class="link-container-exit align-self-center">
                        
                        <button id="btnCerrarSesion" type="button" class="btn" onclick="cerrarSesion()">
                        <img src="images/cerrar.png" alt="" style="max-width:30px;">
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const body = document.body;
        const contentHeight = body.scrollHeight; // Obtiene la altura total del contenido

        // Ajusta la duración de la animación basada en la altura del contenido
        let duration;

        if (contentHeight < 600) {
            duration = 20; // Menos contenido
        } else if (contentHeight < 1200) {
            duration =  30; // Contenido medio
        } else {
            duration = 60; // Más contenido
        }

        body.style.animationDuration = `${duration}s`; // Aplica la duración a la animación
    });
</script>



</body>

</html>