<?php
    session_start();
    include "pages/partials/header.html";
    require_once("apiPHP/mvc/view.php");
    $products=json_decode(doGET(),true);
?>

<?php if(isset($_SESSION["idUser"])){ ?>
    <div class="cart-div">
    <button onClick="shoopingCart()" class="btn-cart"><img class="img-cart" src="assets/img/carrito.png"/></button>
    <p class="num-products" id="shopingcart"></p>
    </div>
    <?php } ?>
    
    
    <div class="hamIcon">
            <img src="assets/img/menuicon.png" width="50em" height="50em">
    </div>

    <div class="app">

        <header>
            <nav class="menu"  id="mainMenu">
                <ul class="menu__list">
                    <?php if(isset($_SESSION["idUser"])){ ?>
                        <li  class="menu-item"><a href="#"><?php echo $_SESSION["username"]; ?></a></li>
                    <?php }?>
                    <?php if(isset($_SESSION["idUser"])){ ?>
                    <li class="menu-item"><a href="pages/compras.php">Mis Compras</a></li>
                    <?php } ?>
                    <?php if(isset($_SESSION["idUser"])==0 ){ ?>
                    <li class="menu-item"><a href="pages/login.php">Iniciar Sesion</a></li>
                    <?php } ?>
                    <?php if(isset($_SESSION["idUser"])==0 ){ ?>
                    <li class="menu-item"><a href="pages/register.php">Registrarse</a></li>
                    <?php } ?>
                    <?php
                    if(isset($_SESSION["rol"]) && ($_SESSION["rol"] == "1")){
                            echo "<li class='menu-item'><a href='pages/admin.php'>Menu de Administracion</a></li>";
                    }              ?>
                    <?php if(isset($_SESSION["idUser"])){ ?>
                            <li class="menu-item"><a href="helpers/sessiondestroy.php">Cerrar sesion</a></li>
                    <?php } ?>
                    
                </ul>
            </nav>
        </header>

        <main>

        <div class="banner">

        </div> 
        
        <div class="content" id="content">
            <?php

                foreach($products as $product => $value){
            ?>
                        <div class="card-product">
                        <div class="card-image"><img src="apiPHP/<?php echo $value["foto"]?>"></div>
                        <div class="card-des"><h2 class="text-card"><?php echo $value["nombre"]?> </h2>
                        <h3 class="text-card">$ <?php  echo $value["precio"]?></h3>
                        <?php if(isset($_SESSION["idUser"])){ ?>
                        <button class="button-addcart" id="btnAddCart" onClick="cart(this, <?php echo $value["idProducto"]?>)">Add to cart</button>
                        <?php }else{ ?>
                            <button class="button-addcart"><a href="pages/register.php">Add to cart</a></button>
                        <?php }?>   
                        </div>
                        </div>
              <?php  
                }
            ?>
        </div>
        </main>

    </div>
    
    <script src="js/menuHamburger.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/functions.js"></script>
<?php
include "pages/partials/footer.html";
?>