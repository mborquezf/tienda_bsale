<?php

// agrega productos a carrito
if(isset($agregar) && isset($cant)){

    $idp = clear($agregar);
    $cant = clear($cant);
    $id_cliente = clear($_SESSION['id_cliente']);
    $q = $mysqli->query("INSERT INTO carro (id_cliente,id_producto.cantidad) VALUES ($id_cliente.$idp,$cant)");
    alert("Se ha agregado al carro de compras");
    redir("?p=productos");
}
$q = $mysqli->query("SELECT * FROM product");
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
        }
    }
</script>
