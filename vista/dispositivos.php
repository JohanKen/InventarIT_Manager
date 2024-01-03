<<<<<<< HEAD

<!DOCTYPE html>
<html lang="en">
=======
<?php
>>>>>>> dc8fd907a8b095499b0b04d3a176752b4df7392e


if (session_status() == PHP_SESSION_ACTIVE) {
    // Solo inicia la sesión si no está activa

?>
   <!DOCTYPE html>
   <html lang="en">
   
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="estilos/estilosVistas.css">
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
       <title>Dispositivos</title>
       
      
   </head>
   
   <body>
       <div class="contentSeccion">
           <section class="headerTabla">
               <h1>Dispositivos</h1>
               <form class="form-inline" id="searchBar">
                   <div class="input-group">
                       <input type="text" class="form-control" placeholder="Buscar..." aria-label="Buscar" aria-describedby="button-addon2">
                       <div class="input-group-append">
                           <button class="btn btn-outline-secondary" type="button" id="button-addon2">Buscar</button>
                       </div>
                   </div>
               </form>
           </section>
           <div class="tabla">
               <table class="table table-bordered">
                   <thead class="thead-dark">
                       <tr>
                           <th>Id Dispositivo</th>
                           <th>Tipo de dispositivo</th>
                           <th>Modelo</th>
                           <th>Número de Serie</th>
                           <th>Marca</th>
                           <th>Precio</th>
                           <th>Estado del Dispositivo</th>
                           <th>Fecha de Compra</th>
                           <th>Notas</th>
                           <th>Imagen</th>
                           <th>Acciones</th>
                       </tr>
                   </thead>
                   <tbody>
                       <?php
                       //Llamada a metodo para eliminar dispositivos
                       $eliminar = new ControladorDispositivos;
                       $eliminar->borrarDispositivos();
   
                       //Llamada a metodo para mostrar todos los dispositivos
                       $lista = ControladorDispositivos::consultaDispositivos();
                       foreach ($lista as $row => $item) {
                           echo '
                               <tr>
                                   <!-- Contenido de la tabla que se tomaron desde la vista de dispositivos -->
                                   <td>' . $item[0] . '</td>
                                   <td>' . $item[1] . '</td>
                                   <td>' . $item[2] . '</td>
                                   <td>' . $item[3] . '</td>
                                   <td>' . $item[4] . '</td>
                                   <td>' . $item[5] . '</td>
                                   <td>' . $item[6] . '</td>
                                   <td>' . $item[7] . '</td>
                                   <td>' . $item[8] . '</td>
                                   <td><img src="' . $item[9] . '" alt="" height="50"></td>
                                   
                                 
                                   <td>
                                   <a href="index.php?seccion=editarDispositivos&id_dispositivo='.$item[0].'">Editar</a>
      
       <a href="index.php?seccion=dispositivos&accion=eliminarDispositivos&id_dispositivo=' . $item[0] . '">Borrar</a>
   </td>
   
                               </tr>
                           ';
                       }
                       ?>
                   </tbody>
               </table>
           </div>
       </div>
   </body>
   
   </html>
   
   <?php
}else{
    header('Location: login.php');
}

/*
if (!isset($_SESSION['usuario'])) {
    // Si no hay un usuario autenticado, redirige a la página de login
    header('Location: login.php');
    exit(); // Asegúrate de detener la ejecución del script después de la redirección
}*/

?>

