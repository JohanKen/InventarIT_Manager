<?php
    include_once ("controlador/ControladorColaboradores.php");
    $clientes = array(
        1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12,
        13 => 13, 14 => 14, 15 => 15, 16 => 16, 17 => 17, 18 => 18, 19 => 19, 20 => 20, 21 => 21, 22 => 22,
        23 => 23, 24 => 24, 25 => 25, 26 => 26, 27 => 27, 28 => 28, 29 => 29, 30 => 30, 31 => 31, 32 => 32,
        33 => 33, 34 => 34, 35 => 35, 36 => 36, 37 => 37, 38 => 38, 39 => 39, 40 => 40, 41 => 41, 42 => 42,
        43 => 43, 44 => 44, 45 => 45, 46 => 46, 47 => 47, 48 => 48, 49 => 49, 50 => 50, 51 => 51, 52 => 52,
        53 => 53, 54 => 54, 55 => 55, 56 => 56, 57 => 57, 58 => 58, 59 => 59, 60 => 60, 61 => 61, 62 => 62,
        63 => 63, 64 => 64, 65 => 65, 66 => 66, 67 => 67, 68 => 68, 69 => 69, 70 => 70, 71 => 71, 72 => 72,
        73 => 73, 74 => 74, 75 => 75, 76 => 76, 77 => 77, 78 => 78, 79 => 79, 80 => 80, 81 => 81, 82 => 82,
        83 => 83, 84 => 84, 85 => 85, 86 => 86, 87 => 87, 88 => 88, 89 => 89, 90 => 90, 91 => 91, 92 => 92,
        93 => 93, 94 => 94, 95 => 95, 96 => 96, 97 => 97, 98 => 98, 99 => 99, 100 => 100, 101 => 101, 102 => 102,
        103 => 103, 104 => 104, 105 => 105, 106 => 106, 107 => 107, 108 => 108, 109 => 109, 110 => 110, 111 => 111, 112 => 112,
        113 => 113, 114 => 114, 115 => 115, 116 => 116, 117 => 117, 118 => 118, 119 => 119, 120 => 120, 121 => 121, 122 => 122,
        123 => 123, 124 => 124, 125 => 125, 126 => 126, 127 => 127, 128 => 128, 129 => 129, 130 => 130, 131 => 131, 132 => 132,
        133 => 133, 134 => 134, 135 => 135, 136 => 136, 137 => 137, 138 => 138, 139 => 139, 140 => 140, 141 => 141, 142 => 142,
        143 => 143, 144 => 144, 145 => 145, 146 => 146, 147 => 147, 148 => 148, 149 => 149, 150 => 150, 151 => 151, 152 => 152,
        153 => 153, 154 => 154, 155 => 155, 156 => 156, 157 => 157, 158 => 158, 159 => 159, 160 => 160, 161 => 161, 162 => 162,
        163 => 163, 164 => 164, 165 => 165, 166 => 166, 167 => 167, 168 => 168, 169 => 169, 170 => 170, 171 => 171, 172 => 172,
        173 => 173, 174 => 174, 175 => 175, 176 => 176, 177 => 177, 178 => 178, 179 => 179, 180 => 180,
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

            
            if ($colaboradorSeleccionado > 0){
                echo "<script>
                    Swal.fire({
                        title: 'Colaborador registrado correctamente',
                        icon: 'success',
                        confirmButtonText: 'Continuar '
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'index.php?seccion=asignaciones/asignarPaso2&id_colaborador=$colaboradorSeleccionado';
                        }
                    });
                </script>";
                exit();
            }else{
                echo "<script>
                    Swal.fire({
                        title: 'Error al registrar el colaborador',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'index.php?seccion=asignaciones/asignarPaso1';
                        }
                    })";
            }
            
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro de Colaborador</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="estilos/estilosAsignacionesPaso1-2.css">
       
    
</head>

<body>

<div class="up">

                   
               
        <header class="header text-center">
        <img src="images/empleados.png" alt="Cliente Icon" class="form-icon"> 
            <h2>Nuevo colaborador</h2>
        </header>
    </div>


    <div class ="container mt-52" >
        
        <form action="" method="post" enctype="multipart/form-data">
<div class="row">
    <div class="col-sm"></div>
            <div class="col-sm">
    <div class="col">
            <div class ="mb-3" id="formForm">
                <label for="nombre_colaborador" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre_colaborador" value="">
            </div>

            <div class="mb-3" id="formForm" >
                <label for="apellido_paterno_colaborador" class="form-label">Apellido</label>
                <input type="text" class="form-control" name="apellido_paterno_colaborador" value="">
            </div>
            
    </div>
        <div class="col">
            <div class = "mb-3" id="formForm">
                <label for="empresa" class="form-Label">Cliente</label>
                <select name="empresa" id="" class="form-control">
                <option  value="" disabled selected>-- Selecione un Cliente --</option>
                    <?php
                        $clientes = ControladorColaboradores::getClientes();

                        foreach ($clientes as $row => $item){
                            $selected = ($item[0]) ? 'selected' : '';
                            echo '<option value="' . $item[0] . '" ' . $selected . '>' . $item[1] . '</option>';

                        }
                    ?>
                    </select>
            </div>
<div class="row">
            <div class="mb-3" id="formForm" >
                <label for="departamento" class="form-label">Departamento</label>
                <input type="text" class="form-control" name="departamento" value="">
            </div>
            
            <div class="mb-3" id="formForm">
                <label for="fecha_ingreso_colaborador" class="form-label">Fecha de ingreso</label>
                <input type="date" class="form-control" name="fecha_ingreso_colaborador" id="fechaIngresoInput" value="" placeholder= "Selecciona una fecha">
            </div>
            </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <a class="btn btn-danger" href="index.php?seccion=asignaciones/asignarPaso1">Cancelar</a>
                </div>
                <div class="col-6 col-md-4">
                    <button type="submit" class="btn btn-primary" name="Registrar">Continuar</button>
                </div>
            </div>
            </div>
            <div class="col-sm"></div>
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