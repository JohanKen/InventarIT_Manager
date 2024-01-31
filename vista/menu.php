<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Menú Lateral con Css</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat|Montserrat+Alternates|Poppins&display=swap">
    <link rel="stylesheet" href="estilos/estilosMenu.css">    
</head>
<body>
    <header class="header">
        <div class="container">
            
            
            
            <div class="menu">
    <h1 id="logoInven"><img src="images/logoInventarit.png" alt="imgLogo" id="logoInventarit"></h1>
    <ul class="navbar-nav flex-row"> <!-- Agrega la clase flex-row -->
        <li class="nav-item active">
            <a class="nav-link" href="index.php?seccion=inicio">Inicio</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?seccion=inventario">Inventario</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?seccion=asignaciones">Onboarding</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?seccion=colaboradores">Colaboradores</a>
        </li>
        <li class="nav-item" >
            <a class="nav-link" href="index.php?seccion=inicio" id="equiposLink">Equipos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?seccion=usuarios">Usuarios</a>
        </li>
    </ul>

    <input type="text" id="searchInput" placeholder="Buscar" class="form-control">
    <a href=""><img src="images/cam.png" id="imgCampana" alt=""></a>
    <div class="messages" id="userMenu">
        <a href="index.php?seccion=perfil" id="usuarioLink" style="color: #fff;">
            <?php echo $_SESSION["usuario"]["nombre_usuario"] . ' ' . $_SESSION["usuario"]["apellido_paterno_usuario"];?>
        </a>
   </div>

</div>

    </header>
   
    
        
           
        


    <script>

    

document.addEventListener("DOMContentLoaded", function () {
            const userMenuButton = document.getElementById("userMenuButton");
            const userDropdown = document.getElementById("userDropdown");

            userMenuButton.addEventListener("click", function () {
                userDropdown.classList.toggle("show-dropdown");
            });

            document.addEventListener("click", function (event) {
                if (event.target !== userMenuButton && event.target !== userDropdown) {
                    userDropdown.classList.remove("show-dropdown");
                }
            });
        });
        

        

        document.addEventListener("DOMContentLoaded", function () {
        let equiposLink = document.getElementById("equiposLink");
        const dropdownContent = document.createElement("div");
        dropdownContent.className = "dropdown-content";
        dropdownContent.innerHTML = `
            <a href="index.php?seccion=dispositivos" >Dispositivos</a>
            <a href="#">CCTV</a>
            <a href="#">Herramientas</a>
        `;

        equiposLink.appendChild(dropdownContent);

        equiposLink.addEventListener("mouseover", function () {
            dropdownContent.style.display = "block";
        });

        equiposLink.addEventListener("mouseout", function () {
            dropdownContent.style.display = "none";
        });

        // Cierra el menú si el ratón sale del enlace o del menú desplegable
        document.addEventListener("mouseout", function (event) {
            if (event.target !== equiposLink && event.target !== dropdownContent) {
                dropdownContent.style.display = "none";
            }
        });
    });



    
    document.addEventListener("DOMContentLoaded", function () {
    let equiposLink = document.getElementById("usuarioLink");
    const dropdownContent = document.createElement("div");
    dropdownContent.className = "dropdown-contents";
    dropdownContent.innerHTML = `
        <a href="index.php?seccion=dispositivos" >Configuracion</a>
        <a href="index.php?seccion=dispositivos" >Perfil</a>
        <a href="logout.php" >Cerrar sesión</a>
    `;

    equiposLink.appendChild(dropdownContent);

    let timeoutId;

    equiposLink.addEventListener("mouseover", function () {
        clearTimeout(timeoutId);
        dropdownContent.style.display = "block";
    });

    equiposLink.addEventListener("mouseout", function () {
        timeoutId = setTimeout(function () {
            dropdownContent.style.display = "none";
        }, 700);
    });
});

    </script>
</body>

</html>
