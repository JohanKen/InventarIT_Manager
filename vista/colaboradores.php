<?php include ("controlador/ControladorColaboradores.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colaboradores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
    .actions{
        align-items: center;
        justify-content: center;
        text-align: center;
    }
</style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Colaboradores</h1>
        <a href="index.php?seccion=nuevoColaborador" class="btn btn-primary mb-3">AGREGAR NUEVO COLABORADOR</a>
        <div class="table-responsive" style="padding:15px">
        <table class="table table-hover">
        <thead class="table-dark align-middle border-dark">
                    <tr>
                        <th>Id Colaborador</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Cliente</th>
                        <th>Departamento</th>
                        <th>Estado</th>
                        <th>Fecha de Ingreso</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $eliminarCol = new ControladorColaboradores;
                    $eliminarCol->borrarColaboradores();

                    $listaColaboradores = ControladorColaboradores::consultarColaboradores();
                    foreach ($listaColaboradores as $item) {
                        echo '
                            <tr>
                                <td>' . $item[0] . '</td>
                                <td>' . $item[1] . '</td>
                                <td>' . $item[2] . '</td>
                                <td>' . $item[3] . '</td>
                                <td>' . $item[4] . '</td>
                                <td>' . $item[5] . '</td>
                                <td>' . $item[6] . '</td>
                                <td class="actions">
                                    <a href="index.php?seccion=editarColaborador&id_colaborador=' . $item[0] . '" <button type="button" class="btn btn-primary">Editar</button></a>
                                    <hr>
                                    <a href="javascript:void(0);" onclick="confirmarBorrar(' . $item[0] . ');" <button type="button" id="btnBorrar" class="btn btn-danger">Eliminar</button></a>
                                </td>
                            </tr>
                        ';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<script>
    const btn = document.getElementById("btnBorrar");

    function confirmarBorrar(id_colaborador){
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: '¿Seguro que deseas eliminar a este colaborador?',
        text: 'No podrás deshacer esta acción',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, Deseo eliminarlo',
        cancelButtonText: 'No, Cancelar.',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            swalWithBootstrapButtons.fire({
                title: 'Eliminado!',
                text: 'El colaborador está siendo eliminado...',
                icon: 'success',
                timer: 1500, 
                showConfirmButton: false 
            }).then(() => {
                // Redirigir a la página de eliminación después de mostrar la alerta de éxito
                window.location.href = "index.php?seccion=colaboradores&accion=eliminarColaborador&id_colaborador=" + id_colaborador;
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: 'Cancelado',
                text: ':)',
                icon: 'error'
            });
        }
    });
    }
</script>
 
</body>

</html>
