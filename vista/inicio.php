

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .contentSeccion{
            display:flex;
            margin-top: 200px;
            background-color: white;
           
            margin-left:100px;
            border-radius:10px;
            z-index: -1;
            max-width:1180px;
            height: 2080px;
        }
    </style>
</head>



<body>
    <div class="contentSeccion">
        <p>
            
        <?php
print_r($_SESSION);
?>

        </p>
    </div>

</body>

</html>

