<?php 

    //obtener datos del usuario para setearlos en el menu
    $id = $_SESSION['usuario']['id_usuario'];

    $datosUsuario =  ObtenerDatosUsuarios($id);

    function ObtenerDatosUsuarios ($id){
        if ($id >= 0) {
            try {
                $UsuarioInfo = ControladorUsuarios::getUser($id);

                //verificar si se obtuvieron correctamente los datos

                if (empty($UsuarioInfo[0])) {
                    echo "Erropr no se pudieropn obtener los datos del usuario";
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
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat|Montserrat+Alternates|Poppins&display=swap">
    <link rel="stylesheet" href="estilos/estilosMenu.css">
    <link rel="stylesheet" href="@sweetalert2/themes/dark/dark.css">
    <script src="sweetalert2/dist/sweetalert2.min.js"></script>

    <style>
        body{
            z-index: 15;
        }
        /* Ajusta el tamaño de la imagen de la campana */
        #imgCampana {
            width: 20px;
            height: 20px;
            margin-left: 10px; /* Ajusta el margen izquierdo */
        }

        /* Ajusta el tamaño del campo de búsqueda */
        #searchInput {
            width: 150px;
            margin-right: 10px; /* Ajusta el margen derecho */
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
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
                                <a class="nav-link" href="index.php?seccion=inicio">Inicio</a>
                            </li>
                          
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?seccion=asignaciones">Onboarding</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?seccion=colaboradores">Colaboradores</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="equiposLink" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Equipos
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="equiposLink">
                                    <li><a class="dropdown-item" href="index.php?seccion=dispositivos">Dispositivos</a></li>
                                    <li><a class="dropdown-item" href="#">CCTV</a></li>
                                    <li><a class="dropdown-item" href="#">Herramientas</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?seccion=usuarios">Usuarios</a>
                            </li>
                            <hr>
                            <li>
                                
                            <li class="nav-item">
                            <a class="nav-link"href="index.php?seccion=perfil&id_usuario=<?php echo $_SESSION['usuario']['id_usuario']; ?>" id="usuarioLink" style="color: #fff;">
                                <?php echo $datosUsuario[3] . ' ' . $datosUsuario[1];?>
                            </a>
                            <li>
                            <li class="nav-item">

                            <button id="btnCerrarSesion" type="button" class="btn btn-dark" onclick="cerrarSesion()">Cerrar sesión</button>
                            
                            <li>
                        </div>
                        </li>

                     
                    <!--Esta parte del menu (barra de busqueda y notificaciones seran adaptadas en la segunda version del sistema)
                        <input type="text" id="searchInput" placeholder="Buscar" class="form-control">
                        <a href=""><img src="images/cam.png" id="imgCampana" alt=""></a>
                        </ul>
                        -->
                    </div>
                    
                </div>
            </nav>
        </div>
    </header>

   <script>
    function cerrarSesion() {
        swal({
            text: "¿Seguro que quieres cerrar sesión?",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Cancelar",
                    visible: true,
                    className: "",
                    closeModal: true,
                },
                confirm: {
                    text: "Sí, cerrar sesión",
                    value: true,
                    visible: true,
                    className: "",
                    closeModal: true
                }
            },
            dangerMode: true,
            closeOnClickOutside: true,
            closeOnEsc: true,
            closeOnTimer: true,
            timer: 0,
            className: "",
            escapeKey: "cancel",
            focusCancel: false,
            showCloseButton: false,
            showConfirmButton: true,
            showLoaderOnConfirm: false,
            showLoaderOnCancel: false,
            footer: "",
            width: "",
            padding: "",
            background: "#FFFFFF",
            backdrop: true,
            timerProgressBar: false,
            allowOutsideClick: true,
            allowEscapeKey: true,
            allowEnterKey: true,
            stopKeydownPropagation: true,
            keydownListenerCapture: false,
            position: "center",
            grow: false,
            backdropPadding: 0,
            customClass: "",
            animation: true,
            confirmButtonText: "Sí, cerrar sesión",
            confirmButtonAriaLabel: "",
            cancelButtonText: "Cancelar",
            cancelButtonAriaLabel: "",
            buttonsStyling: true,
            reverseButtons: false,
            focusConfirm: true,
            focusCancel: false,
            showConfirmButton: true,
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonClass: "",
            cancelButtonClass: "",
            confirmButtonStyle: "border: none; background-color: green;",
            cancelButtonStyle: "border: none; background: transparent;",
            confirmButtonText: "¡Sí, cerrar sesión!",
            cancelButtonText: "Cancelar",
            closeOnConfirm: true,
            closeOnCancel: true,
            closeOnClose: true,
            showCloseButton: false,
            showLoaderOnConfirm: false,
            showLoaderOnCancel: false,
            reverseButtons: false,
            allowOutsideClick: true,
            allowEscapeKey: true,
            allowEnterKey: true,
            customClass: "",
            animation: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#aaa",
            confirmButtonClass: "",
            cancelButtonClass: "",
            confirmButtonStyle: "border-radius: 20px;",
            cancelButtonStyle: "border-radius: 20px;",
            reverseButtons: false,
            focusConfirm: true,
            focusCancel: false,
            showConfirmButton: true,
            showCancelButton: true,
            confirmButtonAriaLabel: "",
            cancelButtonAriaLabel: "",
            confirmButtonText: "¡Sí, cerrar sesión!",
            cancelButtonText: "Cancelar",
            buttonsStyling: true,
            closeOnConfirm: true,
            closeOnCancel: true,
            closeOnClose: true,
            allowOutsideClick: true,
            allowEscapeKey: true,
            allowEnterKey: true,
            customClass: "",
            animation: true,
            onOpen: null,
            onClose: null,
        }).then((value) => {
            if (value) {
                window.location.href = "logout.php";
            }
        });
    }
</script>



</body>

</html>