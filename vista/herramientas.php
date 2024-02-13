<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos/estilosColaboradores.css">
    <style>
       
    </style>
</head>

<body>
    
<div class="contentSeccion">
    <div class="up">
        <header class="headerTabla">
            <h1>Herramientas</h1>
            <form class="form-inline" id="searchBar">
                <div class="input-group">
                </div>
            </form>
        </header>
    </div>
    
    <a href="index.php?seccion=formularios/newHerramienta"><button class="custom-button" onclick="newHerramianta();">Agregar Nueva Herramienta</button></a>

    <div class="tabla">
        <table class="tabla">
            <thead class="thead-dark">
                <tr>
                    <th>Id Herramienta</th>
                    <th>Nombre</th>
                    <th>Numero De Piezas</th>
                    <th>Ubicacion</th>
                    <th>Fecha de compra</th>
                    <th>Notas</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                $eliminar = new ControladorDispositivos();
                $eliminar -> borrarHerramienta();

                $listaHerramienta = ControladorDispositivos::consultaHerramientas();
                foreach($listaHerramienta as $item){
                    echo '
                        <tr>
                            <td>'.$item[0].'</td>
                            <td>'.$item[1].'</td>
                            <td>'.$item[2].'</td>
                            <td>'.$item[3].'</td>
                            <td>'.$item[4].'</td>
                            <td>'.$item[5].'</td>
                            <td>
                            <a href="index.php?seccion=formularios/formularioHerramienta&id_herramienta='. $item[0]. '">Editar</a>
                            <a href="javascript:void(0);" onclick="confirmarBorrar(' . $item[0] . '); "id="enlaceBorrar" >Borrar</a>
                            </td>
                        </tr>
                    ';
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="modal" id="confirmarBorrarModal">
    <div class="modal-content">
        <span class="close-modal" onclick="cerrarModal()">&times;</span>
        <h4>Confirmar Eliminación</h4>
        <p>¿Estás seguro de que deseas eliminar la herramienta?</p>
        <button class="btn-danger" id="btnBorrarModal">Eliminar</button>
        <button class="btn-secondary" onclick="cerrarModal()">Cancelar</button>
    </div>
</div>


<script>
    function confirmarBorrar(id_herramienta) {
        document.getElementById('confirmarBorrarModal').style.display = 'flex';
        document.getElementById('btnBorrarModal').onclick = function () {
            window.location.href = "index.php?seccion=herramientas&accion=eliminarHerramienta&id_herramienta=" + id_herramienta;
        };
    }

    function cerrarModal() {
        document.getElementById('confirmarBorrarModal').style.display = 'none';
    }

    function eliminarDispositivo() {
        cerrarModal();
    }
</script>

</body>
</html>