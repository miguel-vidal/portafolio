<?php
session_start();
if(isset($_SESSION["idUser"]) && $_SESSION["rol"] == "1"){
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../styles/components/formProducts.css">
  <link rel="stylesheet" href="../styles/components/products.css">
  <?php
    include("partials/cabeceras.html");
  ?>
</head>
<body>
  <?php
    include("partials/menu.html");
  ?>
<div class="table-container">
    <table class="table table-striped">
        <thead class="thead-dark">
            <th>Nombre</th>
            <th>Precio</th>
            <th>Foto</th>
            <th colspan="2">Acciones</th>
        </thead>
        <tbody id="productList">

        </tbody>
    </table>
</div>

<div class="container " id="containerEdit">  
  <form class="formProducts  hidden" id="formEdit" action="" method="post" enctype='multipart/form-data'>
    <h3>Actualizar Producto</h3>
    <input type="hidden" id="id" name="idProducto">
    <fieldset>
      <h4>Nombre</h4>
      <input id="nombreEdit" placeholder="Producto" type="text" tabindex="1" required autofocus name="nombre">
    </fieldset>
    <fieldset>
      <h4>Precio</h4>
      <input id="priceEdit" placeholder="Precio" type="text" tabindex="2" required name="precio">
    </fieldset>
    <fieldset>
      <input id="imgEdit" type="file" tabindex="3"  name="foto">
      <div class="div__image__formEdit  hidden" id="divImgFormEdit"><img src="" id="imgFormEdit" width="50px" height="50px"></div>
    </fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Enviar</button>
    </fieldset>
    
  </form>
</div>


  
<script src="../js/menuHamburger.js"></script>
<script src="../js/ajax.js"></script>
<script src="../js/actions.js"></script>
<script src="../js/getProductsAdmin.js"></script>
<?php
include("partials/footer.html");
}else{
  include("partials/404.html");
}
?>
