<?php include ("controlador/ControladorColaboradores.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colaboradores</title>
    <link rel="stylesheet" href="estilos/estilosColaboradores.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
     .imagen-editar {
            cursor: pointer;
        }

        .acciones {
            display: flex;
        }
        
        .acciones img {
            max-width: 40px;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .acciones img:hover {
            transform: scale(1.2);
        }
</style>
</head>

<div class="contentSeccion">
        <div class="up">
    
    <header class="headerTabla">
                <h1 style="font-size: 28px; margin-top:20px; font-weight: bold; color: #003363; text-transform: uppercase; border-bottom: 2px solid #003363;">COLABORADORES</h1>
                
            </header>
            <div class="col-md-12 text-center d-flex">
            <div class="input-group input-group-sm mt-3" id="divBuscar" style="max-width: 400px; margin: auto;">
                <input type="text" class="buscarForm" name="buscar" id="buscar" style="border-radius: none;">
                <span class="input-group-text" id="clearSearch" style="cursor: pointer; display: none; border-radius: none;">&times;</span>
                <!--Cmaibar nombre de la funcion por buscarColaborador y que funcione de la misma manera que la barra de buscador de dispositivos -->
                <button type="submit" class="custom-btn1 btn-4" onclick="buscarColaborador()">Buscar</button>
            </div>
            <div class="input-group input-group-sm mt-3" style="max-width: 300px; margin: auto; display: block !important; display: flex; flex-direction: column; align-items: flex-end;">
                    <img src="images/empleados.png" id="IMGlaptop" alt="IMAGEN">
                    <a href="index.php?seccion=nuevoColaborador"><button class="custom-btn btn-3">AGREGAR NUEVO COLABORADOR</button></a>
                    
                    </div>    
</div>
</div>
        <div class="container" style="margin-top: 10px !important;">
        <div class="table-responsive">
                <table class="table table-secondary table-straped table-hover" id="colaboradores">
                    <thead class="table-dark">
                    <tr>
                        <th>Id Colaborador</th>
                        <th>Nombre(s)</th>
                        <th>Apellido(s)</th>
                        <th>Cliente</th>
                        <th>Departamento</th>
                        <th>Estado</th>
                        <th>Fecha de Ingreso</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $eliminarColaborador = new ControladorColaboradores();
                    $eliminado= $eliminarColaborador->borrarColaboradores();
                    if ($eliminado) {
                        echo "
                        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                        <script>
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Colaborador eliminado con éxito',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = 'index.php?seccion=colaboradores'; 
                        });
                        </script>
                        ";
                        exit(); // Finaliza la ejecución del script PHP después de la salida del script JavaScript
                    }
                    $listaColaboradores = ControladorColaboradores::consultarColaboradores();
                    foreach ($listaColaboradores as $item) {
                        echo "
                            <tr>
                                <td>$item[0]</td>
                                <td>$item[1] </td>
                                <td> $item[2] </td>
                                <td> $item[3] </td>
                                <td> $item[4] </td>
                                <td> $item[5] </td>
                                <td> $item[6] </td>
                                <td>
                                <div class='acciones'>
                                    <img src='images/editColab.png' alt='Editar' style='max-width:40px;' class='imagen-editar' id='editar-{$item[0]}'>
                                    <img src='images/basura.png' alt='Borrar' style='max-width:40px; cursor:pointer;' onclick='confirmarBorrar({$item[0]});'>
                                </div> 
                            </td>
                            </tr>
                        ";
                        echo "<script>
                                    document.getElementById('editar-{$item[0]}').addEventListener('click', function() {
                                        window.location.href = 'index.php?seccion=editarColaborador&id_colaborador={$item[0]}';
                                    });
                                </script>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
<script>
    
    const btn = document.getElementById("btnBorrar");
    
    //cambiar la funcion por una funcion igual de buscar pero buscar colaboradores
    function buscarColaborador() {

var buscarColaborador = document.getElementById("buscar").value;
var xhr = new XMLHttpRequest();

xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {

        if (xhr.status === 200) {

            document.getElementById("colaboradores").innerHTML = xhr.responseText;
        } else {
            console.error("Error en la respuesta del servidor");
        }
    }
};

var url = "controlador/ControladorFiltros/buscadorColaborador.php?buscar="+ buscarColaborador;
xhr.open("GET", url, true);
console.log("Solicitud AJAX enviada a: " + url);
xhr.send();
}
   

    function confirmarBorrar(id_colaborador) {
            Swal.fire({
                title: '¿Estas seguro?',
                text: "El colaborador se eliminará definitivamente.",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "index.php?seccion=colaboradores&accion=eliminarColaborador&id_colaborador=" + id_colaborador;                }
            });
        }
</script>
 
</body>

</html>
