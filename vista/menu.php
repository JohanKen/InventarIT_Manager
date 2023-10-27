<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Menù Lateral con Css</title>
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
<!--	--------------->
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
    const logoutLink = document.getElementById("logout");

    logoutLink.addEventListener("click", function (event) {
        event.preventDefault();

        const confirmLogout = window.confirm("¿Estás seguro de que deseas cerrar la sesión?");

        if (confirmLogout) {
            // Realiza la acción de cierre de sesión aquí
            window.location.href = "logout.php"; // Reemplaza esto con la URL de tu proceso de cierre de sesión
        }
    });
});
</script>
</body>
</html>