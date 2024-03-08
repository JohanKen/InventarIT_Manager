
<html>
    <head>
            <title>InventarIT Manager</title>
            <link rel="icon" href="./images/logoNav.png">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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