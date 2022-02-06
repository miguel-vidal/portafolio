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
  <?php
  include("partials/cabeceras.html");
  ?>
  <link rel="stylesheet" href="../styles/components/formProducts.css?version=5.0">
</head>
<body>
  <?php
    include("partials/menu.html");
  ?>
<div class="container">  
  <form class="formProducts" id="formProducts" action="" method="post" enctype='multipart/form-data'>
    <h3>Publicar Producto</h3>
    <fieldset>
      <input placeholder="Producto" type="text" tabindex="1" required autofocus name="nombre" id="nombre">
    </fieldset>
    <fieldset>
      <input placeholder="Precio" type="text" tabindex="2" required name="precio" id="precio">
    </fieldset>
    <fieldset>
      <input type="file" tabindex="3"  name="foto" id="foto">
    </fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Enviar</button>
    </fieldset>
    
  </form>
</div>

<script src="../js/menuHamburger.js"></script>
<script src="../js/ajax.js"></script>
<script src="../js/actions.js"></script>
<script src="../js/saveProducts.js"></script>

<?php
include("partials/footer.html");
}else{
  include("partials/404.html");
}
?>
  