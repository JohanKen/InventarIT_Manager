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
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="estilos/estlosNuevoDispositivo.css">
</head>
<body>
    <br><br>
    <header>
        <h1 class="fw-bolder" style="color: #003363; padding: 10px; font-size: 36px; background-color: #ecf0f1; border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">Selecciona el tipo de dispositivo a agregar</h1>
    </header>
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container text-center">
                    <div class="row">
                        
                        <div class="col"> 
                            <a class="anclaDiss" href="index.php?seccion=formularios/newLaptop">
                                <img class="imgLaptop" src="images/dis/laptop.png" alt="Laptop">
                                <span class="label anima-label">Laptop</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="anclaDiss" href="index.php?seccion=formularios/newDesktop">
                                <img class="imgDis" src="images/dis/desktop.png" alt="Desktop">
                                <span class="label anima-label">Desktop</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="anclaDiss" href="index.php?seccion=formularios/newiMac">
                                <img class="imgDis" src="images/dis/imac.png" alt="iMac" style="width:220px;">
                                <span class="label anima-label">iMac</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="anclaDiss" href="index.php?seccion=formularios/newTeclado">
                                <img class="imgTeclado" src="images/dis/teclado.png" alt="Teclado">
                                <span class="label anima-label">Teclado</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container text-center">
                    <div class="row">
                        
                        <div class="col" style="padding-top:5%">
                            <a class="anclaDiss" href="index.php?seccion=formularios/newMouse">
                                <img class="imgMouse" src="images/dis/logi.png" alt="Mouse">
                                <span class="label anima-label">Mouse</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="anclaDiss" href="index.php?seccion=formularios/newMonitor">
                                <img class="imgMonitor" src="images/dis/monitor.png" alt="Monitor">
                                <span class="label anima-label">Monitor</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="anclaDiss" href="index.php?seccion=formularios/newHeadset">
                                <img class="imgMonitor" src="images/dis/headset.png" alt="Monitor">
                                <span class="label anima-label">Headset</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="anclaDiss" href="index.php?seccion=formularios/newCelular">
                                <img class="imgCelular" src="images/dis/celular.png" alt="Celular">
                                <span class="label anima-label">Celular</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container text-center">
                    <div class="row">
                        
                        <div class="col">
                            <a class="anclaDiss" href="index.php?seccion=formularios/newSwitches">
                                <img class="imgSwitches" src="images/dis/cisco.png" alt="Switches">
                                <span class="label anima-label">Switch</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="anclaDiss" href="index.php?seccion=formularios/newImpresora">
                                <img class="imgImpresora" src="images/dis/hp.png" alt="Impresora">
                                <span class="label anima-label">Impresora</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="anclaDiss" href="index.php?seccion=formularios/newOtro">
                                <img class="imgOtro" src="images/dis/otros.png" alt="Otro">
                                <span class="label anima-label">Otro...</span>
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Controles de carrusel -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
    </div>
    <div class="anclaa" style="text-align: center;">
    <a href="index.php?seccion=dispositivos" class="btnn" style="text-decoration: none; color: white; background-color: #003363; padding: 10px 20px; border-radius: 5px;">Volver a dispositivos</a>
</div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var h1 = document.getElementById('h1');
            h1.style.opacity = '1';
            h1.style.transform = 'translateX(0)';
        });
    </script>
</body>
</html>
