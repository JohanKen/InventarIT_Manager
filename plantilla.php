
<html>
    <head>
            <title>InventarIT Manager</title>
            <link rel="icon" href="./images/logoNav.png">
        <style>
           
footer{
    margin-top: 15px;
    background: none;
    height: auto;
}
.left-content {
    flex: 1; /* El contenido izquierdo ocupará todo el espacio disponible */
}
#FootImg{
    width: 230px;
    height: 80px;
}
#FootImg1{
    width: 550px;
    height: 120px;
}
.right-content {
    margin-left: 10px; /* Puedes ajustar el margen según sea necesario */
}

        </style>
        
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

        <footer>
  
    <div class="right-content" >
        <img src="./images/logo.png" alt=""id="FootImg">
    </div>
</footer>

    </body>
  
    </html>