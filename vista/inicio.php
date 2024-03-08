

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
    <style>
        .contentSeccion{
            display:flex;
            margin-top: 200px;
            background-color: white;
           
            margin-left:100px;
            border-radius:10px;
            z-index: -2;
            max-width:1180px;
            height: 2080px;
        }
    </style>
</head>



<body>
    <div class="contentSeccion">
        <p>
            
        <?php
    echo "Datos del usuario que está logueado: <br>";
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
?>


        </p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>

