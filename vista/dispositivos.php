
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./estilos/estilosVistas.css">
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
                    <th>ID Dispositivo</th>
                    <th>ID Tipo Dispositivo</th>
                    <th>Modelo</th>
                    <th>Número de Serie</th>
                    <th>ID Marca</th>
                    <th>ID Estado Dispositivo</th>
                    <th>Precio</th>
                    <th>Fecha de Compra</th>
                    <th>ID Proveedor</th>
                    <th>Nota</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>1</td>
                    <td>Modelo 1</td>
                    <td>Número de Serie 1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>100.00</td>
                    <td>2023-01-01</td>
                    <td>1</td>
                    <td>Nota 1</td>
                    <td>imagen1.jpg</td>
                    <td>
                        <button class="btn btn-primary btn-sm">Editar</button>
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </td>
                </tr>
                <!-- Agrega más filas para representar más datos -->
            </tbody>
        </table>
        <?php
                //Llamada a metodo para eliminar dispositivos
                $eliminar = new ControladorDispositivos;
                $eliminar -> borrarDispositivos();

                //Llamada a metodo para mostrar todos los dispositivos
                $lista = ControladorDispositivos::consultaDispositivos();
                foreach($lista as $row => $item){
                    echo '
                        <tr>
                            <td>'.$item[0].'</td>
                            <td>'.$item[1].'</td>
                            <td>'.$item[2].'</td>
                            <td><img src="'.$item[4].'" alt="" height="50"></td>
                            <td>'.$item[6].'</td>
                            <td>
                            <a href="index.php?seccion=editarProductos&id='.$item[0].'">Editar</a>
                            <a href="index.php?seccion=listaProductos&accion=eliminarProductos&id='.$item[0].'">Borrar</a>
                            </td>
                        </tr>
                    ';
                }
            ?>
        </div>
    </div>

</body>

</html>