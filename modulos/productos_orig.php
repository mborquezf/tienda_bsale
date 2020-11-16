<form method="post" action="">
<div class="form-group">
    <input type="text" class="form-control" name="busq" placeholder="Introduce nombre del producto" />
</div>
<!-- llenado de categorías -->
<select id="categoria" onchange="redir_cat()" class="form-control">
    <option value="">Selecciona una categoría</option>
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
// consulta por categoría para filtrar
if(isset($cat)){
    $sc = $mysqli->query("SELECT * FROM category WHERE id = '$cat'");
    $rc = mysqli_fetch_array($sc);
    ?>
    <h1>Categoría filtrada por: <?=$rc['name']?></h1>
    <?php
}

// valida categoría para mostrar
if(isset($cat)){
    $q = $mysqli->query("SELECT * FROM product WHERE category = '$cat' ORDER BY category DESC");
}else{
    $q = $mysqli->query("SELECT * FROM product");
} 
while($r=mysqli_fetch_array($q)){
    ?>
        <div class="producto">
            <div class="name_producto"><?=$r['name']?></div>
            <div><img class="img_producto" src="<?=$r['url_image']?>"/></div>
            <span class="precio"><?=$r['price']?></span>
            <button class="boton_agregar" onclick="agregar_carro('<?=$r['id']?>');"><i class="fa fa-shopping-cart"></i></button>
        </div>
    <?php            
}
?>

<script type="text/javascript">

    function agregar_carro(idp){
        var cant = prompt("¿Qué cantidad desea agregar?",1);

        if(cant.length>0){
            window.location="?p=productos&agregar="+idp+"&cant="+cant;
            alert("Se ha agregado al carro de compras");
            redir("?p=productos");
        }
    }

    function redir_cat(){

        window.location="?p=productos&cat="+categoria.value;
    }

</script>
