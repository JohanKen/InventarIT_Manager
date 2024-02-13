<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Menú Lateral con Bootstrap Responsivo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat|Montserrat+Alternates|Poppins&display=swap">
    <link rel="stylesheet" href="estilos/estilosMenu.css">


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
                                
                            <div class="messages" id="userMenu">
                            <a href="index.php?seccion=perfil" id="usuarioLink" style="color: #fff;">
                                <?php echo $_SESSION["usuario"]["nombre_usuario"] . ' ' . $_SESSION["usuario"]["apellido_paterno_usuario"];?>
                            </a>
                            <div class="dropdown-content" id="userDropdown">
                             
                                <a href="index.php?seccion=dispositivos">Perfil</a>
                                <a href="logout.php">Cerrar sesión</a>
                            </div>
                       
                        </div>
                        </li>

                        </ul>
                    </div>
                    <div class="search">
                        <input type="text" id="searchInput" placeholder="Buscar" class="form-control">
                        <a href=""><img src="images/cam.png" id="imgCampana" alt=""></a>
                   
                    </div>
                </div>
            </nav>
        </div>
    </header>


</body>

</html>
