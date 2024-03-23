<?php
//verificamos cuando se presiona el boton de registrar para irnos al controlador
if(isset($_POST['Registrar'])){
                
                    
    $registrar = new ControladorDispositivos;
    $registrar->registrarLaptop();
    echo '
    <script>
      const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.onmouseenter = Swal.stopTimer;
          toast.onmouseleave = Swal.resumeTimer;
        }
      });
      Toast.fire({
        icon: "success",
        title: "Dispositivo agregado correctamente"
      });
      setTimeout(function(){
        window.location.href="index.php?seccion=dispositivos";
      }, 3000); // Redireccionar después de 3 segundos
    </script>';
    
    exit;
    
               
   }
?>
<!DOCTYPE html>
<html lang="en">

<headq>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro laptop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  
    <link rel="stylesheet" href="estilos/estilosFormularios.css">
    </head>

    <body>

        <div class="container-fluid">
            <div class="row fle">
                <div class="col-md-6 headd">
                    <h1>Nueva Laptop</h1>
                </div>
                <div class="col-md-6 heaad">
                    <img src="images/dis/laptop.png" alt="imagenLaptop" class="img-fluid">
                </div>
            </div>
        </div>

        <div class="container mt-52">
            <form action="" method="post" enctype="multipart/form-data">
            <!------------------------------------------------------------------------>

                <div class="col-3">
                    <div class="mb-3">
                        <label for="modelo" class="form-label">Modelo</label>
                        <input type="text" class="form-control" name="modelo" value="" required>
                    </div>

                    <div class="mb-3">
                        <label for="numero_serie" class="form-label">Número de serie</label>
                        <input type="text" class="form-control" name="numero_serie" required>
                    </div>
                    <!------------------------------------------------------------------>
                    <div class="mb-3">
                        <label for="marca" class="form-label">Marca</label>
                        <select name="marca" class="form-select" id="marca" required>
                            <?php
                            $marcas = ControladorDispositivos::getMarcas();
                            foreach ($marcas as $row => $item) {
                                echo '<option value="' . $item[0] . '">' . $item[1] . '</option>';
                            }
                            ?>
                            <option value="otro">Otra marca</option>  
                        </select>
                    </div>



                    <!------------------------------------------------------------------>
                </div>
                <div class="col-3">
                <div class="mb-3">
                    <label id="lblNew" for="labelrecio" class="form-label">Precio</label>
                    <input type="number" class="form-control" name="precio" id="precioInput" value="" pattern="[0-9]*" title="Ingrese solo números" required>
                </div>

                    <div class="mb-3">
                        <label for="fecha_compra" class="form-label">Fecha de compra</label>
                        <input type="date" class="form-control" name="fecha_compra" id="fechaCompraInput" value=""
                            placeholder="Selecciona una fecha" required>
                    </div>

                    <div class="mb-3">
                        <label for="ram" class="form-label">RAM</label>
                        <select class="form-select" name="ram" required>
                            <?php
                        $ramOptions = array("4GB", "8GB", "16GB", "32GB", "64GB");
                        foreach ($ramOptions as $ramOption) {
                            $ramValue = intval(preg_replace('/[^0-9]/', '', $ramOption));
                            echo "<option value='$ramValue'>$ramOption</option>";
                        }
                        ?>
                        </select>
                    </div>

                </div>
                <!------------------------------------------------------------------>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="procesador" class="form-label">Procesador</label>
                        <select class="form-select" name="procesador" id="procesador" required>
                            <?php
                        $procesadoresBaseDatos = array(
                           "Intel Core i5-8600K (8va generación)",
                            "Intel Core i7-8700K (8va generación)",
                           "Intel Core i5-9600K (9na generación)",
                            "Intel Core i7-9700K (9na generación)",
                            "Intel Core i5-10600K (10ma generación)",
                            "Intel Core i7-10700K (10ma generación)",
                            "Intel Core i5-11600K (11va generación)",
                            "Intel Core i7-11700K (11va generación)",
                            "Intel Core i5-12400 (12va generación)",
                            "Intel Core i7-12700K (12va generación)",
                            "Intel Core i5-13400 (13va generación)",
                            "Intel Core i7-13700K (13va generación)",                           
                            "AMD Ryzen 5 1600X (1ra generación)",
                            "AMD Ryzen 5 5600X (5ta generación)",
                            "AMD Ryzen 7 5800X (5ta generación)",
                            "AMD Ryzen 9 5900X (5ta generación)",
                            "AMD Ryzen 5 6600X (6ta generación)",
                            "AMD Ryzen 7 6700X (6ta generación)",
                            "Apple M1 ",
                            "Apple M1 Pro ",
                            "Apple M1 Max ",
                            "Apple M2"
                        );
                        foreach ($procesadoresBaseDatos as $procesador) {
                            echo "<option value='$procesador'>$procesador</option>";
                        }
                        ?>
                            <option value="otroProcesador">Otro procesador</option>
                        </select>
                    </div>

                    <div class="mb-3" id="nuevoProcesadorDiv" style="display: none;">
                        <label for="nuevo_procesador" class="form-label">Nuevo Procesador</label>
                        <input type="text" class="form-control" id="nuevo_procesador" name="nuevo_procesador"
                            placeholder="Ingresa el nuevo procesador" >
                    </div>

                    <input type="hidden" name="procesador_seleccionado" id="procesador_seleccionado">

                    <!------------------------------------------------------------------>

                    <div class="mb-3">
                        <label for="sistema_operativo" class="form-label">Sistema Operativo</label>
                        <select class="form-select" name="sistema_operativo" id="sistema_operativo" required>
                            <?php
                      $sistemasOperativosBaseDatos = array(
                        "Windows 10",
                        "Windows 10 Pro",
                        "Windows 11",
                        "Windows 11 Pro",
                        "Ubuntu",
                        "Fedora",
                        "CentOS",
                        "macOS",
                        "macOS Catalina",
                        "macOS Big Sur",
                        "macOS Monterey",
                        "Linux Mint",
                        "Debian",
                        "openSUSE",
                        "Arch Linux",
                        "FreeBSD",
                        "Android",
                        "iOS",
                        "Chrome OS"
                    );
                    

                        foreach ($sistemasOperativosBaseDatos as $sistemaOperativo) {
                            echo "<option value='$sistemaOperativo'>$sistemaOperativo</option>";
                        }
                        ?>
                            <option value="otro">Otro...</option>
                        </select>
                    </div>

                    <div class="mb-3" id="nuevoSistemaOperativoDiv" style="display: none;">
                        <label for="nuevo_sistema_operativo" class="form-label">Nuevo Sistema Operativo</label>
                        <input type="text" class="form-control" id="nuevo_sistema_operativo"
                            name="nuevo_sistema_operativo" placeholder="Ingresa el nuevo sistema operativo">
                    </div>

                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="nota" class="form-label">Notas (opcional)</label>
                        <textarea class="form-control" name="nota" rows="4" id="notas"></textarea>
                    </div>


                    <div class="mb-3">
                        <label for="foto" class="form-label" required="true">Imagen del dispositivo (opcional)</label>
                        <input type="file" class="form-control" name="foto">
                    </div>
                    <input type="submit" class="btn btn-primary" name="Registrar" value="Registrar Dispositivo">
                    <hr>
                    <a class="btn btn-danger" href="index.php?seccion=nuevoDispositivo">Cancelar</a>

            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@12"></script>
        <script>
            const notasElemento= document.getElementById("notas");

            function guardarDatosPersonales(){

                const notas =notasElemento.values;

                if(notas.trim() !== ''){
                    localStorage.setItem('notasGuardadas', notas);
                }
            }


        // Mapeo de marcas y sus IDs correspondientes
