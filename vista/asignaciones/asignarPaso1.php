<?php
 //require_once 'controlador/controladorColaoradores.php';
 error_reporting(E_ALL);
 ini_set('display_errors','1'); 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['continuar'])) {
    $colaboradorSeleccionado = $_POST['colaborador'];
    header("Location: index.php?seccion=asignaciones/asignarPaso2&id_colaborador=" . $colaboradorSeleccionado);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos/estilosFormularios.css">
</head>
<body>
    <div class="contentSeccion">

        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3" id="formForm">
                <label for="colaborador" class="form-label">Elige el colaborador</label>
                <select name="colaborador" id="" class="form-control">
                    <option  value="" disabled selected>-- Selecione un Colaborador --</option>
                    <?php
                        //se consulta la informacion de los colabordores 
                        $colaboradores = ControladorColaboradores::consultarColaboradores();
                        foreach($colaboradores as $row => $item){
                            $selectedOption = '';
                            //aparecen los colaboradores con su id, nombre, apellido y cliente 
                            echo '<option value="' . $item[0] . '" ' . $selectedOption . '>'
                                .$item[0] . ' ' . $item[1] . ' ' . $item[2] . ' ' . $item[3] . '</option>';
                        }
                    ?>
                </select>
            </div>
            
            <div class="mb-3" id="formForm">
                <label name="cliente">Selecciona el cliente:</label>
                <select name="cliente" id="cliente" onchange="cargarclientes()">
                    <option  value="" disabled selected>-- Seleccione un cliente --</option>
                        <option value="1">RTS</option>
                        <option value="2">Saela</option>
                </select>
            </div>

            <div class="mb-3" id="formForm">
                <a href="index.php?seccion=asignaciones/asignarPaso1-2">Nuevo Colaborador</a>
            </div>

            <div class="mb3" id="formForm">
                <a class="btn btn-danger" href="index.php?seccion=asignaciones/asignaciones">Cancelar</a>
                <button type="submit" class="btn btn-primary" name="continuar">Continuar</button>
            </div> 

        </form>
    </div>
</body>
</html>


