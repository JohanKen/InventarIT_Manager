<?php

//obtenemos el id del usuario mediante la url
$id = $_GET["id_usuario"];
// obtenemos los datos de un usuario
$datosUsuario = ObtenerDatosUsuario($id);

function ObtenerDatosUsuario($id){
    if($id >= 0){
        try {
            $UsuarioInfo = ControladorUsuarios::getUser($id);

            // verificar si se obtuvieron correctamente los datos del usuario
            if(empty($UsuarioInfo[0])){
                echo "Error: no se pudieron obtener los datos del usuario correctamente.";
                return null;
            }

            // aquí solo devolvemos los datos
            return $UsuarioInfo[0];
        } catch (Exception $e) {
            // Manejar la excepción, por ejemplo, registrándola o mostrándola
            echo "Error al obtener datos del usuario: " . $e->getMessage();
            return null;
        }
    } else {
        echo "No se pudo obtener ningún ID de usuario";
        return null;
    }
}
//Verificar si se envio el formulario para editar el usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

//Verfificar con el metodo post que se presione el boton guardar del formulario
    if(isset($_POST['guardar'])) {
        $obj = new ControladorUsuarios();
         $obj -> UpdateUser();
         echo  '<script>
                    alert("Actualizacion realizada con exito!");
                    window.location.href="index.php?seccion=usuarios";
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
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="estilos/estilosForms.css">
</head>
<body>
    <div class="headerr">
    <h2>Editar Usuario</h2>
    </div>
   <br><br><br><br><br>
    <div class="containerr">
        
    <h3><?php echo $datosUsuario[3] . ' ' . $datosUsuario[1]; ?></h3>
    <h6><?php 
    switch ($datosUsuario[6]) {
        case 1:
            echo "Administrador";
            break;
        case 2:
            echo "Editor";
            break;
        case 3:
            echo "Consultor";
            break;
        default:
            echo "Desconocido";
            break;
    }
?></h6>

                <form action="" method="post" onsubmit="return validateForm()">
                
                    <div class="mb-3">
                                    <div class="mb-3">
                                        <label  for="id_usuario">Id Usuario:</label>
                                        <input type="text" class="form-control"  id="lbl" name="id_usuario" readonly="true" value="<?php echo $datosUsuario[0]; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label  for="apellido_paterno">Apellido Paterno:</label>
                                        <input type="text" class="form-control" id="lbl" name="apellido_paterno" value="<?php echo $datosUsuario[1]; ?>"  >
                                    </div>
                                    <div class="mb-3">
                                        <label  for="apellido_materno">Apellido Materno:</label>
                                        <input type="text" class="form-control" id="lbl" name="apellido_materno" value="<?php echo $datosUsuario[2]; ?>" >
                                    </div>
                                    <div class="mb-3">
                                        <label  for="nombre_usuario">Nombre(s):</label>
                                        <input type="text" class="form-control" id="lbl" name="nombre_usuario" value="<?php echo $datosUsuario[3]; ?>" >
                                    </div>

                    </div>    
                    <div class="mb-3">            
                                    <div class="mb-3">
                                        <label  for="correo">Correo Electronico:</label>
                                        <input type="text" class="form-control" id="lbl" name="correo" value="<?php echo $datosUsuario[4]; ?>" >
                                    </div> 




                                    
                                    <!-- Crear metodo para obtener los estados por nombre y no por ID-->
                                    <div class="mb-3" id="formForm">
                                        <label for="estado" class="form-label">Estado del Usuario</label>
                                        <select class="form-select" id="lbl" name="estado">
                                            <?php
                                            //Array asociativo que mapea los estados y les asigna un numero para que salgan como un entero
                                            $estados = array(
                                                1 => 1,
                                                2 => 2,
                                            
                                            );
                                            
                                            foreach ($estados as $estadoId => $estadoLabel) {
                                                // Verificar si el estado actual coincide con el estado del usuario
                                                $selected = ($datosUsuario[5] == $estadoLabel) ? 'selected' : '';
                                                echo "<option value='$estadoLabel' $selected>";

                                                // Mostrar el nombre del estado en lugar del valor entero
                                                switch ($estadoLabel) {
                                                    case 1:
                                                        echo "Activo";
                                                        break;
                                                    case 2:
                                                        echo "Inactivo";
                                                        break;
                                                
                                                    // En caso de que el estado no coincida con ningún caso
                                                    default:
                                                        echo "Desconocido";
                                                        break;
                                                }

                                                // Cerrar la etiqueta de opción
                                                echo "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>


                                    

                                    <div class="mb-3" id="formForm">
                                        <label for="estado" class="form-label">Rol del Usuario</label>
                                        <select class="form-select"  id="lbl" name="rol">
                                            <?php
                                            //Array asociativo que mapea los estados y les asigna un numero para que salgan como un entero
                                            $roles = array(
                                                1 => 1,
                                                2 => 2,
                                                3 => 3
                                            
                                            );
                                            
                                            foreach ($roles as $rolId => $rolLabel) {
                                                // Verificar si el rol actual coincide con el rol del usuario
                                                $selected = ($datosUsuario[6] == $rolLabel) ? 'selected' : '';
                                                echo "<option value='$rolLabel' $selected>";

                                                // Mostrar el nombre del rol en lugar del valor entero
                                                switch ($rolLabel) {
                                                    case 1:
                                                        echo "Administrador";
                                                        break;
                                                    case 2:
                                                        echo "Editor";
                                                        break;
                                                    case 3:
                                                        echo "Consultor";
                                                        break;
                                                    // En caso de que el rol no coincida con ningún caso
                                                    default:
                                                        echo "Desconocido";
                                                        break;
                                                }

                                                // Cerrar la etiqueta de opción
                                                echo "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>





                                
                                    <div class="col-12">
                                        <label  for="fecha_ingreso" id="lbl">Fecha de Ingreso:</label>
                                        <input type="date" class="form-control" id="fechaIngresoInput" name="fecha_ingreso" value="<?php echo $datosUsuario[7]; ?>">
                                    </div>
                                    
                               
                    </div>
                                            
                <div class="mb_3">                            
                    
                <img class="imgEditUser" src="images/editUser.png" alt="">                   
                    <div class="botones">
                    <button type="button" class="btnCancelar" onclick="window.location.href='index.php?seccion=usuarios'" >Cancelar</button>
                        <button type="submit" name="guardar" class="btnGuardar">Guardar Cambios</button>
                        
                    </div>
                    </div>   
                    <div class="mb_3">  
                        
                    </div>   
                    
                </form>
            
        
    </div>
</body>

<script>
            document.addEventListener('DOMContentLoaded', function () {
                var fechaIngresoInput = document.getElementById('fechaIngresoInput');
                var fechaIngresoHidden = document.getElementById('fechaIngresoHidden');

                fechaIngresoInput.addEventListener('focus', functitn () {
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

                        
    <!-- Agrega el enlace a Bootstrap JS y Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>