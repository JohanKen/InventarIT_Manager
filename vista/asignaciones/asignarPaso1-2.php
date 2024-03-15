<?php

    $clientes = array(
        1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8,
    );

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST['Registrar'])){
            $registrar= new ControladorColaboradores();
            
            $clienteSeleccionado = $_POST['empresa'];
            $idCliente = $clientes[$clienteSeleccionado];
            $datoscolaborador[0]['id_empresa']=$idCliente;

            $registrar->registrarColaborador();

            //se tiene que consultar el id de colaborador que se acaba de registrar para tener sus datos en la sigiente vista (paso2.php) 
            $datoscolaborador2 = ControladorColaboradores::consultarUltimoColaborador();

            foreach($datoscolaborador2 as $item){
                $colaboradorSeleccionado = $item[0];
            }
            header("Location: index.php?seccion=asignaciones/asignarPaso2&id_colaborador=" . $colaboradorSeleccionado);
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro de Colaborador</title>
        <link rel="stylesheet" href="estilos/estilosFormularios.css">
    
</head>

<body>

    <div class ="contentSeccion">
        
        <form action="" method="post" enctype="multipart/form-data">
    
            <div class ="mb-3" id="formForm">
                <label for="nombre_colaborador" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre_colaborador" value="">
            </div>

            <div class="mb-3" id="formForm" >
                <label for="apellido_paterno_colaborador" class="form-label">Apellido</label>
                <input type="text" class="form-control" name="apellido_paterno_colaborador" value="">
            </div>
            
            <div class = "mb-3" id="formForm">
                <label for="empresa" class="form-Label">Cliente</label>
                <select name="empresa" id="" class="form-control">
                <option  value="" disabled selected>-- Selecione un Cliente --</option>
                    <?php
                        $clientes = ControladorColaboradores::getClientes();

                        foreach ($clientes as $row => $item){
                            //$selected = ($item[0]) ? 'selected' : '';
                            echo '<option value="' . $item[0] . '" ' . $selected . '>' . $item[1] . '</option>';

                        }
                    ?>
                    </select>
            </div>

            <div class="mb-3" id="formForm" >
                <label for="departamento" class="form-label">Departamento</label>
                <input type="text" class="form-control" name="departamento" value="">
            </div>
            
            <div class="mb-3" id="formForm">
                <label for="fecha_ingreso_colaborador" class="form-label">Fecha de ingreso</label>
                <input type="date" class="form-control" name="fecha_ingreso_colaborador" id="fechaIngresoInput" value="" placeholder= "Selecciona una fecha">
            </div>
            
            <div class="mb-3" id="formForm">
                <a class="btn btn-danger" href="index.php?seccion=asignaciones/asignaciones">Cancelar</a>
                <a class="btn btn-danger" href="index.php?seccion=asignaciones/asignarPaso1">Volver</a>
                <button type="submit" class="btn btn-primary" name="Registrar">Continuar</button>
            </div>

        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var fechaIngresoInput = document.getElementById('fechaIngresoInput');
                var fechaIngresoHidden = document.getElementById('fechaIngresoHidden');

                fechaIngresoInput.addEventListener('focus', function () {
                    if (fechaIngresoInput.value === '') {
                        fechaIngresoInput.placeholder = 'Selecciona una fecha';
                    }
                });

                fechaIngresoInput.addEventListener('blur', function () {
                    if (fechaIngresoInput.value === '') {
                        fechaIngresoInput.placeholder = 'Selecciona una fecha';
                    }
                });

                fechaIngresoInput.addEventListener('click', function () {
                    fechaIngresoHidden.style.display = 'block';
                    fechaIngresoInput.style.display = 'none';
                });

                fechaIngresoHidden.addEventListener('change', function () {
                    var fechaSeleccionada = new Date(fechaIngresoHidden.value);
                    var nombreMes = obtenerNombreMes(fechaSeleccionada.getMonth());
                    fechaIngresoInput.value = fechaSeleccionada.getDate() + '-' + nombreMes + '-' +
                    fechaSeleccionada.getFullYear();
                    fechaIngresoHidden.style.display = 'none';
                    fechaIngresoInput.style.display = 'block';
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