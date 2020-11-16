<?php
include "configs/config.php";
include "configs/funciones.php";


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
    <title>TIENDA BSALE</title>
</head>
<body>
    <div class="header">
        TIENDA BSALE
    </div> 
    <div class="menu">
        <a href="?p=principal">TODOS LOS PRODUCTOS</a>
    </div> 

    <?php
        // consulta por categoría para filtrar
        if(isset($cat)){
            $sc = $mysqli->query("SELECT * FROM category WHERE id = '$cat'");
            $rc = mysqli_fetch_array($sc);
    ?>
            <h1>Filtrando por: <?=$rc['name']?></h1>
    <?php
        }

        // valida búsqueda y categoría para mostrar
        if(isset($busq) && isset($cat)){
            $q = $mysqli->query("SELECT * FROM product WHERE name like '%$busq%' AND category = '$cat' AND 
            url_image is not NULL AND url_image <> ' '");
        }elseif(isset($cat) && !isset($busq)){
            $q = $mysqli->query("SELECT * FROM product WHERE category = '$cat' AND url_image is not NULL AND 
            url_image <> ' '");
        }elseif(isset($busq) && !isset($cat)){
            $q = $mysqli->query("SELECT * FROM product WHERE name like '%$busq%' AND url_image is not NULL AND 
            url_image <> ' '");
        }elseif(!isset($busq) && !isset($cat)){
            $q = $mysqli->query("SELECT * FROM product WHERE url_image is not NULL AND url_image <> ' '");
        }else{
            $q = $mysqli->query("SELECT * FROM product WHERE url_image is not NULL AND url_image <> ' '");
        }
    ?>

        <form method="post" action="">
        <div class="form-group">
            <input type="text" class="form-input" name="busq" placeholder="Introduce nombre del producto" />
        </div>
        <!-- llenado de combo categorías -->
        <select id="categoria" name="cat" class="form-select">
            <?php
                $cats = $mysqli->query("SELECT * FROM category ORDER BY name ASC");
                while($rcat = mysqli_fetch_array($cats)){
                    ?>
                    <option value="<?=$rcat['id']?>"><?=$rcat['name']?></option>
                    <?php
                }
                ?>
        </select>
        <button type="submit" class="btn-primary" name="buscar"><i class="fa fa-search"></i> Buscar</button>
        </form>
        <br>

        <?php
        while($r=mysqli_fetch_array($q)){
        ?>
            <div class="producto">
                <div class="name_producto"><?=$r['name']?></div>
                <div><img class="img_producto" src="<?=$r['url_image']?>"/></div>
                <div class="precio"><?=$r['price']?></div>
                <button class="boton_agregar" onclick="agregar_carro('<?=$r['id']?>');"><i class="fa fa-shopping-cart"></i></button>
            </div>
        <?php            
    }
    ?>

<script type="text/javascript">

    function agregar_carro(idp){
        var cant = prompt("¿Qué cantidad desea agregar?",1);

        if(cant.length>0){
            window.location="?p=principal&agregar="+idp+"&cant="+cant;
            alert("Se ha agregado al carro de compras");
            redir("?p=principal");
        }
    }
</script>


</body>
</html>