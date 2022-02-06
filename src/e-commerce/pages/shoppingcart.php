<?php
session_start();
if(isset($_SESSION["idUser"])){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/components/cart.css">
    <link rel="stylesheet" href="../styles/components/products.css">
    <style>
        td{
            font-size:1.5em;
        }
    </style>
    <link rel="stylesheet" href="../styles/components/responsive.css">
</head>
<body>
    <h1 class="title-compras" id="titleShoppingCart"></h1>
    <a class="anchor-back" href="../index.php">Regresar</a>

    <?php

    include("partials/products.html");
    ?>
<button id="btnBuyProducts" onClick="purchase(<?php echo $_SESSION['idUser']; ?>)">Comprar</button>


    
    <script src="../js/ajax.js"></script>
    <script src="../js/shoppingCart.js"></script>
</body>
</html>

<?php
}else{
    include("partials/404.html");
}

?>