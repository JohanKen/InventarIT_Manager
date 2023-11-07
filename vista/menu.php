<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Menú Lateral con Css</title>
	<link rel="stylesheet" href="./estilos/estilosMenu.css">
</head>
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
                <li><a href="#" id="logout">Cerrar Sesión</a></li>
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
				<a href="#">Inicio</a>
				<a href="#">Inventario</a>
				<a href="#">Onboarding</a>
				<a href="#">Colaboradores</a>
				<a href="#">Equipos</a>
				<a href="#">Usuarios</a>
			</nav>
			<label for="btn-menu">✖️</label>
		</div>
	</div>

	<script>
    document.addEventListener("DOMContentLoaded", function () {
      const equiposLink = document.querySelector(".container-menu nav a:nth-child(5)");
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
