<html>
    <head>
            <title>InventarIT Manager</title>
            <link rel="icon" href="./imagenes/logoAGENCIAPNG.png">
    </head>
    <body>
        <?php
           include_once('./vista/menu.php');
        ?>
        <hr>
        <div >
            <div>
                    <?php
                        $obj = new controladorVistas;
                        $obj -> cargarSeccion();
                    ?>
            </div>
        </div>
    </body>
  
    </html>