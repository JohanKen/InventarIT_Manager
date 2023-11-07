<html>
    <head>
            <title>InventarIT Manager</title>
            <link rel="icon" href="./images/logoNav.png">
        </head>
    <body>
        <?php
           include_once('./vista/menu.php');
        ?>
        
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