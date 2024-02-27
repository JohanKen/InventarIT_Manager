<?php
require_once 'controlador/ControladorColaboradores.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');

$datoscolaborador = ControladorColaboradores::detalleColaborador();

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['continuar'])){
    $colaboradorSeleccionado = $datoscolaborador[0]["id_colaborador"];
    $dispositivoSeleccionado = $_POST['dispositivo'];
    //al momento de darle en continuar se tiene que madar los datos del colaborador y del dispositivo
    header("Location: index.php?seccion=asignaciones/asignarPaso3&id_colaborador=".$colaboradorSeleccionado."&id_dispositivo=".$dispositivoSeleccionado);
    exit();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paso 2 de la asinacion</title>
    
</head>
<body>
   
    <br><br><br><br><br> <! Eliminar esta linea>
    <div class="contentSeccion">

            <div class="up">
                <header class="headerTabla">
                    <h1>Paso 2 - Eligir Dispositivo</h1>
                </header>
            </div>

    <?php if (isset($datoscolaborador) && is_array($datoscolaborador)&& isset($datoscolaborador)){ ?>

        <form action="" method="post" enctype="multipart/form-data">


            <div action="mb-3" method="formForm" >
                <label for="nombre_colaborador" class="form-label">Colaborador Seleccionado:</label>
                <input type="text" class="form-control" name="nombre_colaborador" value="<?=$datoscolaborador[0]["nombre_colaborador"],' ',$datoscolaborador[0]["apellido_paterno_colaborador"]?>" readonly>
                
            </div>

            <?php 
                } else {
                    echo "El array \$datoscolaborador no está definido o no tiene la estructura esperada.";
                }
            ?>

            <div class="mb-3" id="formForm">
                <label for="tipo_dispositivo" class="form-label">Selecciona un Tipo de Dispositivo a Asignar</label>
                <select name="tipo_dispositivo" class="form-control" id="tipo_dispositivo" onchange="cargarDispositivos()">
                    <option value="0" disabled selected>-- Seleccione el Tipo de Dispositivo --</option>
                    <option value="1">Laptop</option>
                    <option value="2">Descktop</option>
                    <option value="3">iMac</option>
                    <option value="4">Teclado</option>
                    <option value="5">Mouse</option>
                    <option value="6">Monitor</option>
                    <option value="7">Headset</option>
                    <option value="8">Celular</option>
                    <option value="9">Switches</option>
                    <option value="12">otro</option>
                </select>
            </div>
            <?php /*
                <div action="mb-3" method="formForm">
                    <label for="dispositivo" class="form-label">Elige el dispositivo</label>
                    <select name="dispositivo" id="dispositivo" class="form-control">
                        <option value="" disabled selected>-- Seleccione un Dispositivo --</option>
                        
                    </select>
                </div>
            */ ?>
            <table id="dispositivos2">
                <! la tabla no aparce hasta que se selecciona un tipo de dispositivo>
            </table>

            <table id="dispositivos_seleccionados">
                <tr>
                    <th>Id Dispositivo</th>
                    <th>Tipo de dispositivo</th>
                    <th>Modelo</th>
                    <th>Número de Serie</th>
                    <th>Marca</th>
                </tr>
                <tbody>
                    <?php  
                    
                    ?>
                </tbody>
            </table>

            <div action="mb-3" method="formForm">
                <a class="btn btn-danger" href="index.php?seccion=asignaciones/asignaciones">Cancelar</a>
                <a class="btn btn-danger" href="index.php?seccion=asignaciones/asignarPaso1">Volver</a>
                <button type="submit" class="btn btn-primary" name="continuar">Continuar</button>
            </div>

        </form>

    </div>
    
    <script>
        function cargarDispositivos(){

            console.log("La funcion cargarDispositivos se esta ejecutando");
            var tipoSeleccionado = document.getElementById("tipo_dispositivo").value;
            var xhr = new XMLHttpRequest();
            
            xhr.onreadystatechange = function(){
                if(xhr.readyState === 4){
                    console.log("Respueta del servidor: ",xhr.status,xhr.statusText);
                    if(xhr.status === 200){
                        console.log("Contenido de la respuesta: ",xhr.responseText);
                        document.getElementById("dispositivos2").innerHTML = xhr.responseText;
                    }else{
                        console.error("Erro en la respueta del servidor");
                    }
                }
            };

            var url = "controlador/controladorDispositivoTipo.php?tipo="+tipoSeleccionado;
            xhr.open("GET", url, true);
            console.log("Solicitud AJAX enviada a: "+url);
            xhr.send();
        }
    </script>

</body>
</html>