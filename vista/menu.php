<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Menú Lateral con Css</title>
	<link rel="stylesheet" href="./estilos/estilosMenu.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<!-- se va a rediseñar en navbar con el menu en general -->

<body>
	<header class="header">
		<div class="container">
			<div class="btn-menu">
				<label for="btn-menu" style="color: black;">☰</label>
			</div>
			<div class="logo">
				<h1 id="logoInven"><img src="./images/logoinventarit.png" alt="imgLogo" id="logoInventarit"></h1>
			</div>
			<nav class="menu">
				<div class="search">
					<input type="text" placeholder="Buscar">
				</div>
				<div class="notifications">
					<a href="#">🔔</a>
</div>
				<div class="messages">
					<a href="#">📬</a>
				</div>
				<div class="user">
					<a href="#">Usuario</a>
					<ul class="user-menu">
						<li><a href="#">Perfil</a></li>
						<li><a href="#">Configuración</a></li>
						<li><a href="logout.php" id="logout">Cerrar Sesión</a></li>
					</ul>
				</div>
			</nav>
		</div>
	</header>
	<div class="capa"></div>

	<!-- Menú desplegable de "Equipos" -->
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
			<label for="btn-menu">✖️</label>
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