const marcasIds = {
    // Aquí debes definir tus marcas y sus IDs correspondientes
};

document.getElementById("marca").addEventListener("change", function() {
    var marcaSeleccionada = this.value;

    if (marcaSeleccionada === "otro") {
        Swal.fire({
            title: 'Nueva marca',
            input: 'text',
            inputPlaceholder: 'Ingresa la nueva marca...',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            inputValidator: (value) => {
                if (!value) {
                    return 'Debes ingresar una nueva marca';
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var nuevaMarca = result.value;
                // Obtener el elemento select de la marca
                var selectMarca = document.getElementById("marca");
                // Buscar el ID correspondiente en el mapeo de marcas
                var nuevoId = marcasIds[nuevaMarca];
                // Crear una nueva opción con el nuevo ID como valor y la nueva marca como texto
                var option = document.createElement("option");
                option.text = nuevaMarca;
                option.value = nuevoId;
                // Agregar la nueva opción al select
                selectMarca.add(option);
                // Seleccionar la nueva marca
                selectMarca.value = nuevoId;
            } else {
                // Si el usuario cancela, seleccionamos la primera opción
                document.getElementById("marca").selectedIndex = 0;
            }
        });
    }
});


document.getElementById("procesador").addEventistener("change", function() {
    var procesadorSeleccionado = this.value;

    if (procesadorSeleccionado === "otroProcesador") {
        Swal.fire({
            title: 'Nuevo procesador',
            input: 'text',
            inputPlaceholder: 'Ingresa el nuevo procesador...',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            inputValidator: (value) => {
                if (!value) {
                    return 'Debes ingresar un nuevo procesador';
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var nuevoProcesador = result.value;
                // Obtener el elemento select de la marca
                var selectProcesador = document.getElementById("procesador");
                // Buscar el ID correspondiente en el mapeo de marcas
                var nuevoId = procesadoresIds[nuevoProcesador];
                // Crear una nueva opción con el nuevo ID como valor y la nueva marca como texto
                var option = document.createElement("option");
                option.text = nuevoProcesador;
                option.value = nuevoId;
                // Agregar la nueva opción al select
                selectProcesador.add(option);
                // Seleccionar la nueva marca
                selectProcesador.value = nuevoId;
            } else {
                // Si el usuario cancela, seleccionamos la primera opción
                document.getElementById("procesador").selectedIndex = 0;
            }
        });
    }
});





        document.getElementById("sistema_operativo").addEventListener("change", function() {
            var nuevoSistemaOperativoDiv = document.getElementById("nuevoSistemaOperativoDiv");
            var sistemaOperativoSeleccionado = this.value;

            if (sistemaOperativoSeleccionado === "otro") {
                nuevoSistemaOperativoDiv.style.display = "block";
            } else {
                nuevoSistemaOperativoDiv.style.display = "none";
            }
        });


        document.getElementById('procesador').addEventListener('change', function() {
            var select = document.getElementById('procesador');
            var nuevoProcesadorDiv = document.getElementById('nuevoProcesadorDiv');
            var procesadorSeleccionadoInput = document.getElementById('procesador_seleccionado');

            if (select.value === 'otro') {
                nuevoProcesadorDiv.style.display = 'block';
                procesadorSeleccionadoInput.value = '';
            } else {
                nuevoProcesadorDiv.style.display = 'none';
                procesadorSeleccionadoInput.value = select.value;
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            var fechaCompraInput = document.getElementById('fechaCompraInput');
            var fechaCompraHidden = document.getElementById('fechaCompraHidden');

            fechaCompraInput.addEventListener('focus', function() {
                if (fechaCompraInput.value === '') {
                    fechaCompraInput.placeholder = 'Selecciona una fecha';
                }
            });

            fechaCompraInput.addEventListener('blur', function() {
                if (fechaCompraInput.value === '') {
                    fechaCompraInput.placeholder = 'Selecciona una fecha';
                }
            });

            fechaCompraInput.addEventListener('click', function() {
                fechaCompraHidden.style.display = 'block';
                fechaCompraInput.style.display = 'none';
            });

            fechaCompraHidden.addEventListener('change', function() {
                var fechaSeleccionada = new Date(fechaCompraHidden.value);
                var nombreMes = obtenerNombreMes(fechaSeleccionada.getMonth());
                fechaCompraInput.value = fechaSeleccionada.getDate() + '-' + nombreMes + '-' +
                    fechaSeleccionada.getFullYear();
                fechaCompraHidden.style.display = 'none';
                fechaCompraInput.style.display = 'block';
            });

            function obtenerNombreMes(numeroMes) {
                var meses = [
                    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                ];
                return meses[numeroMes];
            }
        });
        </script>
    </body>

</html>