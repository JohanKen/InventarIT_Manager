<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo dispositivo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <br><br><br><br><br><br><br><br>
    
  
    <div class="container">
        <div class="mb-3">
            <label for="tipoDispositivo" class="form-label">Selecciona tipo de dispositivo a agregar:</label>
            <select class="form-select" id="tipoDispositivo" onchange="seleccionarTipoDispositivo()">
                <option selected disabled>Selecciona un tipo...</option>
                <option value="formularios/newLaptop">Laptop</option>
                <option value="formularios/newDesktop">Desktop</option>
                <option value="formularios/newImac">iMac</option>
                <option value="formularios/newTeclado">Teclado</option>
                <option value="formularios/newMouse">Mouse</option>
                <option value="formularios/newMonitor">Monitor</option>
                <option value="formularios/newHeadset">Headset</option>
                <option value="formularios/newCelular">Celular</option>
                <option value="formularios/newSwitch">Switch</option>
                <option value="formularios/newImpresora">Impresora</option>
                <option value="formularios/newOtro">Otro</option>
            </select>
        </div>

        <!-- Botón para volver -->
        <a href="index.php?seccion=dispositivos"><button class="btn btn-secondary" onclick="volver()">Volver</button></a>
    </div>

    <!-- Bootstrap JS, Popper.js, y jQuery (necesarios para ciertas funciones de Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <script>
        function seleccionarTipoDispositivo() {
            var tipoDispositivo = document.getElementById("tipoDispositivo").value;
            window.location.href = tipoDispositivo;
        }

        function volver() {
            // Puedes personalizar esta función según tus necesidades
            alert("Implementa tu lógica de volver aquí");
        }
    </script>
</body>
</html>
