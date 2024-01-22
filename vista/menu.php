<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Menú Lateral con Css</title>
	<link rel="stylesheet" href="estilos/estilosMenu.css">
</head>

<!-- se va a rediseñar en navbar con el menu en general -->

<body>
	<header class="header">
		<div class="container">
			<div class="btn-menu">
				<label for="btn-menu" style="color: black;"><img src="images/bar.svg" alt="" id="imgBar"></label>
			</div>
			<div class="logo">
				<h1 id="logoInven"><img src="./images/logoinventarit.png" alt="imgLogo" id="logoInventarit"></h1>
			</div>
			
			
			
			
			<div class="menu">
				<div class="search">
					<input type="text" id="searchInput" placeholder="Buscar">
				</div>
				<div class="notifications">
					<img src="images/cam.png" id="imgCampana" alt="">
				</div> 
				<div class="messages">
					
				</div>
				
				<div class="user">
					<a href="#">Usuario</a>
					<ul class="user-menu">
						<li><a href="#">Perfil</a></li>
						<li><a href="#">Configuración</a></li>
						<li><a href="logout.php" id="logout">Cerrar Sesión</a></li>
					</ul>
				</div>
			</div>
		
		
		
		
		</div>
	</header>
	<div class="capa"></div>

	 <!--Menú desplegable de "Equipos"--> 
	<input type="checkbox" id="btn-menu">
	<div class="container-menu">
		<div class="cont-menu">
			<nav>
				<a href="index.php?seccion=inicio">Inicio</a>
				<a href="index.php?seccion=inventario">Inventario</a>
				<a href="index.php?seccion=asignaciones">Onboarding</a>
				<a href="index.php?seccion=colaboradores">Colaboradores</a>
				<a href="index.php?seccion=inicio">Equipos</a>
				<a href="index.php?seccion=usuarios">Usuarios</a>
			</nav>
			<label for="btn-menu"><img src="images/imgclose.png" id="imgClose" alt=""></label>
		</div>
	</div>


	<script>
        document.addEventListener("DOMContentLoaded", function () {
            let header = document.querySelector(".header");
            let lastScrollTop = 0;

            window.addEventListener("scroll", function () {
                var st = window.pageYOffset || document.documentElement.scrollTop;
                if (st > lastScrollTop) {
                    // Desplazándose hacia abajo
                    header.classList.add("hidden-header");
                } else {
                    // Desplazándose hacia arriba
                    header.classList.remove("hidden-header");
                }
                lastScrollTop = st;
            });
        });

		document.addEventListener("DOMContentLoaded", function () {
			let equiposLink = document.querySelector(".container-menu nav a:nth-child(5)");
			const dropdownContent = document.createElement("div");
			dropdownContent.className = "dropdown-content";
			dropdownContent.innerHTML = `
				<a href="index.php?seccion=dispositivos">Dispositivos</a>
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
		});

		document.addEventListener("click", function (event) {
			if (event.target !== equiposLink && event.target !== dropdownContent) {
				dropdownContent.style.display = "none";
			}
		});
	</script>
</body>
</html>
