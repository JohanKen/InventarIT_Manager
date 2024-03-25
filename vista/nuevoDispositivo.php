<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo dispositivo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <link rel="stylesheet" href="estilos/estilosNewDevice.css">
</head>
<body>
    <br><br>
    <header>
        <h1 id="h1" >Selecciona el tipo de dispositivo a agregar</h1>
    </header>
    <div class="containerr">
        <!--cambio de select por imagenes para seleccionar que tipo de dispositivo se va a agregar-->
        <ul class="flexx">
            <li class="me-3">
                <a class="anclaDis" href="index.php?seccion=formularios/newLaptop">
                    <img class="imgDis" src="images/dis/laptop.png" alt="Laptop">
                    <span class="label">Laptop</span>
                </a>
            </li>

            <li class="me-3">
                <a class="anclaDis" href="index.php?seccion=formularios/newDesktop">
                <a class="anclaDis" href="index.php?seccion=formularios/newDesktop">
                    <img class="imgDis" src="images/dis/desktop.png" alt="Desktop">
                    <span class="label">Desktop</span>
                </a>
            </li>

            <li class="me-3">
                <a class="anclaDis" href="index.php?seccion=formularios/newiMac">
                    <img class="imgDis" src="images/dis/imac.png" alt="iMac">
                    <span class="label">iMac</span>
                </a>
            </li>
        </ul>

        <ul class="flexxa">
            <li class="me-3">
                <a class="anclaDis" href="index.php?seccion=formularios/newTeclado">
                    <img class="imgDis" src="images/dis/teclado.png" alt="Teclado">
                    <span class="label">Teclado</span>
                </a>
            </li>

            <li class="me-3">
                <a class="anclaDis" href="index.php?seccion=formularios/newMouse">
                    <img class="imgDiis" src="images/dis/mouse.png" alt="Mouse">
                    <span class="label">Mouse</span>
                </a>
            </li>

            <li class="me-3">
                <a class="anclaDis" href="index.php?seccion=formularios/newMonitor">
                    <img class="imgDis" src="images/dis/monitor.png" alt="Monitor">
                    <span class="label">Monitor</span>
                </a>
            </li>
        </ul>

        <ul class="flexxb">
            <li class="me-3">
                <a class="anclaDis" href="index.php?seccion=formularios/newCelular">
                    <img class="imgDiss" src="images/dis/celular.png" alt="Celular">
                    <span class="label">Celular</span>
                </a>
            </li>

            <li class="me-3">
                <a class="anclaDis" href="index.php?seccion=formularios/newSwitches">
                    <img class="imgDis" src="images/dis/switch.png" alt="Switches">
                    <span class="label">Switches</span>
                </a>
            </li>

            <li class="me-3">
                <a class="anclaDis" href="index.php?seccion=formularios/newImpresora">
                    <img class="imgDis" src="images/dis/impresora.png" alt="Impresora">
                    <span class="label">Impresora</span>
                </a>
            </li>

            <li class="me-3">
                <a class="anclaDis" href="index.php?seccion=formularios/newOtro">
                    <img class="imgDis" src="images/dis/otros.png" alt="Otro">
                    <span class="label">Otro</span>
                </a>
            </li>
        </ul>

     
    </div>
<div class="anclaa">
    <a href="index.php?seccion=dispositivos" ><button class="btnn">Volver</button></a>

</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var h1 = document.getElementById('h1');
            h1.style.opacity = '1';
            h1.style.transform = 'translateX(0)';
        });
    </script>
</body>
</html>
