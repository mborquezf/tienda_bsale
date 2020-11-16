<?php
include "configs/config.php";
include "configs/funciones.php";

if(!isset($p)){
    $p = "principal";
}else{
    $p = $p;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css"/>
    <link rel="stylesheet" href="fontawesome/css/all.css"/>
    <script type="text/javascript" src="fontawesome/js/all.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
    <title>Tienda Bsale</title>
</head>
<body>
    <div class="header">
        Tienda Bsale
    </div> 
    <div class="menu">
        <a href="?p=principal">Principal</a>
        <a href="?p=productos">Productos</a>
        <a href="?p=ofertas">Ofertas</a>
        <a href="?p=carrito">Carrito</a>
    </div> 
    <div>
        <?php

            if(file_exists("modulos/".$p.".php")){
                include "modulos/".$p.".php";
            }else{
                echo "<i>No se ha encontrado el modulo <b>".$p."</b> <a href='./'>Regresar</a></i>";
            }
        ?>
    </div>
</body>
</html>