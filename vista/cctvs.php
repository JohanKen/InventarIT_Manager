<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCTV</title>
    <link rel="stylesheet" href="estilos/estilosColaboradores.css"><!se tien que quitar esta linea> 
</head>
<body>
    <div class="contentSeccion">

        <div class="up">
            <header class="headerTabla">
                <h1>CCTV</h1>
                <form class="form-inline" id="searchBar">
                    <div class="input-group">

                    </div>
                </form>
            </header>
        </div>

        <a href="index.php?seccion=formularios/newCctv"><button class="custom-button" onclick="newCctv();">AGREGAR NUEVO CCTV</button></a>

        <div class="tabla">
            <table class="tabla">
                <thead class ="thead-dark">
                    <tr>
                        <th>ID Dispositivo</th>
                        <th>Tipo</th>
                        <th>Producto</th>
                        <th>Ubicacion</th>
                        <th>Modelo</th>
                        <th>Numero Serie</th>
                        <th>Marca</th>
                        <th>Precio</th>
                        <th>Fecha de Compra</th>
                        <th>Nota</th>
                        <th>Imagen</th>
                        <th>opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $eliminar = new ControladorDispositivos;
                    $eliminar -> borrarDispositivos();

                    $listaCctv = ControladorDispositivos::consultaCctvs();
                    foreach($listaCctv as $item){
                        echo '
                            <tr>
                                <td>'.$item[0].'</td>
                                <td>'.$item[1].'</td>
                                <td>'.$item[2].'</td>
                                <td>'.$item[3].'</td>
                                <td>'.$item[4].'</td>
                                <td>'.$item[5].'</td>
                                <td>'.$item[6].'</td>
                                <td>'.$item[7].'</td>
                                <td>'.$item[8].'</td>
                                <td>'.$item[9].'</td>
                                <td>'.$item[10].'</td>
                                <td>
                                <a href="index.php?seccion=formularios/formularioCctv&id_dispositivo=' .$item[0]. '">Editar</a>
                                <a href="javascript:void(0);" onclick="confirmarBorrar('.$item[0].'); "id="enlaceBorrar">Borrar</a>
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