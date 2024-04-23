<?php
require_once 'controlador/ControladorDispositivos.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['Registrar'])){
        $fechaCompra = $_POST["fecha_compra"];

        // Verificar si la fecha tiene el formato correcto
        $fechaCompraFormateada = date('Y-m-d', strtotime($fechaCompra));
        if ($fechaCompraFormateada != $fechaCompra) {
            echo "
            <script>
                Swal.fire({
                    title: 'Fecha incorrecta',
                    text: 'Ingrese el formato de fecha correcto',
                    type: 'warning'
                }).then(function(result) {
                    if (result.value) {
                        window.location.href = window.location.href;
                    }
                });
            </script>
            ";
            exit;
            }

        $registrar = new ControladorDispositivos;
        $tipo = 8;
        $registrar -> registrarDispositivo($tipo);
        echo '
        <script>
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1000,
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
          }, 1000); 
        </script>';
    
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro celular</title>
     
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
   

    
    <link rel="stylesheet" href="estilos/estilosFormularios.css">
    </head>
<body>
   

    <div class="container-fluid">
            <div class="row fle">
                <div class="col-md-6 headd">
                <h1 style="font-size: 28px; font-weight: bold; color: #003363; text-transform: uppercase; border-bottom: 2px solid #003363; ">NUEVO CELULAR</h1>
                </div>
                <div class="col-md-6 heaad">
                    <img src="images/dis/celular.png" alt="imagenLaptop" style="width:170px;" class="img-fluid">
                </div>
            </div>
        </div>

        <div class="container mt-52">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="col-3">
                    <div class="mb-3">
                        <label for="modelo" class="form-label">Modelo <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="modelo" value="">
                    </div>

                    <div class="mb-3">
                        <label for="numero_serie" class="form-label">Número de serie <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="numero_serie">
                    </div>
                   
                </div>
                <div class="col-3">
                <div class="mb-3">
                    <label id="lblNew" for="labelrecio" class="form-label">Precio <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" name="precio" id="precioInput" value="" title="Ingrese solo números" oninput="formatoPrecio(this)">
                </div>


                    <div class="mb-3">
                        <label for="fecha_compra" class="form-label">Fecha de compra <span style="color: red;">*</span></label>
                        <input type="date" class="form-control" name="fecha_compra" id="fechaCompraInput" value=""
                            placeholder="Selecciona una fecha">
                    </div>

                  

                </div>
                <!------------------------------------------------------------------>
                <div class="col-3">
                <div class="mb-3">
                        <label for="marca" class="form-label">Marca <span style="color: red;">*</span></label>
                        <select name="marca" class="form-select" id="marca">
                            <?php
                        $marcas = ControladorDispositivos::getMarcas();
                        foreach ($marcas as $row => $item) {
                            echo '<option value="' . $item[0] . '">' . $item[1] . '</option>';
                        }
                        ?>

<!--
                       <option value="otro">Otra marca</option>   
                    -->                    
                    
                    </select>
                    </div>

                    <div class="mb-3">
                        <label for="nota" class="form-label">Notas (opcional)</label>
                        <textarea class="form-control" name="nota" rows="4"></textarea>
                    </div>
                </div>
                <div class="col-3">
                   


                    <div class="mb-3">
                        <label for="foto" class="form-label" required="true">Imagen del dispositivo (opcional)</label>
                        <input type="file" class="form-control" name="foto">
                    </div>
                    <input type="submit" class="btn btn-secondary custom-btn-color" name="Registrar" value="Registrar Dispositivo" onclick="return validarCampos()">

                    <hr>
                    <a class="btn btn-danger customCancelar" href="index.php?seccion=nuevoDispositivo">Cancelar</a>

            </form>
        </div>
        <script>

function formatoPrecio(input) {
        // Obtener el valor actual del campo de precio
        let valor = input.value;

        // Eliminar cualquier carácter que no sea un número o un punto decimal
        valor = valor.replace(/[^\d.]/g, '');

        // Separar el valor en parte entera y decimal
        let partes = valor.split('.');
        let parteEntera = partes[0];
        let parteDecimal = partes.length > 1 ? '.' + partes[1] : '';

        // Agregar separadores de miles a la parte entera
        parteEntera = parteEntera.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

        // Concatenar el signo de pesos, la parte entera y la parte decimal
        valor = '$' + parteEntera + parteDecimal;

        // Mostrar el valor formateado en el campo de precio
        input.value = valor;
    }
//
//codigo para abrir div de nueva marca si se selecciona el option= "otro" en la marca...
//document.getElementById("marca").addEventListener("change", function() {
  //          var nuevaMarcaDiv = document.getElementById("nuevaMarcaDiv");
    //        var marcaSeleccionada = this.value;

      //      if (marcaSeleccionada === "otro") {
        //        nuevaMarcaDiv.style.display = "block";
         //   } else {
           //     nuevaMarcaDiv.style.display = "none";
           // }
       // });



function validarCampos() {
    // Obtener los valores de los campos
    var modelo = document.getElementsByName("modelo")[0].value.trim();
    var numero_serie = document.getElementsByName("numero_serie")[0].value.trim();
    var marca = document.getElementsByName("marca")[0].value;
    var precio = document.getElementsByName("precio")[0].value.trim();
    var fecha_compra = document.getElementsByName("fecha_compra")[0].value.trim();


    // Validar que todos los campos obligatorios estén llenos
    if (modelo === '' || numero_serie === '' || marca === '' || precio === '' || fecha_compra === '' ) {
        Swal.fire({
            title:"Formulario incompleto",
            text:"Por favor, llene todos los campos obligatorios.",
            icon:"warning"
        });
        return false; // Impedir que el formulario se envíe
    }

    // Si todos los campos obligatorios están llenos, permitir enviar el formulario
    return true;
}
            document.addEventListener('DOMContentLoaded', function () {
                var fechaCompraInput = document.getElementById('fechaCompraInput');
                var fechaCompraHidden = document.getElementById('fechaCompraHidden');

                fechaCompraInput.addEventListener('focus', function () {
                    if (fechaCompraInput.value === '') {
                        fechaCompraInput.placeholder = 'Selecciona una fecha';
                    }
                });

                fechaCompraInput.addEventListener('blur', function () {
                    if (fechaCompraInput.value === '') {
                        fechaCompraInput.placeholder = 'Selecciona una fecha';
                    }
                });

                fechaCompraInput.addEventListener('click', function () {
                    fechaCompraHidden.style.display = 'block';
                    fechaCompraInput.style.display = 'none';
                });

                fechaCompraHidden.addEventListener('change', function () {
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

    </div>
</body>
</html>