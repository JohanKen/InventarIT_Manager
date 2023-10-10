<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./estilos/estilosMenu.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  
</head>

<body>
    <div class="container-fluidd">
        <div class="roww">
            <div class="coll">
                <div class="navbar-vertical">
                    <!-- Contenido de tu barra de navegación vertical aquí -->
                    <img src="./images/logoinventarit.png" alt="" id="logoInventaritNav">
                    <ul id="ulNavVertical">
                        <li class="liNavVer"><img src="./images/dashIcon.png" id="logoNav"><a href="inicio"
                                id="itemNav1">Inicio</a></li>
                        <li class="liNavVer"><img src="./images/inventario.png" id="logoNav"><a href="#"
                                id="itemNav2">Inventario</a>
                        </li>
                        <li class="liNavVer"><img src="./images/onboarding.png" id="logoNav"><a href="#"
                                id="itemNav3">Onboarding</a>
                        </li>
                        <li class="liNavVer"><img src="./images/godin.png" id="logoNav"><a href="#"
                                id="itemNav4">Colaboradores</a></li>
                        <li class="liNavVer"><img src="./images/laptop.png" id="logoNav"><a href="#"
                                id="itemNav5">Equipos</a></li>
                        <li class="liNavVer"><img src="./images/user.png" id="logoNav"><a href="#"
                                id="itemNav6">Usuarios</a></li>
                        <img src="./images/flechaIz.png" id="logoNav1" class="menu-button" alt="flechaIMG"
                            id="menu-toggle-button">
                    </ul>
                </div>
            </div>

            <div class="colSecc">
                <nav class="navbar navbar-expand-lg navbar-light bg-light align-items-center" id="navHorizontal">
                    <div class="container-fluid" style="justify-content: none;">
                        <form class="d-flex" id="searchbar">
                            <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search"
                                id="searchInput">
                            <button class="btn btn-outline-success" type="submit" id="search-button">
                                <img id="imgBuscar" src="./images/buscar.png" alt="Buscar">
                            </button>
                        </form>
                        <div class="nav-icon-container1">
                            <a href="#" class="nav-link">
                                <img src="./images/campana.png" alt="Campana" id="imgNavHorizontal" class="navbar-icon">
                            </a>
                        </div>
                        <div class="nav-icon-container2">
                            <a href="#" class="nav-link">
                                <img src="./images/correo.png" alt="Correo" id="imgNavHorizontal1" class="navbar-icon">
                            </a>
                        </div>
                        <div class="nav-icon-container3">
                            <a href="#" class="nav-link">
                                <img src="./images/lnvertical.png" alt="Correo" id="imgNavHorizontal1"
                                    class="navbar-icon">
                            </a>
                        </div>

                        <form action="" id="formUser">
                            <img src="./images/user.png" alt="" id="userimgnav">
                            <a href="#" class="nav-link">
                                <p id="UsuarioParrafo">Usuario</p>
                            </a>
                            <div class="container mt-5">
                                <div class="dropdown" id="dropdownList">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">

                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="ulDrop">
                                        <li id="dropLI"><a class="dropdown-item" href="#">Configuración de Perfil</a>
                                        </li>
                                        <li id="dropLI"><a class="dropdown-item" href="#" disabled>Configuración</a>
                                        </li>
                                        <li class="dropdown-divider"></li>
                                        <li id="dropLI"><a class="dropdown-item" href="./login.php">Cerrar Sesión</a></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </nav>


                <div class="seccion">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="content">
                                <!-- Contenido de la sección (cambiar según la página) -->
                                <p>Esta es la sección de inicio</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Contenedor del contenido fuera de las columnas -->

        </div>
    </div>



    <!-- Aquí puedes agregar más contenido y secciones -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#logoNav1").click(function() {
            $(".navbar-vertical").toggleClass(
                "nav-open"); // Agrega o quita la clase "nav-open" al hacer clic
            $(this).toggleClass("rotate"); // Agrega o quita la clase "rotate" al hacer clic
        });
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>


</body>

</html>