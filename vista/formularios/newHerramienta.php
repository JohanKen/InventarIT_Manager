<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Herramienta</title>
    <link rel="stylesheet" href="estilos/estilosFormularios.css">
</head>
<body>
    <div class="contentSeccion">

        <div class="up">
            <header class="heaserTabla">
                <h1>Nureva Herramienta</h1>
            </header>
        </div>

        <form action="" method="post" encytype="multipart/form-data">

            <div class="mb-3" id="formForm">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre">
            </div>

            <div class="mb-3" id="formForm">
                <label for="numero_piezas" class="form-label">Numero de piezas</label>
                <input type="number" class="form-control" name="cantidad_piezas" min="1" max="1000" >
            </div>

            <div class="mb-3" id="formForm">
                <label for="ubicacion" class="form-label">Ubicacion</label>
                <input type="text" class="form-control" name="ubicacion">
            </div>

            <div class="mb-3" id="formForm">
                <label for="fecha_compra" class="form-label">Fecha de comprar</label>
                <input type="date" class="form-control" name="fecha_compra" id="fechaCompraInput" value="" placeholder="Selecciona una fecha">
            </div>

            <div class="mb-3" id="formForm">
                <label for="descripcion" class="form-label">Descripcion</label>
                <textarea class="form-control" name="descripcion" rows="4"></textarea>
            </div>
            
        </form>

    </div>
</body>
</html>