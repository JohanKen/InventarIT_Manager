<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos/estilosColaboradores.css">
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
    </div>

    <a href="index.php?seccion=newHerramienta"><button class="custom-button" onclick="newHerramianta();">Agregar Nueva Herramienta</button></a>

    <div class="tabla">
        <table class="tabla">
            <thead class="thead-dark">
                <tr>
                    <th>Id Herramienta</th>
                    <th>Nombre</th>
                    <th>Numero De Piezas</th>
                    <th>Ubicacion</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                $eliminar = new ControladorDispositivos();
                $eliminar -> borrarHerramienta();

                $listaHerramienta = ControladorDispositivos::consultaHerramientas();
                foreach($listaHerramienta as $item){
                    echo '<tr>
                            <td>'.$item[0].'</td>
                            <td>'.$item[1].'</td>
                            <td>'.$item[2].'</td>
                            <td>'.$item[3].'</td>
                            <td>
                                <a href="index.php?seccion=editarHerramienta&id_herramienta='. $item[0]. '">Editar</a>
                                <a href="javascript:void(0);"onclick="confirmarBorrar(' .$item[0]. '); "id="enlaceBorrar">Borrar</a>
                            </td>
                        </tr>
                    ';
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>